<?php
    // старт сессии
    session_start();
    // соединение с базой данных
    require ("connection.php");
    $result = $link->query('SELECT COUNT(`id_application`) as "counter" FROM `applications` 
    WHERE `status` = "Услуга оказана"');
    $counter = $result->fetch_assoc();
    if(!empty($counter)){
        echo json_encode($counter, 256);
    }


