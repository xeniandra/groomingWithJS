	// счетчик
	document.addEventListener('DOMContentLoaded', e => {
		const counterElem = document.querySelector('p.counter');

		setInterval( () =>
		{
			fetch('../php/counter.php')
				.then(res => res.json())
				.then(data => {
					if (parseInt(data.counter) !== parseInt(counterElem.textContent))
					{
						counterElem.animate([
							{transform: 'scale(1)'},
							{transform: 'scale(1.5)'},
							{transform: 'scale(1)'}
						],{
							duration: 1000
						})
						counterElem.textContent = data.counter;

						let audio = new Audio('../aud.mp3');
						audio.play();
						setTimeout( () => {
							audio.pause();
						}, 3000)
					}
				})
		}, 5000);

	})
	
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

