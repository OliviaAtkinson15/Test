<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title> View Uploaded Files </title>
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
                <a class="nav-link active" href="uploadfile.php">Need To Upload a File?</a>
    </nav>
    <header/>

    <!-- Header End -->

    <main>

        <h5> View Uploads </h5><br>

        <!-- View Uploads Start -->

        <?php

        include ('dbconnect.php');

        // Get files from the DB

        $sql = "SELECT file_name FROM uploads ORDER BY file_name DESC";
        $result = $db -> query($sql);

        ?>

        <div>
            <table width="100%" border="1" style="text-align: center">
                <thead>
                <tr>
                    <th> File Name </th>
                    <th> View File </th>
                </tr>
                </thead>

                <tbody>
                <?php
                if($result->num_rows > 0){
                    while ($row = mysqli_fetch_array($result)) { ?>

                        <tr>
                            <td> <?php echo $row ['file_name']; ?></td>

                                <?php
                                echo '<td><a href=uploads/'.$row['file_name'].'>'?>Click here to view file</a></td>
                            <!--<td><a href="/Applications/MAMP/htdocs/Test<?php /*echo $row['file_name']; */?>" target="_blank">Click here to view file</a></td>-->
                        </tr>


                    <?php   }
                } else {
                    echo "Please Upload A File!";
                }
                ?>

                </tbody>
            </table>
        </div>

    </main>

    <!-- View Uploads End -->

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