<?php

include ("dbconnect.php");



session_start();

if (!isset($_SESSION['user'])) {
    header("Location:login.php");

}



$user = $_SESSION['user'];
echo $user;
$result1 = "SELECT * FROM tasks AS T, team_users AS U WHERE T.assigned_to = U.ID AND FirstName = '$user' AND is_completed = 'no'";
//$mytask = mysqli_fetch_all($result1,MYSQLI_ASSOC);
$result1 = mysqli_query($db, $result1);

$resultCheck = mysqli_num_rows($result1);





if($resultCheck>0) {
    while($mytask = mysqli_fetch_assoc($result1)){
        print "<div>";
        print "<ul id='list'>";
        print "<li>";
        print "<div>".$mytask['task']."</div>";
        print "</li>";
        print "</ul>";
        print "</div>";


    }
    //mysqli_free_result($result1);
}else{
    echo "err";
}


$sqlTT = mysqli_query($db,"SELECT * FROM tasks AS T, team_users AS U WHERE T.assigned_to = U.ID AND assigned_to = '$user'");

$resultCheck = mysqli_num_rows($sqlTT);
//fetch who the task is assigned to
if($resultCheck > 0){
    while($name = mysqli_fetch_assoc($sqlTT)){
        print "<p>". $name['FirstName']. "</p>";;
    }
}










?>