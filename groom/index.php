<?php
    // старт сессии
    session_start();
    // соединение с базой данных
    require ("..\include\connection.php");
    // проверка сессии
    require ("..\php\check_session.php");
    // проверка на роль администратора
    require ("..\php\check_admin.php");

    $queryCategories = mysqli_query($link, "SELECT `id_category`, `category` FROM `category`");
    $queryApplicationsUser = mysqli_query($link, "SELECT `id_application`, `id_user`, `name_dog`, `description`, `id_category`, `status`, `time` FROM `applications` WHERE `status` = 'Новая' ORDER BY `time` DESC");
    echo $_GET['message'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="..\css\style.css">
    <title>Кабинет администратора</title>
</head>
<body>
    <header>
        <div class="container-header flex">
            <img src="..\logo\logo_groom.png" alt="logo" class="logo">
            <p class="name">ГрумRoom</p>
        </div>
        <div class="menu flex">
            <a href="..\index.php" class="menu">Главная</a>
            <a href="..\php\logout.php" class="menu">Выход</a>
        </div>
    </header>
    <main>
        <div class="container-category flex">
            <div class="heading flex" id="category">
                <h3 class="title">Категории</h2>
            </div>
<?php
    while($categories = mysqli_fetch_assoc($queryCategories)){
        $idCategory = $categories['id_category'];
        $category = $categories['category'];
?>
            <div class="request">
                <p class="category"><?=$category?></p>
                <a href="..\php\del_category.php?idCategory=<?=$idCategory?>" class="del">Удалить категорию</a>
            </div>
<?php
    }
?>
        </div>
        <div class="container-form flex">
            <div class="heading flex">
                <h3 class="title">Добавить категорию</h2>
            </div>
            <form action="..\php\add_category.php" method="POST" class="flex">
                <input type="text" name="nameCategory" placeholder="Название категории" required>
                <input type="submit" value="Добавить">
            </form>
        </div>

        <div class="container-request flex">
            <div class="heading flex">
                <h3 class="title">Заявки пользователей</h2>
            </div>

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
                <div class="request">
                    <p class="date">Время: <?=$date?></p>
                    <p class="name-dog">Кличка: <?=$name_dog?></p>
                    <p class="description">Описание: <?=$description?></p>
                    <p class="category">Категория: <?=$categoryName?></p>
                    <p class="status" id="status">Статус заявки: <b><?=$status?></b></p>
                    <div class="prepare" id="prepare_<?=$id_application?>">
                    <p class="change"><a class="deleteApp">Чтобы сменить статус на <b>Обработка данных</b></a></p>

                        <form action="..\php\processing_application.php" method="POST" class="flex">
                            <p>Оставьте комментарий:</p>
                            <input type="text" name="comment" placeholder="Комментарий" required>
                            <input type="hidden" name="idApp" value="<?=$id_application?>">
                            <input type="submit" value="СМЕНИТЬ">
                        </form>
                    </div>
                    <div class="done" id="done_<?=$id_application?>">
                    <p class="change"><a class="deleteApp">Чтобы сменить статус на <b>Услуга оказана</b></a></p>

                        <form action="..\php\done_application.php" enctype="multipart/form-data" method="POST" class="flex">
                            <p>Загрузите фото питомца:</p>
                            <input type="hidden" name="idApp" value="<?=$id_application?>">
                            <input type="file" name="image" required>
                            <input type="submit" value="СМЕНИТЬ">
                        </form>
                    </div>
                    
                </div>
<?
}
?>
            
        </div>
    </main>
    <footer>
        <p class="footer">Задание выполнено в рамках подготовки к Демонстрационному экзамену</p>
        <p class="year">2021г.</p>

    </footer>

</body>
</html>