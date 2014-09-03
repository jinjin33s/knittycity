 <script type="text/javascript">
                            $(document).ready(function() {

                        // page is now ready, initialize the calendar...

                            $('#calendar').fullCalendar({
                                theme:true,
                                events: [
                                    {
                                        id : '1',
                                        title  : 'event1',
                                        start  : '2010-09-01 1:00:00'
                                    },
                                    {
                                        id : '1',
                                        title  : 'event2',
                                        start  : '2010-09-05 14:30:00'
                                    },
                                    {
                                          id : '1',
                                        title  : 'event5',
                                        start  : '2010-09-05 12:30:00'
                                    },
                                    {
                                        id : '1',
                                        title  : 'event3',
                                        start  : '2010-09-09 12:30:00',
                                        allDay : false // will make the time show
                                    }
                                ]
                            })

                    });


                    </script>
<div class="post_view">
<div id='calendar' style="width:500px; height:500px;"></div>

</div>