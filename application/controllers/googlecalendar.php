<?php

class Googlecalendar extends MY_Controler {

    function __construct() {
        parent::Controller();
        $this->load->model('admin/Googlecal_model');
    }

    function index() {

        $user = "songjaehan@gmail.com";
        $pass = "heeyong";
        $startDate = '2010-09-01';
        $endDate = '2010-09-31';

        
        $myGoogleCal = $this->Googlecal_model->getClassListbyMonth($user, $pass, $startDate, $endDate);

        foreach($myGoogleCal as $mycal){
            
            echo $mycal['eventTitle'] . "<br/>";
            echo $mycal['eventSummary'] . "<br/>";

            echo $mycal['eventStart'] . "<br/>";
            echo $mycal['eventEnd'] . "<br/>";
            echo $mycal['eventDesc'] . "<br/>";

        }
        
    }

    function index2() {
        $startDate = '2010-09-01';
        $endDate = '2010-09-31';

        $this->load->helper("zend_framework");

        Zend_Loader::loadClass('Zend_Gdata_Calendar');
        Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
        // Parameters for ClientAuth authentication

        $user = "songjaehan@gmail.com";
        $pass = "heeyong";

        $service = Zend_Gdata_Calendar::AUTH_SERVICE_NAME;
        $client = Zend_Gdata_ClientLogin::getHttpClient($user, $pass, $service);
        $gcal = new Zend_Gdata_Calendar($client);

        $calFeed = $gcal->getCalendarListFeed(); // get all calendars the user has created

        echo "<ul>";

        foreach ($calFeed as $calendar) {
            $url = $calendar->link[0]->href;
            $query = $gcal->newEventQuery($url);

            $query->setUser(NULL);
            $query->setVisibility(NULL);
            $query->setProjection(NULL);
            $query->setOrderby('starttime');
            $query->setStartMin($startDate);
            $query->setStartMax($endDate);
            $eventFeed = $gcal->getCalendarEventFeed($query);
            //â€¦ do something with $eventFeed

            echo "<br/><h1>Calendar List Feed</h1>";
            echo "<li>" . $calendar->title .
            "<br/> (Event Feed: " . $calendar->id . ")</li>";

            echo "<br/>" . $eventFeed->title;
            echo "<br/> events(s) found " . $eventFeed->totalResults;

            echo "<ol><ul>";
            foreach ($eventFeed as $event) {
                echo "<li>\n";
                echo "<h2>" . stripslashes($event->title) . "</h2>\n";
                //echo "summary " . $event->startTime . " <br/>\n";
                echo "summary " .  $event->summary . " <br/>\n";

                $evtquery = $gcal->newEventQuery();
                $evtquery->setUser('default');
                $evtquery->setVisibility('private');
                $evtquery->setProjection('full');
                $evtquery->setEvent($event->id);

              try {
                $eventEntry = $gcal->getCalendarEventEntry($query);
                //var_dump($eventEntry);
                //echo "<br/>".$eventEntry->getTitle() . "<br/>";
                //echo "<br/>".$eventEntry->getWhen();
                $evtWhen = $eventEntry->when;
                                echo "<br/>starts " . $eventEntry->when[0]->starttime;
                                echo "<br/>ends " . $eventEntry->when[0]->endtime;
              } catch (Zend_Gdata_App_Exception $e) {
                    var_dump($e);
                return null;
              }

                echo "</li>";
            }
            echo "</ul></ol>";
        }
    }


    public function index3(){

        $this->load->helper("zend_framework");

        Zend_Loader::loadClass('Zend_Gdata_Calendar');
        Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
        // Parameters for ClientAuth authentication

        $user = "songjaehan@gmail.com";
        $pass = "heeyong";

        $service = Zend_Gdata_Calendar::AUTH_SERVICE_NAME;
        $client = Zend_Gdata_ClientLogin::getHttpClient($user, $pass, $service);
        $gcal = new Zend_Gdata_Calendar($client);

//        try {
//            $listFeed = $service->getCalendarListFeed();
//
//
//        } catch (Zend_Gdata_App_Exception $e) {
//            echo "Error: " . $e->getMessage();
//        }
//        echo "<h1>Calendar List Feed</h1>";
//        echo "<ul>";
//        foreach ($listFeed as $calendar) {
//            echo "<li>" . $calendar->title .
//            " (Event Feed: " . $calendar->id . ")</li>";
//        }
//
//        echo "</ul>";
// 이벤트 목록을 얻기 위해 질의 생성
        $startDate='2010-09-01';
        $endDate='2010-09-31';

        $query = $gcal->newEventQuery();
        $query->setUser('default');
        $query->setVisibility('private');
        $query->setProjection('basic');
        $query->setStartMin($startDate);
        $query->setStartMax($endDate);


        // 캘린더 피드 획득과 해석
        // 결과 출력
        try {
            $feed = $gcal->getCalendarEventFeed($query);
        } catch (Zend_Gdata_App_Exception $e) {
            echo "Error: " . $e->getResponse();
        }

        echo $feed->title;
        echo " events(s) found " . $feed->totalResults;

        echo "<ol><ul>";
        foreach ($feed as $event) {
            echo "<li>\n";
            echo "<h2>" . stripslashes($event->title) . "</h2>\n";
            echo "summary " . $event->summary. " <br/>\n";
            //echo "subtitle " . stripslashes($event->subtitle) . " <br/>\n";
//            echo "<pre>";
//            echo var_dump($event);
//            echo "</pre>";
        }
    }
}
  
?>
