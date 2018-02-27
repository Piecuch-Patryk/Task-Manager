<?php
// require HTTPS!
if ($_SERVER['HTTPS'] != "on") {
    $url = "https://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    header("Location: $url");
    exit;
}
require_once('../db/dbconnect.php');
session_start();
try {
    $connection = new mysqli($host, $db_user, $db_password, $db_name);
    // if any faults;
    if ($connection->connect_errno != 0){
        throw new Exception($connection->error);
    } else {
        $id = $_SESSION['id'];
        // search current email in db;
        $result = $connection->query("SELECT * FROM tasks WHERE user='$id'");
        // no faults? carry on;
        if (!$result) {
            throw new Exception($connection->error);
        }else {
            if ($result->num_rows > 0){
                // get all tasks to the array;
                $json = mysqli_fetch_all ($result, MYSQLI_ASSOC);
                echo json_encode($json);
            }else {
                $message = 'false';
                echo json_encode($message);
            }
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