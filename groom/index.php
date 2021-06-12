<?php
    // старт сессии
    session_start();
    // соединение с базой данных
    require ("..\php\connection.php");
    // проверка сессии
    require ("..\php\check_session.php");
    // проверка на роль администратора
    require ("..\php\check_admin.php");

    $queryCategories = mysqli_query($link, "SELECT `id_category`, `category` FROM `category`");
    $queryApplicationsUser = mysqli_query($link, "SELECT `id_application`, `id_user`, `name_dog`, `description`, `id_category`, `status`, `time` FROM `applications` WHERE `status` = 'Новая' ORDER BY `time` DESC");
    echo $_GET['message'];

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="..\css\style.css">
    <link rel="shortcut icon" href="..\logo\logo_groom.png" type="image/x-icon">		
    <title>Кабинет администратора</title>
</head>
<body>
<?php include "../include/header.php";?>
    <main class="main">
        <div class="menu flex">
            <a href="..\index.php" class="menu">Главная</a>
            <a href="..\php\logout.php" class="menu">Выход</a>
        </div>
        <h2>Категории</h2>

        <div class="containerCategory flex">
<?php
    while($categories = mysqli_fetch_assoc($queryCategories)){
        $idCategory = $categories['id_category'];
        $category = $categories['category'];
?>
            <div class="category">
                <p><?=$category?></p>
                <a href="..\php\del_category.php?idCategory=<?=$idCategory?>" class="del">Удалить категорию</a>
            </div>
<?php
    }
?>
        </div>

        <h2>Добавить категорию</h2>

        <form action="..\php\add_category.php" method="POST" class="flex">
            <input type="text" name="nameCategory" placeholder="Название категории" required>
            <input type="submit" value="Добавить">
        </form>

        <h2>Заявки пользователей</h2>

        <div class="containerUsersRequests flex">

            <?php
while($app = mysqli_fetch_assoc($queryApplicationsUser)){
    $id_application = $app['id_application'];
    $date = $app['time'];
    $name_dog = $app['name_dog'];
    $description = $app['description'];
    $status = $app['status'];
    $id_category = $app['id_category'];
    $categories = mysqli_query($link, "SELECT `category` FROM `category` WHERE `id_category` = 1");
    $category = mysqli_fetch_assoc($categories);
    $categoryName = $category['category'];
?>
                <div class="requestUsers">
                    <p>Время: <?=$date?></p>
                    <p>Кличка: <?=$name_dog?></p>
                    <p>Описание: <?=$description?></p>
                    <p>Категория: <?=$categoryName?></p>
                    <p class="status" id="status">Статус заявки: <b><?=$status?></b></p>

                    <p class="change">Чтобы сменить статус на <br><b>Обработка данных</b> <br> оставьте комментарий:</p>

                        <form action="..\php\processing_application.php" method="POST" class="flex">
                            <textarea name="comment" rows="2" placeholder="Комментарий" required></textarea>
                            <input type="hidden" name="idApp" value="<?=$id_application?>">
                            <input type="submit" value="СМЕНИТЬ">
                        </form>

                    <p class="change">Чтобы сменить статус на <br><b>Услуга оказана</b> <br>загрузите фото питомца:</p>

                        <form action="..\php\done_application.php" enctype="multipart/form-data" method="POST" class="flex">
                            <input type="hidden" name="idApp" value="<?=$id_application?>">
                            <input type="file" name="image" required>
                            <input type="submit" value="СМЕНИТЬ">
                        </form>
                    
                </div>
<?
}
?>
            
        </div>
    </main>
    
<?php include "../include/footer.php";?>
</body>
</html>