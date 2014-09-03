<?php

class googlecal_model extends Model {

    function __construct() {
        parent::__construct();
    }

    public function getClassListbyMonth($user, $pass, $startDate, $endDate) {
        $knittyEventList = array();

        $user = "songjaehan@gmail.com";
        $pass = "heeyong";
        $startDate = '2010-09-01';
        $endDate = '2010-09-31';

        $this->load->helper("zend_framework");

        Zend_Loader::loadClass('Zend_Gdata_Calendar');
        Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
        // Parameters for ClientAuth authentication

        $service = Zend_Gdata_Calendar::AUTH_SERVICE_NAME;
        $client = Zend_Gdata_ClientLogin::getHttpClient($user, $pass, $service);
        $gcal = new Zend_Gdata_Calendar($client);

        $calFeed = $gcal->getCalendarListFeed(); // get all calendars the user has created
        $i = 0;

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

            foreach ($eventFeed as $event) {

                $evtTitle = stripslashes($event->title);
                $evtSummary = $event->summary;
                $eventDesc =  $event->summary;

                $evtquery = $gcal->newEventQuery();
                $evtquery->setUser(NULL);
                $evtquery->setVisibility(NULL);
                $evtquery->setProjection(NULL);

                $evtquery->setEvent($event->id);

                try {
                    $eventEntry = $gcal->getCalendarEventEntry($query);
                    $evtWhen = $eventEntry->when;

                    $knittyEventList[$i] = array(
                        'eventTitle'    => $evtTitle,
                        'eventSummary'  => $evtSummary,
                        'eventStart'    => $eventEntry->when[0]->starttime,
                        'eventEnd'      => $eventEntry->when[0]->endtime,
                        'eventDesc'     => $eventDesc
                    );
                } catch (Zend_Gdata_App_Exception $e) {
                    //var_dump($e);
                    return null;
                }
                $i = $i + 1;
            }
            return $knittyEventList;
        }

    }

    public function test() {

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
                //echo "summary " . var_dump($event->summary) . " <br/>\n";

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

}
?>