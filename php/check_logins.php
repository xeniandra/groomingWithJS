<?php
    require ("connection.php");
    $login = $_GET['login'];
    $queryLogin = mysqli_query($link, "SELECT COUNT(`id_user`) FROM `users` WHERE `login` = '$login'");
    $counter = mysqli_fetch_array($queryLogin)[0];
    echo $counter;