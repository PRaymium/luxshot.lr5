var download_button = document.getElementById('download_button');

async function downloadImage(e) {
	e.preventDefault();

	let uploadFormData = new FormData(uploadForm);

	fetch('download_img.php', {
	}
	)
		.then(response => response.json())
		.then((result) => {
			console.log(result);
			if (result.errors) {
				//вывод ошибок валидации на форму
				uploadFormError.textContent = "";
				result.errors.forEach(function callback(currentValue) {
					if (currentValue == "file") {
						if (uploadFormError.textContent == "") {
							uploadFormError.textContent += "Вы не выбрали файл для загрузки";
						}
						else {
							uploadFormError.textContent += "\nВы не выбрали файл для загрузки";
						}
					}
				})
			} else {
				if (result.success) {
                    window.location.href=result.post_url.toString();
                }
			}
		})
		.catch(error => console.log(error));
}

download_button.onclick = downloadImage();