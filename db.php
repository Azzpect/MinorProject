<?php
$server = "localhost";
$user = "root";
$password = "";
$db = "minorProject";
$conn = new mysqli($server, $user, $password, $db);
if($conn->connect_error) {
    echo "Connection failed";
    return;
}
?>