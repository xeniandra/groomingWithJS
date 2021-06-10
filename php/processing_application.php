<?php
    // старт сессии
    session_start();
    // соединение с базой данных
    require ("../include/connection.php");
    // проверка сессии
    require ("check_session.php");
    // проверка на роль администратора
    require ("check_admin.php");
    
    $idApp = $_POST['idApp'];
    $comment = $_POST['comment'];

    $updateAppStatus = mysqli_query($link, "UPDATE `applications` SET `status` = 'Обработка данных', `comment` = '$comment' WHERE `id_application` = '$idApp';");
	header ("Location: ../groom/index.php?message=Статус обновлен");
	exit;
?>