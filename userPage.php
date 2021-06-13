<?php
    session_start();
    require ("php\connection.php");
    require ("php\check_session.php");
    $queryCategories = mysqli_query($link, "SELECT `id_category`, `category` FROM `category`");
    $idUser = $_SESSION['id_user'];
    $queryApplicationsUser = mysqli_query($link, "SELECT `id_application`, `id_user`, `name_dog`, `description`, `id_category`, `status`, `time` FROM `applications` WHERE `id_user` = $idUser ORDER BY `time` DESC");
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css\style.css">
    <link rel="shortcut icon" href="logo\logo_groom.png" type="image/x-icon">		
    <title>Личный кабинет</title>
</head>
<body>
<?php include "include/header.php"?>
    <main class="main">
        <div class="menu flex">
            <a href="index.php" class="menu">Главная</a>
            <a href="php\logout.php" class="menu">Выход</a>
        </div>
        <h2>Мои заявки</h2>
        <nav class="filtration">
            <a onclick="fn_app_filtration ()" class="status">Все</a>
            <a onclick="fn_app_filtration ('Новая')" class="status">Новые</a>
            <a onclick="fn_app_filtration ('Обработка данных')" class="status">Обработка данных</a>
            <a onclick="fn_app_filtration ('Услуга оказана')" class="status">Услуга оказана</a>
        </nav>
        <div class="containerMyRequest flex">
<?php
while($app = mysqli_fetch_assoc($queryApplicationsUser)){
    $id_category = $app['id_category'];
    $categories = mysqli_query($link, "SELECT `category` FROM `category` WHERE `id_category` = '$id_category'");
    $category = mysqli_fetch_assoc($categories);
    $categoryName = $category['category'];
?>
            <div class="MyRequest">
                <p>Время: <?=$app['time']?></p>
                <p>Кличка: <?=$app['name_dog']?></p>
                <p>Описание: <?=$app['description']?></p>
                <p>Категория: <?=$categoryName?></p>
                <p class="status" id="status">Статус заявки: <b><?=$app['status']?></b></p>
<?php if($app['status'] == 'Новая'){?>
                <a href="php\del_application.php?idApp=<?=$app['id_application']?>" class="deleteApp">Удалить заявку</a>
<?php } ?>
            </div>
<?}?>
        </div>

        <h2>Создать заявку</h2>

            <form enctype="multipart/form-data" action="php\add_application.php" method="POST" class="flex" id="add"> 
                <p class="error"><?=$_GET['message'];?></p>
                <input type="text" name="name" placeholder="Кличка питомца" required>
                <textarea name="description" placeholder="Описание работы" required rows="3"></textarea>
                <select name="category" id="">
<?php while($category = mysqli_fetch_assoc($queryCategories)){
    $idCategory = $category['id_category'];
    $nameCategory = $category['category'];
?>
                    <option value="<?=$idCategory?>"><?=$nameCategory?></option>
<? } ?>
                </select>
                <p>Загрузите фото питомца:</p>
                <input type="file" name="image" id="" required>
                <input type="submit" value="ОТПРАВИТЬ ЗАЯВКУ">
            </form>
    </main>
<?php include 'include/footer.php';?>
    <script src="js\user.js"></script>
</body>
</html>