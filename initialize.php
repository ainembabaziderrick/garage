<?php 
require_once("activity-log.class.php");
$dbData = [
    "localhost", // Hostname
    "root",      // Username
    "",          // Password
    "garage"  // DBName
];
$activityLog = new ActivityLog(...$dbData);
?>