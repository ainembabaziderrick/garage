<?php

include 'db.php';

include 'initialize.php';
if (isset($_GET["id"])){
$id = $_GET["id"];

$sql = "DELETE FROM garages WHERE id = $id";
$connection->query($sql);
}
$activityLog->setAction($_SESSION['login_id'], "deleted a garage [ID#{$id}]");
header("location: /garage/garage.php");
        exit;
        
        
?>