<?php
    include ("connection.php");
    $login = $_POST['login'];
    $password = $_POST['password'];
    $queryUser = mysqli_query($link, "SELECT `id_user`, `fio`, `login`, `email`, `password`, `role` FROM `users` WHERE `login` = '$login' 
    AND `password` = '$password'");
    $users = mysqli_num_rows($queryUser);
    // проверка на наличие пользователя с таким логином и паролем
    if($users == 1){
        session_start();
        $_SESSION['login'] = $login;
        $userData = mysqli_fetch_assoc($queryUser);
        $id_user = $userData['id_user'];
        $_SESSION['id_user'] = $id_user;
        $role = $userData['role'];
        $_SESSION['role'] = $role;
        if($role == 1){
            header('Location: ../groom');
            exit();
        }
        else{
            header('Location: ../user.php');
            exit();
        }
    }
    else{
        header('Location: ../index.php?message=Пользователя с такими данными не существует#auth');
        // echo "Такого пользователя не существует";
    }
?>
