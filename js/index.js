	// функция отображения  старого изображения
	function fn_image_enter(e) {
		document.querySelector("#" + e.target.id + " div.before").style.display = "none";
		document.querySelector("#" + e.target.id + " div.after").style.display = "block";
	}
	// функция скрытия старого изображения
	function fn_image_leave(e) {
		document.querySelector("#" + e.target.id + " div.before").style.display = "block";
		document.querySelector("#" + e.target.id + " div.after").style.display = "none";
	}

