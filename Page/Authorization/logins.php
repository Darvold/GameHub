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
<?php LogoTitlePage(); ?>
	<title>GameHub</title>
	<link rel="stylesheet" href="style/Authorization.css">
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

<!-- Авторизация -->
		<div class="FoxHub">
			<a href="../../index.php" class="Logo-name"> 
			<img src="../Icons/IconLogo.svg" class="svg">
			<h2 class="logo">Game<span class="H">H</span>ub</h2>
			</a>
		</div>
		<div class="form-box">

			<h2>Авторизация</h2>
			<form method="POST" action="php_comand/login.php">
				<label>Введите свой Email:</label>
				<div class="input-box">
				</span>
				<input type="text" name="Email" required placeholder="Введите ваш Email">
			</div>
			<label>Введите свой пароль:</label>
			<div class="input-box-2">
				<input type="password" name="Password" required placeholder="Введите ваш пароль">
			</div>

			<div class="button_class">
				<button class="btn" type="submit">Войти</button>
			</div>

		</form>
		<div class="remember-forgot">
			<p>Забыли пароль? – <a href="#">Тогда вам сюда!</a></p>
		</div>
		<div class="login-register">
			<p>У вас нет аккаунта? – <a href="../Registration/register.php" class="register-link">Зарегистрируйтесь!</a></p>
		</div>
	</div>
			<?php '<div class="form-box">' . flash() . '</div>' ?>
	<!-- Конец авторизации -->
</div>
</body>
</html>