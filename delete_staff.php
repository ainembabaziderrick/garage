<?php

include 'db.php';

include 'initialize.php';
if (isset($_GET["id"])){
$id = $_GET["id"];

$sql = "DELETE FROM staff WHERE id = $id";
$connection->query($sql);
}
$activityLog->setAction($_SESSION['login_id'], "deleted a staff [ID#{$id}]");
header("location: /garage/staff.php");
        exit;
        
        
?>