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
        <h2>Регистрация</h2>
        <form action="php/registration.php" method="POST" class="flex" onsubmit="return fn_register();" id="reg"> 
<?php 
if($_GET['messageLog'] || $_GET['messagePass']){
?>
                <p class="message"><?=$_GET['messageLog'];?></p>
                <p class="message"><?=$_GET['messagePass'];?></p>
<?php 
}
?>
                    <input type="text" name="fio" pattern="[а-яА-ЯёЁ\-\ ]+$" placeholder="Введите ФИО" required>
                    <input type="text" name="login" pattern="[a-zA-Z\-\ ]+$" placeholder="Введите логин" required>
                    <input type="email" name="email" placeholder="Введите Email" required>
                    <input type="password" name="password" placeholder="Введите пароль" id="password" required>
                    <input type="password" name="passwordCheck" placeholder="Повторите пароль" id="confirmPassword" required>
                    <div id="checkPasswordMatch"></div>
                    <p class="agree">
                        <input type="checkbox" name="agree" required>
                        Согласие на обработку персональных данных
                    </p>
                    <input type="submit" name="registration" id="submit" value="ЗАРЕГИСТРИРОВАТЬСЯ">
                </form>

    </main>
<?php include 'include/footer.php';?>
</body>
</html>