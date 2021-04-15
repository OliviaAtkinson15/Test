<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title> Upload File </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Jomhuria&family=Lobster&display=swap" rel="stylesheet">
</head>

<body>
<!-- Header Start -->

<header class="container-fluid">
    <!-- Image and text -->
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="#">
            <img src="assets/collabo_logo.jpeg" width="30" height="30" class="d-inline-block align-center" alt="collaborations logo"><b class="logoName">
                Collaborations...</b></a>
        <ul class="nav justify-content-center">
            <li class="nav-item">
                <a class="nav-link active" href="view_uploads.php">Already Uploaded a File?</a>
    </nav>
    <header/>

    <!-- Header End -->

    <main>
        <!-- Upload Form Start -->

        <form method="post" enctype="multipart/form-data" id="upload_form">

            <h5> Upload a File </h5><br>

            <input type="file" name="file" id="file_button"<br><br>
            <br><input type="submit" name="submit" id="submit_button"> <br><br>

        </form>

        <!-- PHP Code Start -->
        <?php

        include('dbconnect.php');

        $statusMsg = '';

        //File upload path
        $targetDir = "/Applications/MAMP/htdocs/Test/uploads/";

        if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"])) {
            $fileName = basename($_FILES["file"]["name"]);
            $targetFilePath = $targetDir . $fileName;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

            //Allow PDF, JPEG, DOCX, PPT, XLSX and mp4 files
            $allowTypes = array('pdf', 'jpeg', 'docx', 'ppt', 'xlsx', 'mp4', 'jpg', 'png');

            if (in_array($fileType, $allowTypes)) {
                //Upload file to server

                if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {

                    $sql = "SELECT * FROM uploads WHERE (file_name = '$fileName')";
                    $res = mysqli_query($db, $sql);

                    if (mysqli_num_rows($res) > 0) {

                        $statusMsg = "Sorry, this file already exists";

                    } else {

                        // Insert file into db
                        $insert = $db->query("INSERT INTO uploads (file_name, uploaded_on) VALUES ('$fileName', NOW())");

                        //Status message saying that the file has been uploaded succesfully
                        if ($insert) {
                            $statusMsg = "The file " . $fileName . " has been uploaded successfully";

                        } else {
                            // Status message saying unable to upload the file
                            $statusMsg = "Sorry, there was an error uploading your file.";
                        }
                    }
                }
            }
            else {
                echo 'Sorry, only pdf, jpeg, docx, ppt, xlsx, mp4 files are allowed to upload.';
            }
        }
        echo $statusMsg;

        ?>

        <!-- PHP CODE END -->

        <!-- Upload Form End -->

    </main>

    <!-- Footer Start-->


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