<?php
class Gallery_model extends Model {
	function Gallery_model() {
		parent::Model();
	}

	function viewXML() {
		$this->db->select('*');
		$this->db->from('gallery_categories');
		$this->db->order_by('order_id', 'asc');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$projArray[] = $row;
				$this->db->select('*');
				$this->db->from('gallery_assets');
				$this->db->order_by('order_num', 'asc');
				$this->db->where('cat_id =', $row->id);
				$query2 = $this->db->get();
				$imgArray = array();
				if ($query2->num_rows() > 0) {
					foreach ($query2->result() as $img) {
						$imgArray[] = $img;
					}
				}
				$row->images = $imgArray;
			}
			$data = $projArray;
			return $data;
		}
	}

        function viewCategoriesWithImage($page) {

                $total_page_count = $this->db->count_all('gallery_categories');
		$entriesPerPage = 12;
                $pagination_info = $this->pagination->get_pagination_info($page, $total_page_count, $entriesPerPage);


		$this->db->select('*');
		$this->db->from('gallery_categories');
		$this->db->order_by('date', 'desc');
                $this->db->limit($entriesPerPage, (($pagination_info['page'] - 1) * $entriesPerPage));
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$projArray[] = $row;
				$this->db->select('thumbnail');
				$this->db->from('gallery_assets');
				$this->db->order_by('order_num', 'asc');
				$this->db->where('cat_id =', $row->id);
                                $this->db->limit(1,0);
				$query2 = $this->db->get();
                               
				if ($query2->num_rows() > 0) {
                               
                                        $row->thumbnail = $query2->row()->thumbnail;
				}

			}
			$data = $projArray;
			return array('list'=>$data,'pagination_info' => $pagination_info);
		}
	}

        function showImages($catID) {
		$this->db->select('*');
		$this->db->from('gallery_categories');
		$this->db->where('id', $catID);
		$query = $this->db->get();
                if ($query->num_rows() > 0) {
                    $row = $query->row();
                    $this->db->select('*');
                    $this->db->from('gallery_assets');
                    $this->db->order_by('order_num', 'asc');
                    $this->db->where('cat_id =', $catID);
                    $query2 = $this->db->get();
                    $imgArray = array();
                    if ($query2->num_rows() > 0) {
                            foreach ($query2->result() as $img) {
                                    $imgArray[] = $img;
                            }
                    }
                    $row->images = $imgArray;
                   
                    $a = $this->addSibling($catID);

                    $row->nextId = $a->nextId;
                    $row->prevId = $a->prevId;                  

                    return $row;
                }

	}

        function addSibling($catID){
            $this->db->select('date');
            $this->db->from('gallery_categories');
            $this->db->where('id =', $catID);
            $query = $this->db->get();

            foreach ($query->result() as $row){
                $day = $row->date;
            }

            $this->db->select('id');
            $this->db->from('gallery_categories');
            $this->db->where('date <', $day);
            $this->db->order_by('date','desc');
            $this->db->limit(1);
            $query = $this->db->get();
            foreach ($query->result() as $row) {
                $nextId = $row->id;
            }   

            $this->db->select('id');
            $this->db->from('gallery_categories');
            $this->db->where('date >', $day);
            $this->db->order_by('date','asc');
            $this->db->limit(1);
            $query = $this->db->get();
            foreach ($query->result() as $row) {
                $prevId = $row->id;
            }
            if( $nextId )
                $result->nextId = $nextId;
            else
                $result->nextId = "";

            if( $prevId )
                $result->prevId = $prevId;
            else
                $result->prevId = "";
            
            return $result;

        }
}