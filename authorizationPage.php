<?php
    session_start();
    require ("php\connection.php");
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css\style.css">
    <link rel="shortcut icon" href="logo\logo_groom.png" type="image/x-icon">
    <link rel="shortcut icon" href="logo\logo_groom.png" type="image/x-icon">				
    <title>Главная страница</title>
</head>
<body>
<?php include "include/header.php";?>
    <main class="main">
        <h2>Авторизация</h2>
        <form action="php/authorization.php" method="POST" class="flex">
<?php if($_GET['messageLog']){ ?>
        <p class="message"><?=$_GET['message'];?></p>
<?php }?>
            <input type="text" name="login" placeholder="Введите логин" required>
            <input type="password" name="password" placeholder="Введите пароль" required>
            <input type="submit" value="ВОЙТИ">
        </form>

    </main>
<?php include 'include/footer.php';?>
</body>
</html>