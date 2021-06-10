<?php
    session_start();
    require ("../include/connection.php");
    if($_SESSION['role'] != 1){
        header('Location: ../index.php');
        exit();
    }
?>