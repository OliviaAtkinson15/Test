<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8' />
    <link href='fullcalendar.min.css' rel='stylesheet' />
    <link href='fullcalendar.print.min.css' rel='stylesheet' media='print' />
    <script src='lib/moment.min.js'></script>
<!--    <script src='lib/jquery.min.js'></script>-->
    <script src='fullcalendar.min.js'></script>

    <script>
        $(document).ready(function () {

            // function to check mobile view width

            function mobileCheck() {
                if (window.innerWidth < 1000 )
                {
                    return false;
                } else {
                    return true;
                }
            };

            var calendar = $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,basicWeek,basicDay'
                },
                defaultView: mobileCheck() ? "month" : "basicWeek", // check calender open in mobile or desktop
                navLinks: true, // can click day/week names to navigate views
                editable: true,
                eventLimit: true,
                events: "all_events.php",
                displayEventTime: false,
                longPressDelay : mobileCheck() ? '' : '1',
                eventRender: function (event, element, view) {
                    if (event.allDay === 'true') {
                        event.allDay = true;
                    } else {
                        event.allDay = false;
                    }
                },
                selectable: true,
                selectHelper: true,
                select: function (start, end, allDay) {
                    var title = prompt('Task Detail:');
                    if (title) {
                        var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                        var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");

                        // Add new event ajax Post

                        $.ajax({
                            url: 'add_event.php',
                            data: 'title=' + title + '&start=' + start + '&end=' + end,
                            type: "POST",
                            success: function (data) {

                                calendar.fullCalendar('renderEvent',
                                    {
                                        id: data,
                                        title: title,
                                        start: start,
                                        end: end,
                                        allDay: allDay,
                                    },
                                    true
                                );

                                displayMessage("Added Successfully");

                            }
                        });

                    }
                    calendar.fullCalendar('unselect');
                },
                editable: true,
                eventDrop: function (event, delta) {
                    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");

                    // By Drag and drop update event date

                    $.ajax({
                        url: 'change_event_date.php',
                        data: 'title=' + event.title + '&start=' + start + '&end=' + end + '&id=' + event.id,
                        type: "POST",
                        success: function (response) {
                            displayMessage("Updated Successfully");
                        }
                    });
                },
                eventClick: function (event) {
                    var confimit = confirm("Do you really want to delete?");
                    if (confimit) {

                        // delete specific event

                        $.ajax({
                            type: "POST",
                            url: "delete_event.php",
                            data: "&id=" + event.id,
                            success: function (response) {

                                if(parseInt(response) > 0) {

                                    $('#calendar').fullCalendar('removeEvents', event.id);
                                    displayMessage("Deleted Successfully");
                                }
                            }
                        });
                    }
                }
            });

        });
        // function to display message
        function displayMessage(message) {
            $(".response").html("<div align='center' style='padding:10px;font-size:12px;color:#3539EA' class='success'>"+message+"</div>");
            setInterval(function() { $(".success").fadeOut(); }, 1000);
        }
    </script>





    <style>
        body {
            margin: 40px 10px;
            padding: 0;
            font-family: Arial;
            font-size: 14px;
        }
        #calendar {
            max-width: 400px;
            margin: 0 auto;
        }
    </style>
</head>
<body>

<div class="response"></div>
<div id='calendar'></div>
</body>
<!-- by Francis -->
</html>