<?php

include 'db.php';

include 'initialize.php';
if (isset($_GET["id"])){
$id = $_GET["id"];

$sql = "DELETE FROM category WHERE id = $id";
$connection->query($sql);
}
$activityLog->setAction($_SESSION['login_id'], "deleted a category [ID#{$id}]");
header("location: /garage/category.php");
        exit;
        
        
?>