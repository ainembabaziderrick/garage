<?php

include 'db.php';

include 'initialize.php';
if (isset($_GET["id"])){
$id = $_GET["id"];

$sql = "DELETE FROM brand WHERE id = $id";
$connection->query($sql);
}
$activityLog->setAction($_SESSION['login_id'], "deleted a brand [ID#{$id}]");
header("location: /garage/brand.php");
        exit;
        
        
?>