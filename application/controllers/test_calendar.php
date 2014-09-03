<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test_Calendar extends Controller {

    function index(){
		$this->load->view('welcome_message');
    }

	function Test_Calendar(){
		parent::Controller();
    	$this->load->model('MCalendar');
    	$this->load->library('parser');
    	
  	}

  	function test(){
  		
  		$this->load->library('calendar');
		$data['events']=$this->MCalendar->getEvents($time);
		echo $this->calendar->generate();
		$this->load->view('mycal_view', $data);
  		
  	}
  	
  	function testtwo(){
  		$this->load->library('calendar');

$data = array(
               3  => 'http://example.com/news/article/2010/03/',
               7  => 'http://example.com/news/article/2010/07/',
               13 => 'http://example.com/news/article/2010/13/',
               26 => 'http://example.com/news/article/2010/26/'
             );

echo $this->calendar->generate(2010, 3, $data);
		  		
  	}
  	
  	function testthree (){
  		$prefs = array (
               'show_next_prev'  => TRUE,
               'next_prev_url'   => base_url().'index.php/test_calendar/testthree/'
             );

$this->load->library('calendar', $prefs);

echo $this->calendar->generate($this->uri->segment(3), $this->uri->segment(4));

  	}
  	
  	function testfour(){
  		$prefs['template'] = '

   {table_open}<table border="0" cellpadding="0" cellspacing="0" class="testcal" >{/table_open}

   {heading_row_start}<tr>{/heading_row_start}

   {heading_previous_cell}<th><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
   {heading_title_cell}<th colspan="{colspan}">{heading}</th>{/heading_title_cell}
   {heading_next_cell}<th><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}

   {heading_row_end}</tr>{/heading_row_end}

   {week_row_start}<tr>{/week_row_start}
   {week_day_cell}<td>{week_day}</td>{/week_day_cell}
   {week_row_end}</tr>{/week_row_end}

   {cal_row_start}<tr>{/cal_row_start}
   {cal_cell_start}<td>{/cal_cell_start}

   {cal_cell_content}<a href="{content}">{day}</a>{/cal_cell_content}
   {cal_cell_content_today}<div class="highlight"><a href="{content}">{day}</a></div>{/cal_cell_content_today}

   {cal_cell_no_content}{day}{/cal_cell_no_content}
   {cal_cell_no_content_today}<div class="highlight">{day}</div>{/cal_cell_no_content_today}

   {cal_cell_blank}&nbsp;{/cal_cell_blank}

   {cal_cell_end}</td>{/cal_cell_end}
   {cal_row_end}</tr>{/cal_row_end}

   {table_close}</table>{/table_close}
';

$this->load->library('calendar', $prefs);

echo $this->calendar->generate();
  	}
  
  	function testfive(){
  		$this->load->library('calendar');
  		$this->calendar->parse_template();
  	}
}
  