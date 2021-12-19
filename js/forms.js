var loginButton = document.getElementById('header-login-button');
var formContainer = document.getElementById('form-container');
var loginFormToSignupFormToggle = document.getElementById('login-form-button-to-signup');
var signupFormToLoginFormToggle = document.getElementById('signup-form-button-to-login');
var closeFormButton = document.getElementsByClassName('close-form-button');

var loginForm = document.getElementById('login-form');
var signupForm = document.getElementById('signup-form');

loginButton.onclick = function () {
	loginForm.classList.add("visible");
	formContainer.classList.add("blurred");
}

loginFormToSignupFormToggle.onclick = function () {
	signupForm.classList.add("visible");
	loginForm.classList.remove("visible")
}

signupFormToLoginFormToggle.onclick = function () {
	signupForm.classList.remove("visible");
	loginForm.classList.add("visible")
}

closeFormButton[0].onclick = function () {
	loginForm.classList.remove("visible");
	formContainer.classList.remove("blurred");
}

closeFormButton[1].onclick = function () {
	signupForm.classList.remove("visible");
	formContainer.classList.remove("blurred");
}

async function registrationDataSend(e) {
	e.preventDefault();

	let regFormNameInput = document.getElementById('signupForm-name-input');
	let regFormEmailInput = document.getElementById('signupForm-email-input');
	let regFormPhoneInput = document.getElementById('signupForm-phone-input');
	let regFormPasswordInput = document.getElementById('signupForm-password-input');
	let regFormPasswordRepeatInput = document.getElementById('signupForm-passwordRepeat-input');

	// if (!(regFormPasswordRepeatInput.value == regFormPasswordInput.value)) {
	// 	alert("Пароли не совпадают");
	// 	return;
	// }

	if (regFormNameInput.classList.contains("invalid")) {
		regFormNameInput.classList.remove("invalid");
	}
	if (regFormEmailInput.classList.contains("invalid")) {
		regFormEmailInput.classList.remove("invalid");
	}
	if (regFormPhoneInput.classList.contains("invalid")) {
		regFormPhoneInput.classList.remove("invalid");
	}
	if (regFormPasswordInput.classList.contains("invalid")) {
		regFormPhoneInput.classList.remove("invalid");
	}
	if (regFormPasswordRepeatInput.classList.contains("invalid")) {
		regFormPasswordRepeatInput.classList.remove("invalid");
	}

	let regFormError = document.getElementById('signupForm-error');

	let registerForm = new FormData(this);

	fetch('register.php', {
		method: 'POST',
		body: registerForm
	}
	)
		.then(response => response.json())
		.then((result) => {
			console.log(result);
			if (result.errors) {
				//вывод ошибок валидации на форму
				regFormError.textContent = "";
				result.errors.forEach(function callback(currentValue) {
					if (currentValue == "name") {
						regFormNameInput.classList.add("invalid");
						if (regFormError.textContent == "") {
							regFormError.textContent += "Некорректное имя";
						}
						else {
							regFormError.textContent += "\nНекорректное имя";
						}
					}
					if (currentValue == "email") {
						regFormEmailInput.classList.add("invalid");
						if (regFormError.textContent == "") {
							regFormError.textContent += "Некорректный email";
						}
						else {
							regFormError.textContent += "\nНекорректный email";
						}
					}
					if (currentValue == "phone") {
						regFormPhoneInput.classList.add("invalid");
						if (regFormError.textContent == "") {
							regFormError.textContent += "Некорректный номер телефона";
						}
						else {
							regFormError.textContent += "\nНекорректный номер телефона";
						}
					}
					if (currentValue == "password") {
						regFormPasswordInput.classList.add("invalid");
						if (regFormError.textContent == "") {
							regFormError.textContent += "Некорректный пароль";
						}
						else {
							regFormError.textContent += "\nНекорректный пароль";
						}
					}
					if (currentValue == "passwordRepeat") {
						regFormPasswordRepeatInput.classList.add("invalid");
						if (regFormError.textContent == "") {
							regFormError.textContent += "Пароли не совпадают";
						}
						else {
							regFormError.textContent += "\nПароли не совпадают";
						}
					}
					if (currentValue == "checkbox") {
						if (regFormError.textContent == "") {
							regFormError.textContent += "Необходимо принять соглашение на обработку персональных данных";
						}
						else {
							regFormError.textContent += "\nНеобходимо принять соглашение на обработку персональных данных";
						}
					}
				})
			} else if (!result.email_check) {
				regFormError.textContent = "";
				regFormError.textContent += "Пользователь с таким email уже существует";
				regFormEmailInput.classList.add("invalid");
				console.log("Пользователь с таким email уже существует");
			}
			else {
				//успешная регистрация, обновляем страницу
				window.location.reload()
			}
		})
		.catch(error => console.log(error));
}



async function authorizationDataSend(e) {
	e.preventDefault();

	let loginFormEmailInput = document.getElementById('loginForm-email-input');
	let loginFormPasswordInput = document.getElementById('loginForm-password-input');

	if (loginFormEmailInput.classList.contains("invalid")) {
		loginFormEmailInput.classList.remove("invalid");
	}
	if (loginFormPasswordInput.classList.contains("invalid")) {
		loginFormPasswordInput.classList.remove("invalid");
	}

	let loginFormError = document.getElementById('loginForm-error');

	let loginForm = new FormData(this);

	fetch('login.php', {
		method: 'POST',
		body: loginForm
	}
	)
		.then(response => response.json())
		.then((result) => {
			console.log(result);
			if (result.errors) {
				//вывод ошибок валидации на форму
				loginFormError.textContent = "";
				result.errors.forEach(function callback(currentValue) {
					if (currentValue == "email") {
						loginFormEmailInput.classList.add("invalid");
						if (loginFormError.textContent == "") {
							loginFormError.textContent += "Пользователь с таким email не найден";
						}
						else {
							loginFormError.textContent += "\nПользователь с таким email не найден";
						}
					}
					if (currentValue == "password") {
						loginFormPasswordInput.classList.add("invalid");
						if (loginFormError.textContent == "") {
							loginFormError.textContent += "Некорректный пароль";
						}
						else {
							loginFormError.textContent += "\nНекорректный пароль";
						}
					}
				})
			} else {
				//успешная авторизация, обновляем страницу
				window.location.reload()
			}
		})
		.catch(error => console.log(error));
}

loginForm.addEventListener("submit", authorizationDataSend);
signupForm.addEventListener("submit", registrationDataSend);