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
        <form action="php/authorization.php" method="POST" class="flex" id="formAuth">
            <p class="error" id="logPassErr"><?=$_GET['message']?></p>
            <input type="text" name="login" placeholder="Введите логин" required id="login">
            <input type="password" name="password" placeholder="Введите пароль" required id="password">
            <input type="submit" value="ВОЙТИ" id="subAuth">
        </form>

    </main>
<?php include 'include/footer.php';?>
<script src="js\auth.js" defer></script>
</body>
</html>