<?php
    // старт сессии
    session_start();
    // соединение с базой данных
    include ("connection.php");
    // проверка сессии
    include ("check_session.php");
    // проверка на роль администратора
    include ("check_admin.php");
    
    $nameCategory = $_POST['nameCategory'];
    $insertCategory = mysqli_query($link, "INSERT INTO `category` (`id_category`, `category`) VALUES (NULL, '$nameCategory');");
	header ("Location: ../groom/index.php?message=Категория добавлена#category");
	exit;
?>
