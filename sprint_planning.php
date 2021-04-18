<?php include("dbconnect.php");


// delete task
if (isset($_POST['remove'])) {
    $remove = mysqli_real_escape_string($db,$_POST['delete']);
    $sql="DELETE FROM sprint_backlog WHERE id=$remove";


    mysqli_query($db, $sql);
    header("Refresh:0");


}

if (isset($_POST['select'])) {
    if(empty($_POST["sprint"]))
    {
        echo "select a product backlog.";
    }else
    {
        $sprint=$_POST['sprint'];
        $sql = "INSERT INTO sprint_backlog (sprint) VALUES ('$sprint')";
        mysqli_query($db, $sql);}
    header("Refresh:0");
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sprint Planning</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Jomhuria&family=Lobster&display=swap" rel="stylesheet">
</head>
    <header>
        <!-- Image and text -->
        <nav class="navbar navbar-light bg-light">
            <a class="navbar-brand" href="#">
                <img src="assets/collabo_logo.jpeg" width="30" height="30" class="d-inline-block align-center" alt="collaborations logo"><b class="logoName">
                    Collaborations...</b></a>

            <?php
            session_start();
            $user = $_SESSION['user'];
            echo "<h5>$user</h5>";
            ?>
            <ul class="nav justify-content-center">
                <li class="nav-item">
                    <a class="nav-link active" href="home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="userPage.php">My Page</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="team_page.php">Team Page</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pBacklog.php">Product Backlog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="try.php">Sprint Planning</a>
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
        <meta charset="UTF-8">
    <title>Sprint Planning</title>
    <style>
        .dropdown2 {
            position: relative;
            display: inline-block;
        }

        .dropdown-content2{
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            padding: 12px 16px;
            z-index: 1;
        }
        #sprinttable{

            width: 300px;
            font-family: Arial;
        }
        #sprinttable, td {

            padding-top: 5px;
        }
        #sprinttable, tr{

            padding-top: 10px;
            padding-bottom: 10px;
        }



        .dropdown2:hover .dropdown-content2 {
            display: block;
        }
        .flex-container2 {
            display: flex;
            flex-direction: row;
padding-left: 150px;
            height: 700px;

        }

        .card2 {
            box-shadow: grey;
            max-width: 300px;

            background-color: #d4e3fc;
            text-align: center;
            margin-left: auto;
            padding-top: 10px;
            padding-bottom: 10px;
            margin-right: auto;

        }
        #mtasks {
            margin-top: 20px;
            background-color: #d4e3fc;
            border-radius: 10px;
            padding: 15px;
text-align: center;
            color: dimgray;
            font-size: medium;

        }
        #mtasks:hover {
            background-color: cornflowerblue;
            cursor: alias;
        }
        #mtasks, a{
            text-decoration: none;
        }




    </style>
    <script>
        function compareDates(){
            var startDate = document.getElementById("start").value;
            var endDate = document.getElementById("end").value;

            if ((Date.parse(endDate) <= Date.parse(startDate))) {
                alert("End date should be greater than Start date")
                document.getElementById("EndDate").value = "";
            }
        }
        startDate.addEvenListener('input', compareDates);
        endDate.addEvenlistener('input', compareDates);


        function allowDrop(ev) {
            ev.preventDefault();
        }

        function drag(ev) {
            ev.dataTransfer.setData("card", ev.target.id);
        }

        function drop(ev) {
            ev.preventDefault();
            var data = ev.dataTransfer.getData("card");
            ev.target.appendChild(document.getElementById(data));
        }
    </script>

</head>

    <div id="one">
    <div class="flex-container2" style="margin-top:10px";>
        <div class="container2"style="padding:20px";>
            <table id="sprinttable">
                <thead >
                <tr>
                    <th><h2>Product Backlog</h2></th>
                <tr>
                </thead>
                <tbody>
                <?php
                $pb = mysqli_query($db, "SELECT * FROM product_backlog");
                $i = 1; while ($pbi = mysqli_fetch_array($pb)) { ?>
                    <tr>
                        <td >
                            <div class="card2">
                                <div class="dropdown2">
                                    <span><?php echo $pbi['product_item']; ?></span>
                                    <div class="dropdown-content2">
                                        <p>Product task:<br><?php echo $pbi['product_task'];?>
                                        <p>Criteria:<br><?php echo $pbi['criteria'];?>
                                        <p>Effort:<br><?php echo $pbi['effort'];?>
                                    </div>
                                </div>
                        </td>
                    </tr>
                    <?php $i++; } ?>
                </tbody>
            </table>
        </div>

        <div class="container2" style="padding:20px";>
                    <form method="post">
                        <?php if (isset($errors)) { ?>
                            <p><?php echo $errors; ?></p>
                        <?php } ?>
                        <label for="item"><h2>Select PBI:</h2></label><br>
                        <input type="text" id="sbi" name="sprint">
                        <button type="submit" name="select"id="select">Select</button><br>
                    </form>
            <h3 id="mtasks"><a href="try.php">Manage Tasks</a></h3>
        </div>

        <div class="container2" style="padding:20px";>
            <table>
                <thead>
                <tr>
                    <th><h2>Sprint Backlog</h2></th>
                </tr>
                </thead>

                <?php
                // select all tasks if page is visited or refreshed
                $sprint = mysqli_query($db, "SELECT * FROM sprint_backlog");

                $i = 1; while ($row = mysqli_fetch_array($sprint)) { ?>
                    <tr>
                        <td>
                            <div class="card2">
                                <?php echo $row['sprint']; ?>
                            </div>
                        <td>
                        <td>
                            <form method="POST" >
                                <input type="hidden" name="delete" value="<?php echo $row['id']?>">
                                <input type="submit" id="delete" name="remove" value="remove">
                            </form>
                        </td>
                    </tr>
                    <?php $i++; } ?>

                <table>
        </div>


    </div>
 </div>
</div


    </div>
    </body>

    </html>