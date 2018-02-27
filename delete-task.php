<?php
    require_once('./dbconnect.php');
    session_start();
    $currentId = $_POST['id'];
    try {
        $connection = new mysqli($host, $db_user, $db_password, $db_name);
        // if any faults;
        if ($connection->connect_errno != 0){
            throw new Exception($connection->error);
        } else {
            $result = $connection->query("DELETE FROM tasks WHERE id='$currentId'");
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