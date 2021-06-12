<?php
    // старт сессии
    session_start();
    // соединение с базой данных
    require ("connection.php");
    // проверка сессии
    require ("check_session.php");
    // проверка на роль администратора
    require ("check_admin.php");
    
    $idCategory = $_GET['idCategory'];
    $delApp = mysqli_query($link, "DELETE FROM `applications` WHERE `id_category` = $idCategory");
    $delCategory = mysqli_query($link, "DELETE FROM `category` WHERE `id_category` = '$idCategory'");
	header ("Location: ../groom/index.php?message=Категория добавлена");
	exit;
?>