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
    <link rel="stylesheet" href="pBacklog.css">
    <link rel="stylesheet" href="style.css">
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
$target_dir = "uploads/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $target_dir . $fileName;
$uploadok = 1;
$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);


if(isset($_POST['submit'])) {

    $name=  $_POST['name'];
    $comment=  $_POST['summary'];
    $remark=  $_POST['remark'];


    if(empty($task)){array_push($errors,"enter task name");}
    if(empty($name)){array_push($errors,"enter name");}
    if(empty($comment)){array_push($errors,"field is required");
        if(empty($remark)){array_push($errors,"field is required");}

        if($_FILES["file"]["size"] > 5000000) {
            echo"sorry,your file is too large.";
            $uploadok = 0;
        }
        if($fileType !="jpg" && $fileType != "png" && $fileType != "jpeg" && $fileType != "mp4" ) {
            echo "sorry, only JPG, JPEG, PNG & mp4 files are allowed.";
            $uploadok = 0;
        }
        if ($uploadok == 0){
            echo "sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
                echo "The file has been uploaded.";
            } else {
                echo "sorry, there was an error uploading your file.";
            }
        }

        $sql="INSERT INTO sprint_review(task,name,comments,remarks,file_upload) VALUES('$task','$name','$comment','$remark','$targetFilePath')";
        mysqli_query($db,$sql);
    }
}
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
            width:60%;
            margin-right: 100px;
            border:5px dimgrey;
            border-collapse: collapse;
            padding: 20px;
            float: right;
            background-color: #d4e3fc;
            border-radius: 10px;
        }
        th,td{
            border-collapse;
            padding-left 30px;
            padding-top: 20px;
            text-align: left;
            border: 1px dimgrey;
            border-collapse: collapse;
            height: 30px;
            line-height: normal;
        }
        tr {
            border-bottom: 1px dimgrey;
            height: 20px;
            padding: 20px;
        }
        th{
            font-size: 19px;
            color: dimgrey
        }
        tr:hover{
            background: #E9E9E9
        }
    </style>
</head>
<body>
<div class="flex-container">
    <div class ="container"stlye="padding:20px";>
        <form method="post" action="" enctype="multipart/form-data">
            <div class="input-group">
                <label for="name">Name:</label>
                <br>
                <input type="text" id="name" name="name" value="">
            </div>
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
                <textarea name="summary"id="summary" value="" style="width:300px; height:100px;"></textarea>
            </div>
            <br>
            <label for="task">remark:</label>
            <select name="remark" id="task">
                <option value="done">done</option>
                <option value="inprogress">in progress</option>
                <option value="notdone">not done</option>
            </select>
            <br>
            <button type="submit" class="btn" name="submit">submit</button>
        </form>
    </div>
    <div class ="container"stlye="padding:20px";>
        <table>
            <thead>
            <tr>
                <th>Names<th>
                <th>Task<th>
                <th>Remark<th>
            </tr>
            </thead>
            <tbody>
            <?php
            $review=mysqli_query($db, "SELECT*FROM sprint_review");
            $i = 1; while($row=mysqli_fetch_array($review)) {?>
                <tr>
                    <td><?php echo $row['name'];?></td>
                    <td><?php echo $row['task'];?></td>
                    <td><?php echo $row['remarks'];?></td>
                    <td>
                        <a class="brand-text" href="view.php?id=<?php echo $row['id']?>">view</a>
                    <td>
                </tr>
                <?php $i++; } ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>