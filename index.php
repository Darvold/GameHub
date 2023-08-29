<?php require_once __DIR__ .'/DataBase/DataBase.php' ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
<?php LogoTitle(); ?>

    <title>GameGub</title>
    <link rel="stylesheet" href="Style/style.css">
    <link rel="stylesheet" href="Style/Navigation.css">
    <link rel="stylesheet" href="Style/BD-image.css">
    <link rel="stylesheet" href="Style/Content.css">

</head>
<body>

<!-- Шапка -->
    <header class="up_menu">
        <div class="CSHub">
            <a href="#" class="Logo-name"> 
            <img src="Page/Icons/IconLogo.svg" class="svg">
            <h2 class="logo"><span class="C">G</span>ame<span class="S">H</span>u<span class="H">B</span></h2>
            </a>
        </div>
            

        <nav class="navigation">
            <a href="#">О нас</a>
            <a href="#">Сервисы</a>
            <a href="#">Контакты</a>
            <a class="btnLogin-popup" href="Page/Authorization/logins.php">Войти</a>
            <a class="btnLogin-popup" href="Page/Registration/register.php">Зарегистрироваться</a>
        </nav>
    </header>
<!-- Конец шапки -->

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>
</html>