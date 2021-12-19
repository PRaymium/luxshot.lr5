var uploadForm = document.getElementById('upload-form');

async function imgDataSend(e) {
	e.preventDefault();

	// let uploadFormFile = document.getElementById('upload-form_file');
	// let uploadFormCheckbox = document.getElementById('upload-form_checkbox');

	let uploadFormError = document.getElementById('upload-form__error');

	let uploadFormData = new FormData(uploadForm);

	fetch('add_item_handler.php', {
		method: 'POST',
		body: uploadFormData
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
                    if (currentValue == "file_type") {
						if (uploadFormError.textContent == "") {
							uploadFormError.textContent += "Выберите .jpg файл!";
						}
						else {
							uploadFormError.textContent += "\nВыберите .jpg файл!";
						}
					}
                    if (currentValue == "file_size") {
						if (uploadFormError.textContent == "") {
							uploadFormError.textContent += "Выбранный файл слишком большой";
						}
						else {
							uploadFormError.textContent += "\nВыбранный файл слишком большой";
						}
					}
                    if (currentValue == "file_error") {
						if (uploadFormError.textContent == "") {
							uploadFormError.textContent += "Непредвиденная ошибка";
						}
						else {
							uploadFormError.textContent += "\nНепредвиденная ошибка";
						}
                        uploadFormError.textContent += "\n" + result.file_error_message;
					}
                    if (currentValue == "file_move") {
						if (uploadFormError.textContent == "") {
							uploadFormError.textContent += "Ошибка при перемещении файла на сервере";
						}
						else {
							uploadFormError.textContent += "\nОшибка при перемещении файла на сервере";
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

uploadForm.addEventListener("submit", imgDataSend);