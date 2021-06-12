<?php
    session_start();
    require ("php\connection.php");
    $queryApplications = mysqli_query($link, "SELECT `id_application`, `id_user`, `name_dog`, `id_category`, `photo_before`, `photo_after`, `status`, `time` FROM `applications` WHERE `status` = 'Услуга оказана' ORDER BY `time` DESC LIMIT 4");
    $queryApplicationsNumber = mysqli_query($link, "SELECT * FROM `applications` WHERE `status` = 'Услуга оказана'");
    $applicationsNumber = mysqli_num_rows($queryApplicationsNumber);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css\style.css">
    <link rel="shortcut icon" href="logo\logo_groom.png" type="image/x-icon">		
    <title>Главная страница</title>
</head>
<body>
<?php include "include/header.php";?>

    <main class="main">
		<div class="contRegWrap">
			<div class="counter">
				<h3>Добрых дел сделано:</h3>
				<p class="counter"><?=$applicationsNumber?></p>
			</div>

			<div class="regAuth">

<?php if(($_SESSION['login'] == true) && ($_SESSION['role'] == 2)){ ?>
                <a href="userPage.php">Личный кабинет</a>
                <a href="php\logout.php">Выход</a>
<?php }
 elseif($_SESSION['login'] == true && $_SESSION['role'] == 1){ ?>

                <a href="groom\index.php">Кабинет администратора</a>
                <a href="..\php\logout.php">Выход</a>
<? } 
else{?>
                <a href="authorizationPage.php">Авторизация</a>
                <a href="registrationPage.php">Регистрация</a>
<? } ?>
			</div>

		</div>
<!-- zayavki -->
        <h2>Последние решенные заявки</h2>

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
                <p class="date">Дата и время: <?=$time?></p>
                <p class="name-dog">Питомец: <?=$nameDog?></p>
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
<?php } ?>
        </div>
    </main>
<?php include "include/footer.php";?>
    
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