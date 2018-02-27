<?php
    require_once('./dbconnect.php');
    session_start();
    $user = $_SESSION['id'];
    $task = $_POST['task'];
    $checkbox = $_POST['checkbox'];
    $validity = $_POST['validity'];
    $date = $_POST['date'];

    try {
        $connection = new mysqli($host, $db_user, $db_password, $db_name);
        // if any faults;
        if ($connection->connect_errno != 0){
            throw new Exception($connection->error);
        } else {
            $result = $connection->query("INSERT INTO tasks (id, user, task, checkbox, validity, date) VALUES (DEFAULT, '$user', '$task', '$checkbox', '$validity', '$date')");
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