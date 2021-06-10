<?php
    // старт сессии
    session_start();
    // соединение с базой данных
    include ("connection.php");
    // проверка сессии
    include ("check_session.php");
    // проверка на роль администратора
    include ("check_admin.php");

	if (!getimagesize ($_FILES["image"]["tmp_name"])) {
		header ("Location: ../groom/index.php?message=Загружаемый файл должен быть изображением");
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
		header ("Location: ../groom/index.php?message=Поддерживаемые форматы изображения: jpeg, jpg, png и bmp");
		exit;
	}

	// получаем размер изображения
	$filesize = filesize ($_FILES["image"]["tmp_name"]);
	// перевод размера в мб
	$filesize = $filesize / (1024 * 1024);
	// проверка на размер изображения
	if($filesize > 2) {
		header ("Location: .../groom/index.php?message=Изображение не должно превышать 2 мб");
	}

    // формируем имя изображения
	$image_name = time () . $ext;
	// перемещаем изображение в директорию хранения
	if (!move_uploaded_file ($_FILES["image"]["tmp_name"], "../images/after/" . $image_name)) {
		header ("Location: ../groom/index.php?message=Произошла ошибка с сохранением вашего изображения");
		exit;
	}
	// путь для добавления в базу данных
	$path = "images/after/". $image_name;
    $idApp = $_POST['idApp'];
    $updateAppStatus = mysqli_query($link, "UPDATE `applications` SET `photo_after` = '$path', `status` = 'Услуга оказана' WHERE `id_application` = '$idApp';");
	header ("Location: ../groom/index.php?message=Категория добавлена");
	exit;
?>

