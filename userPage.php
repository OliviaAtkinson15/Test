
<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location:login.php");

}
//echo $_SESSION['use'];
//echo '  login successful';

include('dbconnect.php');

//when the task is assigned, i will use session to get the task for the user that is signed in and that wil be equal to $result.

//select where is_complete is no
$user = $_SESSION['user'];
echo $user;
$result1 = mysqli_query($db,"SELECT * FROM tasks AS T, team_users AS U WHERE T.assigned_to = U.ID AND FirstName = '$user' AND is_completed = 'no'");
$mytask = mysqli_fetch_all($result1,MYSQLI_ASSOC);


//$result = mysqli_query($db, "SELECT id, task, is_completed FROM tasks where is_completed = 'no' ORDER 
//BY id desc");

//fetch all incomplete task
//$incompleteTask = mysqli_fetch_all($result,MYSQLI_ASSOC);

//Select task in progress where is_complete is maybe
$inProgress = mysqli_query($db, "SELECT id, task, is_completed FROM tasks where is_completed = 'maybe' ORDER 
BY id desc");

//fetch all in progress task
$inProgressTask = mysqli_fetch_all($inProgress,MYSQLI_ASSOC);


//select completed task where is_complete is yes
$completeResult = mysqli_query($db, "SELECT id, task, is_completed FROM tasks where is_completed = 'yes' ORDER 
BY id desc");

//fetch all complete task
$completeTask = mysqli_fetch_all($completeResult,MYSQLI_ASSOC);

//result set
mysqli_free_result($completeResult);
mysqli_free_result($result1);
mysqli_free_result($inProgress);


mysqli_close($db);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Jomhuria&family=Lobster&display=swap" rel="stylesheet">
    <!-- jquery -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <!-- Image and text -->
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="#">
            <img src="assets/collabo_logo.jpeg" width="30" height="30" class="d-inline-block align-center" alt="collaborations logo"><b class="logoName">
                Collaborations...</b></a>
        <?php
        echo '<h1>Hello '. $_SESSION['user'].'</h1>';
        ?>

        <ul class="nav justify-content-center">
            <li class="nav-item">
                <a class="nav-link active" href="home.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="userTest.php">My Page</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="team_page.php">Team Page</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="pBacklog.php">Product Backlog</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="try.php">Sprint Planning</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="">Daily Sprint</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Chat.php">Sprint Retrospective</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="login.php">Logout</a>
            </li>

        </ul>
    </nav>






</header>
<!--<p><h2 align="center">USER PAGE</h2></p>-->
<div class="row">
    <div class="col-md-4">
        <h4>My Task</h4>
        <div class="li_containers">

            <?php foreach ($mytask as $key => $item) { ?>

                <div class="ui-widget-content listitems" data-itemid=<?php echo $item['id'] ?> >
                    <ul>
                        <li><strong><?php echo $item['task'] ?></strong></li>
                    </ul>
                </div>

            <?php } ?>

        </div>
    </div>

    <div class="col-md-4">
        <h4>Task done</h4>
        <div id="droppable" class="ui-widget-header">

            <?php foreach ($completeTask as $key => $citem) { ?>

                <div class="listitems" >
                    <ul>
                        <li><strong><?php echo $citem['task'] ?></strong></li>
                    </ul>
                </div>

            <?php } ?>

        </div>
    </div>
    <div class="col-md-4">
        <h4>Calendar with Deadlines</h4>
    </div>
</div>



<!--javascript jquery ajax code here -->
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>

    $( function() {

        $( ".listitems" ).draggable();

        $( "#droppable" ).droppable({

            drop: function( event, ui ) {

                $(this).addClass( "ui-state-highlight" );

                var itemid = ui.draggable.attr('data-itemid')



                $.ajax({
                    method: "POST",

                    url: "update.php",
                    data:{'itemid': itemid},
                }).done(function( data ) {
                    var result = $.parseJSON(data);

                });
            }
        });
    });
</script>

<footer class="container-fluid">
    <ul class="nav justify-content-center">
        <li class="nav-item">
            <a class="nav-link active" href="#">copyright &copy; collaborations...</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#"></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#"></a>
        </li>
    </ul>

</footer>


</body>
</html>