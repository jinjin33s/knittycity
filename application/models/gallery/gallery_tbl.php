<?php
class Gallery_tbl extends Model {
	function Gallery_tbl() {
		parent::Model();	
	}
	function viewCategories() {
		$this->db->select('B.id, B.title, B.date, A.thumbnail');
		$this->db->from('gallery_assets A, gallery_categories B');
                $this->db->where('A.cat_id = B.id AND A.order_num = 1');
		$this->db->order_by('B.date', 'DESC');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}  
	function viewParticular($catID) {
		$this->db->select('id, title, date, description');
		$this->db->from('gallery_categories');
		$this->db->where('id', $catID);	
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}
	function insertCategory() {
		if (isset($_POST['title'])) {
			$this->title = $_POST['title'];
                        $this->date = $_POST['date'];
			$this->order_id = $_POST['order_id'];
			$this->description = $_POST['description'];
			$insertNew = $this->db->insert('gallery_categories', $this);
			if ($insertNew) {
				redirect('admin_gallery/gallery');
			} else {
				echo("Fail");
			}
		}
	}
	function updateCategory() {
		if (isset($_POST['title'])) {
			$this->title = $_POST['title'];
                        $this->date = $_POST['date'];
			$this->order_id = $_POST['order_id'];
			$this->description = $_POST['description'];
			$insertNew = $this->db->update('gallery_categories', $this, array('id' => $_POST['id']));
			if ($insertNew) {
				redirect('admin_gallery/gallery');
			} else {
				echo("Fail");
			}
		}
	}
	function deleteCategory() {
		$deleteRow =  $this->uri->segment(4);
		if (isset($deleteRow)) {
			$this->db->where('id', $deleteRow);
			$del = $this->db->delete('gallery_categories');
			if ($del) {
				$delImages = $this->db->get_where('gallery_assets',array('cat_id'=>$deleteRow));
				if ($delImages->num_rows() > 0) {
					foreach ($delImages->result() as $img) {
						unlink('./uploads/'.$img->filename);
						unlink('./uploads/'.$img->thumbnail);
					}
				}
				$delImg = $this->db->delete('gallery_assets' , array('cat_id' => $deleteRow));
				redirect('admin_gallery/gallery');
			} else {
				echo("Fail");
			}
		}
	}
	function showImages($catID) {
		$this->db->select('*');
		$this->db->from('gallery_assets');
		$this->db->where('cat_id', $catID);
		$this->db->order_by('gallery_assets.order_num', 'ASC');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}
	function particularImage($id) {
		$this->db->select('img_id, filename, thumbnail, order_num, caption, cat_id');
		$this->db->from('gallery_assets');
		$this->db->where('img_id', $id);	
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}
	function insertImage($catId, $filename, $thumbname) {
		if (isset($_POST['id'])) {
			$this->cat_id = $catId;
			$this->caption = $_POST['caption'];
			$this->order_num = $_POST['order_num'];
			$this->filename = $filename;
			$this->thumbnail = $thumbname;
			$insertNew = $this->db->insert('gallery_assets', $this);
			if ($insertNew) {
				redirect('admin_gallery/gallery/images/'.$_POST['id']);
			} else {
				echo("Fail");
			}
		}
	}
	function updateImage() {
		if (isset($_POST['img_id'])) {
			$this->caption = $_POST['caption'];
			$this->order_num = $_POST['order_num'];
			$insertNew = $this->db->update('gallery_assets', $this, array('img_id' => $_POST['img_id']));
			if ($insertNew) {
				redirect('admin_gallery/gallery/images/'.$_POST['cat_id']);
			} else {
				echo("Fail");
			}
		}
	}
	function deleteImage() {
		$deleteRow =  $this->uri->segment(4);
		if (isset($deleteRow)) {
			$this->db->where('img_id', $deleteRow);
			$insertNew = $this->db->delete('gallery_assets');
			if ($insertNew) {
				redirect('admin_gallery/gallery');
			} else {
				echo("Fail");
			}
		}
	}
	function imgToDelete($fileid){
		$query = $this->db->get_where('gallery_assets',array('img_id'=>$fileid));
		$result = $query->result();
		return $result[0]->filename;
	}
	function thumbToDelete($fileid){
		$query = $this->db->get_where('gallery_assets',array('img_id'=>$fileid));
		$result = $query->result();
		return $result[0]->thumbnail;
	}

                       	
        function get_gallery_list_for_home() {

		$this->db->select('id');
		$this->db->from('gallery_categories');
		$this->db->order_by('id', 'desc');
                $this->db->limit(1);
		$query = $this->db->get();
                
                if ($query->num_rows() > 0) {

			foreach ($query->result() as $row) {
                            $catID = $row->id;

                            $this->db->select('*');
                            $this->db->from('gallery_assets');
                            $this->db->where('cat_id', $catID);
                            $this->db->order_by('gallery_assets.order_num', 'ASC');
                            //$this->db->limit(1);

                            $query = $this->db->get();
                            return $query->result();
                            
			}
			return $data;
		}

        }

        function get_random_pics() {

		$this->db->select('thumbnail');
		$this->db->from('gallery_assets');
                $this->db->order_by('rand()');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
        }

}