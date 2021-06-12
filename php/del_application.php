<?php
    // старт сессии
    session_start();
    // соединение с базой данных
    require ("connection.php");
    // проверка сессии
    require ("check_session.php");
    $idApp = $_GET['idApp'];
    $delApp = mysqli_query($link, "DELETE FROM `applications` WHERE `id_application` = '$idApp'");
	header ("Location: ../userPage.php?messageDel=Заявка удалена#app");
	exit;
    ?>