<?php
session_start();
if(!isset($_SESSION['logged'])){
    header('location: ./index.php');
} else{
    unset($_SESSION['logged']);
    header('location: ./index.php');
    }
?>