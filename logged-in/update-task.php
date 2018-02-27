<?php
// require HTTPS!
if ($_SERVER['HTTPS'] != "on") {
    $url = "https://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    header("Location: $url");
    exit;
}
require_once('../db/dbconnect.php');
session_start();
$currentId = $_POST['id'];
$checkbox = $_POST['checkbox'];
try {
    $connection = new mysqli($host, $db_user, $db_password, $db_name);
    // if any faults;
    if ($connection->connect_errno != 0){
        throw new Exception($connection->error);
    } else {
        $result = $connection->query("UPDATE tasks SET checkbox='$checkbox' WHERE id='$currentId'");
        // no faults? carry on;
        if (!$result) {
            throw new Exception($connection->error);
        }
    }
    // close db connection;
    $connection->close();
}
catch (Exception $e) {
    echo 'server error'.'</br>';
    echo $e;
}
?>