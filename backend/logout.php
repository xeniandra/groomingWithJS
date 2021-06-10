<?php
    // старт сессии
    session_start();
    // соединение с базой данных
    include ("connection.php");
    // проверка сессии
    include ("check_session.php");
    // очищение сохраненных данных сессии
    unset($_SESSION['login']);
    unset($_SESSION['id_user']);
    unset($_SESSION['role']);
    // перенаправление на главную страницу
    header('Location: ../index.php');
?>