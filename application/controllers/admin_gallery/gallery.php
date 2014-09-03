<?php
class Gallery extends Admin_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('gallery/gallery_tbl');
                
                if(!$this->auth->has_right('view_administration') OR !$this->auth->has_right('can_manage_categories'))
		{
			redirect('post/overview');
		}
               
		$this->view->set_design_folder($this->config->item('config_design_folder')."/".'admin');  
	}
        
	function index() {
                $this->view->add_data('rows', $this->gallery_tbl->viewCategories());
                $this->view->show('Gallery','gallery/gallery_view');
	}
	function view() {
                $this->view->add_data('rows', $this->gallery_tbl->viewParticular($this->uri->segment(4)));
		$this->view->show('View Category','gallery/category_view_id');
	}
	function add() {
		$this->view->show('Add Category','gallery/category_insert');
	}
	function insert() {
		$this->gallery_tbl->insertCategory();
	}
	function update() {
		$data['rows'] = $this->gallery_tbl->viewParticular($this->uri->segment(4));
                $this->view->add_data('rows', $data['rows']);
		$this->view->show('Update Gallery','gallery/category_update');
	}
	function updatecat() {
		$this->gallery_tbl->updateCategory();
	}
	function delete() {
		$data['rows'] = $this->gallery_tbl->viewParticular($this->uri->segment(4));
                $this->view->add_data('rows', $data['rows']);
		$this->view->show('Delete','gallery/category_delete');
	}
	function deleterow() {
		$this->gallery_tbl->deleteCategory();
	}
	function images() {
		$data['info'] = $this->gallery_tbl->viewParticular($this->uri->segment(4));
		$data['rows'] = $this->gallery_tbl->showImages($this->uri->segment(4));
                $this->view->add_data('rows', $data['rows']);
                $this->view->add_data('info', $data['info']);
		$this->view->show('Images','gallery/image_view');
	}
	function addimage() {
		$data['info'] = $this->gallery_tbl->viewParticular($this->uri->segment(4));
                $this->view->add_data('info', $data['info']);
		$this->view->show('AddImage','gallery/image_insert');
	}
	function updateimage() {
		$data['rows'] = $this->gallery_tbl->particularImage($this->uri->segment(4));
                $this->view->add_data('rows', $data['rows']);
		$this->view->show('Update Image','gallery/image_update');
	}
	function do_updateimage() {
		$this->gallery_tbl->updateImage();
	}
	function do_upload() {
            
		ini_set("memory_limit","48M");
                
		$this->load->model('gallery/settings_tbl');
                
		$data['settings'] = $this->settings_tbl->viewSettings();
                
		$thumbWidth = $data['settings'][0]->thumb_width;
		$thumbHeight = $data['settings'][0]->thumb_height;
            
		if (isset($_FILES['filename'])) {
			$file = read_file($_FILES['filename']['tmp_name']);
			$maxfilesize = 2000000;
			$uploadsize = ceil($_FILES['filename']['size']);
	
			if ($uploadsize > $maxfilesize || $uploadsize<5 || !isset($uploadsize)) {
				redirect('admin_gallery/gallery/images/'.$_POST['id']);
				exit();
			}
	
			$fname = $_FILES['filename']['name'];
			$ext = strtolower(substr($fname, strrpos($fname,'.')+1));
			$md5Date = Date("Y_m_d_H_i_s");
			$newname = $md5Date.'.'.$ext;
			$thumbname = $md5Date.'_thumb.'.$ext;
			$name = basename($_FILES['filename']['name']);
	
			if ($ext!="jpg"&&$ext&&"jpeg"&&$ext!="png"&&$ext!="gif") {
				redirect('admin_gallery/gallery/images/'.$_POST['id']);
				exit();
			}
                        
			$uploadImage = './uploads/'.$newname;
                       
			if(write_file($uploadImage, $file))
                        {
                            $this->_createThumbnail($md5Date, $ext, $thumbWidth, $thumbHeight, $newname, $thumbname);
                         }
                         else
                         {
                            redirect('admin_gallery/gallery/images/'.$_POST['id']);
                            
                         }
                         
		} else {
                        $this->view->show('View','gallery/gallery_view');
		}
	}
	function _createThumbnail($fileName, $ext, $tw, $th, $newname, $thumbname) {
		$mainimage = './uploads/'.$fileName.'.'.$ext;
		$t = './uploads/'.$fileName.'_thumb'.'.'.$ext;
		
		list($width, $height, $type, $attr) = getimagesize($mainimage);
		             
		$image_width = $width;
		$image_height = $height;
		$image_type = $type;
		
		$scale = 1;
		if($image_width > $image_height) {
			$final_width = $tw;
			$final_height = $th;
		} elseif($image_width == $image_height) {
			$final_width = $tw;
			$final_height = $th;
		} else {
			$final_width = $tw;
			$final_height = $th;
		}

		$x = $final_width/$image_width;
		$y = $final_height/$image_height;

		if($x < $y) {
			$new_width = round($image_width *($final_height/$image_height));
			$new_height = $final_height;
		} else {
			$new_height = round($image_height *($final_width/$image_width));
			$new_width = $final_width;
		}
		$to_crop_left = ($new_width - ($final_width *$scale))/2;
		$to_crop_top = ($new_height - ($final_height *$scale))/2;

		$config['image_library'] = 'GD2';
		$config['source_image'] = $mainimage;
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = true;
		$config['master_dim'] = 'width';
		$config['width'] = $new_width;
		$config['height'] = $new_height;
		$config['quality'] = '100%';

		$this->load->library('image_lib', $config);
		$this->image_lib->resize();
		if(!$this->image_lib->resize()) echo $this->image_lib->display_errors();

		$config['image_library'] = 'GD2';
		$config['source_image'] = $t;
		$config['create_thumb'] = FALSE;
		$config['width'] = $final_width;
		$config['height'] = $final_height;
		$config['x_axis'] = $to_crop_left;
		$config['y_axis'] = $to_crop_top;
		$config['maintain_ratio'] = false;

		$this->image_lib->initialize($config);
		if(!$this->image_lib->crop()) {
			echo $this->image_lib->display_errors();
		} else {
			$this->gallery_tbl->insertImage($_POST['id'], $newname, $thumbname);
		}
	}
	function removeimage() {
		$data['info'] = $this->gallery_tbl->particularImage($this->uri->segment(4));
                $this->view->add_data('info', $data['info']);
		$this->view->show('Delete','gallery/image_delete');
	}
	function do_remove() {
		$full = $this->gallery_tbl->imgToDelete($this->uri->segment(4));
		$thumb = $this->gallery_tbl->thumbToDelete($this->uri->segment(4));
		if(isset($full)) unlink('./uploads/'.$full);
		if(isset($thumb)) unlink('./uploads/'.$thumb);
		$this->gallery_tbl->deleteImage();
	}
}