<?php

require_once('dbconnect.php');

$itemid  = intval($_POST['itemid']);


//SQL query to get results from database

$sql = "update tasks set is_completed = 'yes' where id = $itemid";

$db->query($sql);

$db->close();

//send a JSON encode array to client

echo json_encode(array('success'=>1));

?>