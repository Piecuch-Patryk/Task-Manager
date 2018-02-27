<?php
// require HTTPS!
if ($_SERVER['HTTPS'] != "on") {
    $url = "https://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    header("Location: $url");
    exit;
}
session_start();
$_SESSION['demo-user'] = 'DemoUser';
$_SESSION['demo-pass'] = 'demo';
header('Location: ../login.php');
?>