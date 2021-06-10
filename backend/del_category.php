<?php
    // старт сессии
    session_start();
    // соединение с базой данных
    include ("connection.php");
    // проверка сессии
    include ("check_session.php");
    // проверка на роль администратора
    include ("check_admin.php");
    
    $idCategory = $_GET['idCategory'];
    $delApp = mysqli_query($link, "DELETE FROM `applications` WHERE `id_category` = $idCategory");
    $delCategory = mysqli_query($link, "DELETE FROM `category` WHERE `id_category` = '$idCategory'");
	header ("Location: ../groom/index.php?message=Категория добавлена");
	exit;
?>