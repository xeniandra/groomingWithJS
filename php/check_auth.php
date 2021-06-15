<?php
    require ("connection.php");
    $login = $_GET['login'];
    $password = $_GET['password'];
    $queryLogin = mysqli_query($link, "SELECT COUNT(`id_user`) FROM `users` WHERE `login` = '$login' AND `password` = '$password'");
    $counter = mysqli_fetch_array($queryLogin)[0];
    echo $counter;