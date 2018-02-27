<?php
// require HTTPS!
if ($_SERVER['HTTPS'] != "on") {
    $url = "https://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    header("Location: $url");
    exit;
}
session_start();
if(!isset($_SESSION['logged'])){
    header('location: ../');
} else{
    unset($_SESSION['logged']);
    header('location: ../');
    }
?>