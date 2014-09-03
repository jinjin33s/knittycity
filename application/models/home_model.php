<?php

class Home_model extends Model {

    function __construct() {
        parent::__construct();
    }


    public function getViewModel() {

        $post_list = $this->getPosts();
        $event_list = $this->getEventList();
        $class_list = $this->getClassList();
        $profile_list = $this->getProfileList();
        $gallery_list = $this->getGalleryList();
        $product_list = $this->getStoreProducts();
        $random_list = $this->getRamdomList();

        $viewModel = array();
        $viewModel['post_list'] = $post_list;
        $viewModel['event_list'] = $event_list;
        $viewModel['kclass_list'] = $class_list;
        $viewModel['kprofile_list'] = $profile_list;
        $viewModel['gallery_list'] = $gallery_list;
        $viewModel['product_list'] = $product_list;
        $viewModel['random_list'] = $random_list;

        //$postModel = new Post_model();
        return $viewModel;
    }

    public function getEventList(){
        $this->load->model('admin/Kevent_model');
        $eventModel = new Kevent_model();
        return $eventModel->get_kevent_list_for_home(2);
    }


    public function getClassList(){
        $this->load->model('admin/Kclass_model');
        $classModel = new Kclass_model();

        return $classModel->get_kclass_list_for_home(2);
    }


    public function getProfileList(){
        $this->load->model('admin/Kprofile_model');
        $profileModel = new Kprofile_model();
        
        return $profileModel->get_kprofile_list_for_home(1);
    }


    public function getGalleryList(){
        $this->load->model('gallery/Gallery_tbl');
        $galleryModel = new Gallery_tbl();
        
        return $galleryModel->get_gallery_list_for_home(1);
    }

    public function getRamdomList(){
        $this->load->model('gallery/Gallery_tbl');
        $galleryModel = new Gallery_tbl();

        return $galleryModel->get_random_pics(1);
    }

  public function getPosts() {

        $this->db->select('post_id, post_title, post_content, post_excerpt, post_url_name, user_name');
        $this->db->select("DATE_FORMAT(post_date_publish, '" . $this->config->item('config_small_date_format') . "')AS post_date_publish_formatted", FALSE);
        $this->db->select("DATE_FORMAT(post_date_create, '" . $this->config->item('config_date_format') . "') AS post_date_create_formatted", FALSE);
        $this->db->select('(SELECT COUNT(*) FROM comment WHERE comment_post_id = post_id AND comment_is_approved = 1) as comment_count', FALSE);
        $this->db->from('post');
        $this->db->join('user', 'post_author_user_id = user_id');
        $this->db->where('post_is_published', 1);
        $this->db->order_by('post_date_create', 'desc');
        $this->db->limit(3);
        $result = $this->db->get();

        $post_list = $result->result_array();
        return $post_list;
    }

    
    public function getStoreProducts() {
        $DB_PRE = " oc_";
        $config_language_id = 1;
        $config_store_id = 0;


        $conn;
        if (!$conn = mysql_connect('db1696.perfora.net', 'dbo344845458', 'zachary')) {
            echo('Error: Could not make a database connection using ' . $username . '@' . $hostname);
        }


        if (!mysql_select_db('db344845458', $conn)) {
            echo('Error: Could not connect to database ' . 'db344845458');
        }

        mysql_query("SET NAMES 'utf8'", $conn);
        mysql_query("SET CHARACTER SET utf8",$conn);
        mysql_query("SET CHARACTER_SET_CONNECTION=utf8", $conn);
        mysql_query("SET SQL_MODE = ''",$conn);

        //$this->db->select(" name ");
        //$this->db->from('oc_product_description');
        $querystr = 'SELECT p.product_id, pd.name AS name, p.image, m.name AS manufacturer, ss.name AS stock, '
         . ' wcd.unit AS weight_class FROM oc_product p LEFT JOIN '
                        . "oc_product_description pd ON (p.product_id = pd.product_id) LEFT JOIN "
                        . "oc_product_to_store p2s ON (p.product_id = p2s.product_id) LEFT JOIN "
                        . "oc_manufacturer m ON (p.manufacturer_id = m.manufacturer_id) LEFT JOIN "
                        . "oc_stock_status ss ON (p.stock_status_id = ss.stock_status_id) LEFT JOIN "
                        . "oc_weight_class_description wcd ON (p.weight_class_id = wcd.weight_class_id) WHERE pd.language_id = '"
                        . "1' AND p2s.store_id = '"
                        . "0' AND wcd.language_id = '"
                        . "1' AND ss.language_id = '"
                        . "1' AND p.date_available <= NOW() AND p.status = '1' order by date_added desc limit 3";

        $query = $this->query($querystr, $conn);
        return $query;
        $product_list = $query;
        return $product_list;
    }

  

    public function query($sql, $connection) {

        $resource = mysql_query($sql, $connection);

        if ($resource) {
            if (is_resource($resource)) {
                $i = 0;

                $data = array();

                while ($result = mysql_fetch_assoc($resource)) {
                    $data[$i] = $result;

                    $i++;
                }

                mysql_free_result($resource);

                return $data;
                
                $query = new stdClass();
                $query->row = isset($data[0]) ? $data[0] : array();
                $query->rows = $data;
                $query->num_rows = $i;

                unset($data);

                return $query;
            } else {
                return TRUE;
            }
        } else {
            exit('Error: ' . mysql_error($connection) . '<br />Error No: ' . mysql_errno($connection) . '<br />' . $sql);
        }
    }

}

/*
 * $this->load->model('Category_model');
  }

  function index()
  {
  redirect('post/overview');
  }

  function view($category_id = FALSE, $page = 1)
  {
  if($category_id == FALSE)
  {
  redirect('post/overview');
  }
  else
  {
  if($this->Category_model->is_valid_category($category_id))
  {
  $this->load->library('Pagination');
  $this->view->add_data('post_list', $this->Category_model->get_post_list($category_id, $page));
  $category = $this->Category_model->get_category($category_id);
  $this->view->add_data('category_id', $category_id);
  $this->view->show('Category - '.$category['category_name'], 'category_view');
  }
 */
