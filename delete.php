<?php

include("dbconnect.php");
    $id = $_GET['id'];



$sqlD = $db->query("DELETE FROM product_backlog WHERE product_backlog_id= '$id'");


if ($sqlD) {
    header("Location:pBacklog.php");
} else {
    echo "Error.";
}

?>