<?php

include 'db.php';
include 'initialize.php';
if (isset($_GET["id"])){
$id = $_GET["id"];
$first_name = $_GET["first_name"];

$sucessMessage = '';

$sql = "DELETE FROM services WHERE id = $id";
$connection->query($sql);
}
$result = $connection->query($sql);
if ($result) {
    $activityLog->setAction($_SESSION['login_id'], "deleted service [ID#{$id}]");
    $sucessMessage = " Service Successfully edited";
}
header("location: /garage/services/index.php");
        exit;
        
        
?>