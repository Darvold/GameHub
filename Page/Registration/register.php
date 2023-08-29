<?php 
require_once __DIR__. '/../../DataBase/database.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
} 
 ?>
 <!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>FoxHub</title>
	<link rel="stylesheet" href="style/Registration.css">
	<link rel="stylesheet" href="style/Navigation.css">
	<link rel="stylesheet" href="style/BG-image.css">

</head>
<body>

<!-- Шапка -->
	<header>

	</header>
<!-- Конец шапки -->


<!-- Вход/Регистрация в появляющемся окне -->
<div class="wrapper">
	<span class="icon-close">
		<ion-icon name="close-outline"></ion-icon>
	</span>

<!-- Регистрация -->
		<div class="FoxHub">
			<a href="../../index.php" class="Logo-name"> 
			<img src="../Icons/IconLogoRed.svg" class="svg">
			<h2 class="logo">Game<span class="H">H</span>ub</h2>
			</a>
		</div>
		<div class="form-box">

			<h2>Регистрация</h2>
			<form method="POST" action="php_comand/reg.php" >
					<label>Введите ваш логин:</label>
				<div class="input-box">
				<input type="text" name="Login" required placeholder="Придумайте ваш логин">
			</div>
					<label>Введите ваш Email:</label>
			<div class="input-box-2">
				<input type="Email" name="Email" required placeholder="Введите ваш Email">
			</div>
			<label>Введите ваш пароль:</label>
			<div class="input-box-3">
				<input type="password" name="Password" required placeholder="Придумайте пароль">
			</div>
			<label>Подтвердите свой пароль:</label>
			<div class="input-box-4">
				<input type="password" name="Password_confirm" required placeholder="Подтвердите ваш пароль">
			</div>

			<div class="button_class">
				<button class="btn" type="submit">Зарегистрироваться</button>
			</div>
		</form>
		<div class="remember-forgot">
			<!-- <p>Забыли пароль? – <a href="#">Тогда вам сюда!</a></p> -->
		</div>
		<div class="login-register">
			<p>У вас уже есть аккаунт? – <a href="../Authorization/logins.php" class="register-link">Авторизируйтесь!</a></p>
		</div>
	</div>
	<?php '<div class="form-box">' . flash() . '</div>' ?>
	<!-- Конец регистрации -->
</div>
</body>
</html>