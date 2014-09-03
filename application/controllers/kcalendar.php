<?php

class Kcalendar extends MY_Controler {

	function __construct()
	{
		parent::__construct();

		$this->load->model('admin/kcalendar_model');
                $this->load->model('admin/kclass_model');
                $this->load->model('admin/kevent_model');

                $this->load->model('Home_model');
                
                $homeViewModelContainer = $this->Home_model->getViewModel();

                $this->view->add_data('homeViewModelContainer', $homeViewModelContainer);
	}

	function index()
	{
		//$this->overview();
                 $this->view->show_knitty('kcalendar','fullcal','calendar_template');
        }

	function overview_old($page = 1)
	{
        
               	$this->load->library('Pagination');
		$this->load->library('form_validation');

		$this->view->add_data('kcalendar_list', $this->kcalendar_model->get_kcalendar_list($page));
                $this->view->add_data('kclass_list', $this->kclass_model->get_kclass_list($page));
                $this->view->add_data('kevent_list', $this->kevent_model->get_kevent_list($page));             

                //show_knitty($page_title = '', $view_name = '', $template_name, $debug = FALSE, $simple = FALSE, $add_data = TRUE)
                 $this->view->show_knitty('kcalendar','kcalendar_overview','calendar_template');        
                 

	}

        function overview($month = 1)
	{
                $this->load->library('Pagination');
		$this->load->library('form_validation');
                
                //echo var_dump($this->kclass_model->get_kcalendar_list_by_month($month));
                //exit;

		$this->view->add_data('kcalendar_list', $this->kcalendar_model->get_kcalendar_list_by_month($month));
                
                $this->view->add_data('kclass_list', $this->kclass_model->get_kcalendar_list_by_month($month));

                $this->view->add_data('kevent_list', $this->kevent_model->get_kcalendar_list_by_month($month));

                $this->view->show_knitty('kcalendar','fullcal','calendar_template');

	}

        function ajaxview()
	{
               

                $this->load->library('Pagination');

                $start = $this->input->post('start');

                $end = $this->input->post('end');

               
                $start = date('Y-m-d H:i:s', $start);

                $end = date('Y-m-d H:i:s', $end);
                //$start = '2009-10-1';
                //$end = '2010-11-30';
                 
		$kcalendar_list = $this->kcalendar_model->get_kcalendar_list_by_range($start,$end);

                
                 
                 
                $kclass_list =  $this->kclass_model->get_kcalendar_list_by_range($start,$end);
                //$kclass_list =  $this->kclass_model->get_kclass_list(1);
               
                
                $kevent_list = $this->kevent_model->get_kcalendar_list_by_range($start,$end);

                $cal_data = array();

                
               // echo var_dump($kcalendar_list);die();
               foreach ($kcalendar_list as $cal)
               {
                   $cal_data[] = array('className' => 'knittyCal_calendar',
                                        'title'  => $cal['calendarTitle'],
                                        'start'  => $cal['calendarDate'],
                                        'end' =>  $cal['calendarEndDate'] );

               }

               foreach ($kevent_list as $evt)
               {
                   $cal_data[] = array('className' =>'knittyCal_event',
                                        'title'  => $evt['eventTitle'],
                                        'start'  => $evt['eventDate'],
                                        'end' => $evt['eventEndDate'],
                                        'url' => base_url()."/kevent/view/".$evt['event_id']);

               }

               foreach ($kclass_list as $cls)
               {
                   $cal_data[] = array('className' =>'knittyCal_class',
                                        'title'  => $cls['classTitle'],
                                        'start'  => $cls['classDate'],
                                        'url' => base_url()."/kclass/view/".$cls['class_id']);

               }



               //echo var_dump($cal_data);die();


               echo json_encode( $cal_data);


	}

	function view($calendar_id = FALSE)
	{
		if($calendar_id == FALSE)
		{
			redirect('admin/kcalendar/overview');
		}
		else
		{
			if($this->kcalendar_model->is_valid_kcalendar($calendar_id))
			{

				$this->load->library('form_validation');
				$this->form_validation->set_error_delimiters('', '#;#');
				if ($this->form_validation->run('kcalendar') == FALSE)
				{
                                    $this->message_storage->add_validation_errors($this->form_validation->error_string());
				}
				else
				{

					$this->kcalendar_model->edit($calendar_id);
					$this->message_storage->add_session_notice('calendar edited');
					redirect('admin/kcalendar/edit/'.$calendar_id);
				}

				$kcalendar = $this->kcalendar_model->get_kcalendar($calendar_id);

				$this->view->add_data('kcalendar', $kcalendar);
				//$this->view->show('Edit calendar', 'kcalendar_edit');
                                $this->view->show_knitty('calendar', 'kcalendar_view','calendar_template');
			}
			else
			{
				redirect('admin/kcalendar/overview');
			}
		}
	}

        

	function sort($direction = 'up', $page_id = FALSE)
	{
		if($page_id == FALSE)
		{
			redirect('admin/kcalendar/overview');
		}
		else
		{
			if($this->kcalendar_model->is_valid_page($calendar_id))
			{
				switch($direction)
				{
					case 'up':
						$this->kcalendar_model->sort($direction, $calendar_id);
						break;
					case 'down':
						$this->kcalendar_model->sort($direction, $calendar_id);
						break;
					default:
						break;
				}
				redirect('admin/kcalendar/overview');
			}
			else
			{
				redirect('admin/kcalendar/overview');
			}
		}
	}
         function displayFullCal(){

            $this->load->view('fullcal');
        }


}

/* End of file page.php */
/* Location: ./application/controllers/admin/page.php */