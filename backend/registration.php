<?php
    include ("connection.php");
    $fio = $_POST['fio'];
    $login = $_POST['login'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordCheck = $_POST['passwordCheck'];
    if($password == $passwordCheck){
        $loginUser = mysqli_query($link, "SELECT `login` FROM `users` WHERE `login` = '$login'");
        $numLogins = mysqli_num_rows($loginUser);
        if($numLogins == 0){
            $addUser = mysqli_query($link, "INSERT INTO `users` (`id_user`, `fio`, `login`, `email`, `password`, `role`) VALUES 
            (NULL, '$fio', '$login', '$email', '$password', '2');");
            header('Location: ../index.phpmessageLog=Вы успешно зарегистрированы#auth');
        }
        else{
            header('Location: ../index.php?messageLog=Пользователь с таким логином уже есть#register');
        }
    
    }
    else{
        header('Location: ../index.php?messagePass=Пароли не совпадают#register');
    }
?>