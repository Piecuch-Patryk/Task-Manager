<?php
// require HTTPS!
if ($_SERVER['HTTPS'] != "on") {
    $url = "https://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    header("Location: $url");
    exit;
}
require_once('../db/dbconnect.php');
session_start();
$user = $_SESSION['id'];

try {
    $connection = new mysqli($host, $db_user, $db_password, $db_name);
    // if any faults;
    if ($connection->connect_errno != 0){
        throw new Exception($connection->error);
    } else {
        $result = $connection->query("SELECT `id` FROM `tasks` where `user`=1 ORDER BY `id` DESC LIMIT 1");
        // no faults? carry on;
        if (!$result) {
            throw new Exception($connection->error);
        }else {
            $json = mysqli_fetch_all ($result, MYSQLI_ASSOC);
            echo json_encode($json);
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