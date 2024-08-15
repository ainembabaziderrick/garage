<?php

include 'db.php';

include 'initialize.php';
if (isset($_GET["id"])){
$id = $_GET["id"];

$sql = "DELETE FROM ims_supplier WHERE id = $id";
$connection->query($sql);
}
$activityLog->setAction($_SESSION['login_id'], "deleted a supplier [ID#{$id}]");
header("location: /garage/supplier.php");
        exit;
        
        
?>