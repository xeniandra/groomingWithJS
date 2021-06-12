<?php
    // старт сессии
    session_start();
    // соединение с базой данных
    require ("connection.php");
    // проверка сессии
    require ("check_session.php");
    // проверка на роль администратора
    require ("check_admin.php");
    
    $nameCategory = $_POST['nameCategory'];
    $insertCategory = mysqli_query($link, "INSERT INTO `category` (`id_category`, `category`) VALUES (NULL, '$nameCategory');");
	header ("Location: ../groom/index.php?message=Категория добавлена#category");
	exit;
?>
