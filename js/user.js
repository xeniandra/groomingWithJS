function fn_app_filtration(status) {
    let app = document.querySelectorAll(".MyRequest");
    if(app.length == 0) return;
    if(status == undefined){
        for(let i = 0; i < app.length; i++ ){
            app[i].style.display = "block";
        }
        return;
    }
    	// получение текста статуса у всех заявок
		let stat = document.querySelectorAll(".MyRequest #status b");
		// фильтрация по статусу
		for(let i = 0; i < stat.length; i++) {
			// проверка на статус
			if(stat[i].innerHTML == status) {
				// отображение нужного блока
				app[i].style.display = "block";
				// переход на следующую итерацию цикла
				continue;
			}
			// Скрытие заявки в случае несоответствия фильтрации
			app[i].style.display = "none";
		}
}
