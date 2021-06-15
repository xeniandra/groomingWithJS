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
    <title>Регистрация</title>
</head>
<body>
<?php include "include/header.php";?>
    <main class="main">
        <h2>Регистрация</h2>
        <form action="php\registration.php" method="POST" class="flex" id="formReg"> 

            <p class="error" id="fioError"></p>
            <input type="text" name="fio" placeholder="Введите ФИО" id="fio" required>

            <p class="error" id="loginError"></p>
            <input type="text" name="login"  placeholder="Введите логин" id="login" required>
            <input type="email" name="email" placeholder="Введите Email" required>
            <input type="password" name="password" placeholder="Введите пароль" id="password" required>
                    
            <p class="error" id="passwordError"></p>
            <input type="password" name="passwordCheck" placeholder="Повторите пароль" id="confirmPassword" required>
            <p class="agree">
            <input type="checkbox" name="agree" required>
                Согласие на обработку персональных данных
            </p>
            <input type="submit" name="registration" id="submitReg" value="ЗАРЕГИСТРИРОВАТЬСЯ">
        </form>

    </main>
<?php include 'include/footer.php';?>
<script src="js\reg.js" defer></script>
</body>
</html>