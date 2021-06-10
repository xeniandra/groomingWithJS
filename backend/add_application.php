<?php
    // старт сессии
    session_start();
    // соединение с базой данных
    include ("connection.php");
    // проверка сессии
    include ("check_session.php");
	if (!getimagesize ($_FILES["image"]["tmp_name"])) {
		header ("Location: ../user.php?message=Загружаемый файл должен быть изображением");
		exit;
	}
	// получаем мета данные изображения
	$arr = getimagesize ($_FILES["image"]["tmp_name"]);
	// проверяем формат загружаемого изображения
	if ($arr["mime"] == "image/png") { // png
		$ext = ".png";
	}
    elseif ($arr["mime"] == "image/jpeg") { // jpeg, jpg
		$ext = ".jpg";
	}
    elseif ($arr["mime"] == "image/bmp") { // bmp
		$ext = ".bmp";
	}
    else { 
		// в случае иных расширений
		header ("Location: ../user.php?message=Поддерживаемые форматы изображения: jpeg, jpg, png и bmp");
		exit;
	}

	// получаем размер изображения
	$filesize = filesize ($_FILES["image"]["tmp_name"]);
	// перевод размера в мб
	$filesize = $filesize / (1024 * 1024);
	// проверка на размер изображения
	if($filesize > 2) {
		header ("Location: ../user.php?message=Изображение не должно превышать 2 мб");
	}

    // формируем имя изображения
	$image_name = time () . $ext;
	// перемещаем изображение в директорию хранения
	if (!move_uploaded_file ($_FILES["image"]["tmp_name"], "../images/before/" . $image_name)) {
		header ("Location: ../user.php?message=Произошла ошибка с сохранением вашего изображения");
		exit;
	}
	// путь для добавления в базу данных
	$path = "images/before/". $image_name;

    $IdUser = $_SESSION['id_user'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $insertApp = mysqli_query($link, "INSERT INTO `applications` (`id_application`, `id_user`, `name_dog`, `description`, `id_category`, `photo_before`, `photo_after`, `status`, `time`) 
    VALUES (NULL, '$IdUser', '$name', '$description', '$category', '$path', NULL, 'Новая', NOW());");
	header ("Location: ../user.php?message=Заявка создана#auth");
	exit;
?>