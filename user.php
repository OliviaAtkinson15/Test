<?php

require_once('dbconnect.php');

$sqlIncomplete    = "SELECT id, name, detail, is_completed FROM listitems where is_completed = 'no' ORDER 
                     BY id desc";

$result           = mysqli_query($db, $sqlIncomplete);

//Fetch all imcomplete list items
$incomleteItems   = mysqli_fetch_all($result,MYSQLI_ASSOC);

//Get incomplete items
$sqlCompleted     = "SELECT id, name, detail, is_completed FROM listitems where is_completed = 'yes' ORDER 
                     BY id desc";

$completeResult    = mysqli_query($db, $sqlCompleted);

//Fetch all complted items
$completeItems     = mysqli_fetch_all($completeResult, MYSQLI_ASSOC);

//query for task in progress
$inProgress = mysqli_query($db, "SELECT id, name, detail, is_completed FROM listitems where is_completed = 'maybe' ORDER 
BY id desc");

//fetch all in progress task
$inProgressTask = mysqli_fetch_all($inProgress,MYSQLI_ASSOC);

//Free result set
mysqli_free_result($completeResult);
mysqli_free_result($result);
mysqli_free_result($inProgress);

mysqli_close($db);


?>
<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>jQuery Drag and Drop TODO List with PHP MySQL</title>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <style>
        .li_containers{
            width: 52%;
            float: left;
        }
        .listitems {
            width: 150px;
            height: 150px;
            padding: 0.5em;
            float: left;
            margin: 10px 10px 10px 0;
            border: 1px solid black;
            font-weight: normal;
        }

        #droppable {
            width:   550px;
            height:  550px;
            padding: 0.5em;
            float:   right;
            margin:  10px;
            cursor:  pointer;
        }
    </style>
</head>

<body>

<p><h2 align="center">jQuery Drag and Drop TODO List with PHP MySQL</h2></p>
<div class="li_containers">

    <?php foreach ($incomleteItems as $key => $item) { ?>

        <div class="ui-widget-content listitems" data-itemid=<?php echo $item['id'] ?> > task not done

            <p><strong><?php echo $item['name'] ?></strong></p>

            <hr />

            <p><?php echo $item['detail'] ?></p>

        </div>

    <?php } ?>

</div>
<div id="droppableP" class="ui-widget-header">

    <?php foreach ($inProgressTask as $key => $pitem) { ?>

        <div class="listitems" itemid=<?php echo $item['id'] ?>> in progress

            <p><strong><?php echo $pitem['name'] ?></strong></p>

            <hr />

            <p><?php echo $pitem['detail'] ?></p>

        </div>

    <?php } ?>

</div>

<div id="droppable" class="ui-widget-header">

    <?php foreach ($completeItems as $key => $citem) { ?>

        <div class="listitems" > task done

            <p><strong><?php echo $citem['name'] ?></strong></p>

            <hr />

            <p><?php echo $citem['detail'] ?></p>

        </div>

    <?php } ?>

</div>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>

    $( function() {

        $( ".listitems" ).draggable();

        $( "#droppable" ).droppable({

            drop: function( event, ui ) {

                $(this).addClass( "ui-state-highlight" );

                var itemid = ui.draggable.attr('data-itemid');

                let itemid2 = ui.draggable.attr('itemid');

                $.ajax({
                    method: "POST",

                    url: "update.php",
                    data:{'itemid': itemid},
                    data:{'itemid2':itemid2},
                }).done(function( data ) {
                    var result = $.parseJSON(data);

                });
            }
        });

    });
</script>
</body>
</html>