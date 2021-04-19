<!--/**
 * Name: Darlington
 * StudentId:
 * CourseCode: CMM004
 * Course: Software Engineering Project
 *
 */


/**
 * * CHAT SCRIPT
 *
 *
 * -->



<?php
include ("dbconnect.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sprint Retrospective</title>

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Jomhuria&family=Lobster&display=swap" rel="stylesheet">

</head>

<body>

<header>
    <!-- Image and text -->
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="#">
            <img src="assets/collabo_logo.jpeg" width="30" height="30" class="d-inline-block align-center" alt="collaborations logo"><b class="logoName">
                Collaborations...</b></a>
        <?php
        session_start();
        $email = $_SESSION['user'];
        echo "<h5>Hello $email</h5>";
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
                <a class="nav-link" href="sprint_planning.php">Sprint Planning</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="sprintreview2.php">Sprint Review</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="Chat.php">Discussions</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="login.php">Logout</a>
            </li>

        </ul>
    </nav>


</header>

<?php
include('dbconnect.php');

?>
<!DOCTYPE html>
<html>
<head>
    <title>sprintreview</title>
    <style>
        .flex-container {
            display: flex;
            flex-direction: row;
            background-color:#d4e3fc;
        }
        table{
            width:100%;
            margin-right: 100px;
            border:5px dimgrey;
            border-collapse: collapse;
            padding: 20px;
            float: right;
            background-color: #d4e3fc;
            border-radius: 10px;
        }
        th,td{

            padding-left 10px;
            padding-top: 20px;
            border: 1px dimgrey;
            height: 30px;
            line-height: normal;
        }
        tr {
            border-bottom: 1px dimgrey;
            height: 20px;
            padding: 5px;
        }
        th{

            font-size: 20px;
            color: dimgrey;
            padding-left 10px;
            padding-top: 20px;
            border: 1px dimgrey;
            height: 30px;
            line-height: normal;

        }
        tr:hover{
            background: #E9E9E9
        }

        form{
            justify-content: center;
        }
    </style>
</head>
<body>
<div class="flex-container">
    <div class ="container"stlye="padding:20px";>
        <form method="post" action="" enctype="multipart/form-data">

            <div class="input-group">
                <label for="name">Task name:</label>
                <br>
                <input type="text" id="task" name="task" value="">
            </div>
            <br>
            <input type="file" id="file" name="file">
            <br>
            <div class="input-group">
                <label    for="comments">summary:</label>
                <br>
                <textarea name="summary" id="summary" value="" style="width:300px; height:100px;"></textarea>
            </div>
            <br>
            <label for="task">Progress:</label>
            <select name="remark" id="task">
                <option value="done">done</option>
                <option value="inprogress">in progress</option>
                <option value="notdone">not done</option>
            </select>
            <br>
            <button type="submit" class="btn" name="submit">submit</button>
        </form>
    </div>
    <?php
    $targetDir = "/Applications/MAMP/htdocs/Test/";
    $fileName = basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    if(isset($_POST['submit'])) {


        $comment=  $_POST['summary'];
        $remark=  $_POST['remark'];
        $task=  $_POST['task'];

        /*  if(empty($task)){array_push($errors,"enter task name");}
          if(empty($name)){array_push($errors,"enter name");}
          if(empty($comment)){array_push($errors,"field is required");
              if(empty($remark)){array_push($errors,"field is required");}*/


        if (!empty($_FILES["file"]["name"])) {
            if($fileType !="jpg" && $fileType != "png" && $fileType != "jpeg" && $fileType != "mp4" ) {
                echo "sorry, only JPG, JPEG, PNG & mp4 files are allowed.";


            }
            else {      // Upload file to server
                if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
                    // Insert image file name into database
                    $insert = $db->query("INSERT into sprint_review (task,comments,remarks, file_upload) VALUES ('$task','$comment','$remark','$fileName')");

                    if ($insert) {
                        header("Refresh:0");
                    } else {
                        echo "Unable to add.";
                    }
                } else {
                    echo "Error uploading your file.";
                }
            }

        } else {
            $insert = $db->query("INSERT into sprint_review (task,comments,remarks) VALUES ('$task','$comment','$remark')");

            if ($insert) {
                header("Refresh:0");
            } else {
                echo "Unable to add.";
            }

        }

    }


    ?>
    <div class ="container"stlye="padding:20px";>
        <table>
            <thead>
            <tr>
                <th>Task</th>
                <th>Progress</th>
                <th>Comments</th>
                <th>File Uploaded</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $review=mysqli_query($db, "SELECT * FROM sprint_review");
            $i = 1; while($row=mysqli_fetch_array($review)) {?>
                <tr>
                    <td><?php echo $row['task'];?></td>
                    <td><?php echo $row['remarks'];?></td>
                    <td><?php echo $row['comments'];?></td>
                    <td>
                    <?php
                    if (!empty($row["file_upload"])) {
                        Print '<div><img src="' . $row["file_upload"] . '" style="width:150px;"></div>';
                    }
                    ?>
                    <td>
                </tr>
                <?php $i++; } ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>