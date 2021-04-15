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
<!Doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>sprint planning</title>
    <style>
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            padding: 12px 16px;
            z-index: 1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }
        .flex-container {
            display: flex;
            flex-direction: row;
            background-color: #d4e3fc;
        }

        .card {
            box-shadow: grey;
            max-width: 300px;
            background-color: #5F9EA0; ;
            text-align: center;
            margin-left: auto;
            margin-right: auto;

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

<header>

    <body>
    <div class="flex-container" style="margin-top:10px";>
        <div class="container"style="padding:20px";>
            <table>
                <thead>
                <tr>
                    <th>Product backlog</th>
                <tr>
                </thead>
                <tbody>
                <?php
                $pb = mysqli_query($db, "SELECT * FROM product_backlog");
                $i = 1; while ($pbi = mysqli_fetch_array($pb)) { ?>
                    <tr>
                        <td >
                            <div class="card">
                                <div class="dropdown">
                                    <span><?php echo $pbi['product_item']; ?></span>
                                    <div class="dropdown-content">
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
        <div class="container" style="padding:20px";>
            <h4>Sprint backlog<h4>
                    <form method="post">
                        <?php if (isset($errors)) { ?>
                            <p><?php echo $errors; ?></p>
                        <?php } ?>
                        <label for="item">Select PBI:</label><br>
                        <input type="text" id="sbi" name="sprint">
                        <button type="submit" name="select"id="select">Select</button><br>
                    </form>
        </div>

        <div class="container" style="padding:20px";>
            <table>
                <thead>
                <tr>
                    <th>Sprint backlog item</th>
                </tr>
                </thead>
                <tbody>
                <?php
                // select all tasks if page is visited or refreshed
                $sprint = mysqli_query($db, "SELECT * FROM sprint_backlog");

                $i = 1; while ($row = mysqli_fetch_array($sprint)) { ?>
                    <tr>
                        <td>
                            <div class="card">
                                <?php echo $row['sprint']; ?>
                            </div>
                        <td>
                        <td>
                            <form method="POST">
                                <input type="hidden" name="delete" value="<?php echo $row['id']?>">
                                <input type="submit" id="delete" name="remove" value="remove">
                            </form>
                        </td>
                    </tr>
                    <?php $i++; } ?>
                </tbody>
                <table>
        </div>
    </div>
    </body>
    <html>