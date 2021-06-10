<?php
    session_start();
    include ("backend\connection.php");
    $queryApplications = mysqli_query($link, "SELECT `id_application`, `id_user`, `name_dog`, `id_category`, `photo_before`, `photo_after`, `status`, `time` FROM `applications` WHERE `status` = 'Услуга оказана' ORDER BY `time` DESC LIMIT 4");
    $queryApplicationsNumber = mysqli_query($link, "SELECT * FROM `applications` WHERE `status` = 'Услуга оказана'");
    $applicationsNumber = mysqli_num_rows($queryApplicationsNumber);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css\style.css">
    <title>Главная страница</title>
</head>
<body>
    <header>
        <div class="container-header flex">
            <img src="logo\logo_groom.png" alt="logo" class="logo">
            <p class="name">ГрумRoom</p>
        </div>
        <div class="menu flex">
            <a href="#register" class="menu">Регистрация</a>
            <?php if($_SESSION['login'] == true){ 
                if($_SESSION['role'] == 2){?>
            <a href="user.php" class="menu">Личный кабинет</a>
            <?php }
            else{?>
                <a href="groom\index.php" class="menu">Личный кабинет</a>
            <?}
            } 
            else{?>
            <a href="#auth" class="menu">Вход в личный кабинет</a>
            <? } ?>
        </div>
    </header>
    <main>
        <div class="container-main flex">
            <div class="heading flex">
                <h3 class="title">Последние решенные заявки</h2>
            </div>
                <h2 class="counter">Количестве оказанных услуг: <?=$applicationsNumber?></h3>

            <div class="container-request flex">
<?php
while ($app = mysqli_fetch_assoc($queryApplications)) {
    $idApp = $app['id_application'];
    $nameDog = $app['name_dog'];
    $photoBefore = $app['photo_before'];
    $photoAfter = $app['photo_after'];
    $time = $app['time'];
    $idCategory = $app['id_category'];
    $queryCategory = mysqli_query($link, "SELECT `category` FROM `category` WHERE `id_category` = '$idCategory'");
    $category = mysqli_fetch_assoc($queryCategory);
    $nameCategory = $category['category'];
?>

                <div class="request">
                    <p class="date"><?=$time?></p>
                    <p class="name-dog"><?=$nameDog?></p>
                    <p class="category">Категория: <?=$nameCategory?></p>
                    <div class="change-image" onmouseenter="fn_image_enter(event)" onmouseleave="fn_image_leave(event)" id="image_<?=$idApp?>">
                        <div class="before" style="display:block;">
                            <img src="..\<?=$photoBefore?>" alt="before">
                        </div>
                        <div class="after" style="display:none;">
                            <img src="..\<?=$photoAfter?>" alt="after">
                        </div>
                    </div>
                </div>
<?php
}
?>
            </div>
        </div>
        <div class="container-form flex">

            <div class="heading flex">
                <h3 class="title" id="register">Регистрация</h2>
            </div>

                <form action="backend\registration.php" method="POST" class="flex" onsubmit="return fn_register();" id="reg"> 
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
                    <input type="password" name="password" placeholder="Введите пароль" required>
                    <input type="password" name="passwordCheck" placeholder="Повторите пароль" required>
                    <p class="message" id="messagePass"></p>
                    <p class="agree">
                        <input type="checkbox" name="agree" required>
                        Согласие на обработку персональных данных
                    </p>
                    <input type="submit" value="ЗАРЕГИСТРИРОВАТЬСЯ">
                </form>

                <div class="heading flex">
                    <h3 class="title" id="auth">Авторизация</h2>
                </div>
                <form action="backend\authorization.php" method="POST" class="flex">
<?php 
    if($_GET['messageLog']){
?>
                    <p class="message"><?=$_GET['message'];?></p>
<?php 
}
?>
                    <input type="text" name="login" placeholder="Введите логин" required>
                    <input type="password" name="password" placeholder="Введите пароль" required>
                    <input type="submit" value="ВОЙТИ">
                </form>
        </div>
    </main>

    <footer>
        <p class="footer">Задание выполнено в рамках подготовки к Демонстрационному экзамену</p>
        <p class="year">2021г.</p>
    </footer>
    
    <script src="js\index.js"></script>
    <!-- <script>
        function fn_register(){
            let password = document.querySelector("input[name=password]").value;
            let passwordCheck = document.querySelector("input[name=passwordCheck]").value;
            if(password != passwordCheck){
                document.queryElementById("messagePass").innerHTML = "Пароли не совпадают"
                alert("Пароли не совпадают")
                return false;
            }
            else{
                return true;
            }

        }
    </script> -->
</body>
</html>