<?php
require_once __DIR__. '/../../../DataBase/database.php';

// Инициализируем переменную-флаг для проверки пройдены ли все этапы
$all_steps_passed = true;

// Проверяем, что логин и пароль заполнены
if (empty($_POST['Login']) || empty($_POST['Password']) || empty($_POST['Email'])) {
    flash('Не заполнены логин или пароль или Email.', 'error');
    header('Location: ../register.php');
    die;
    $all_steps_passed = false; // Если логин или пароль не заполнены, устанавливаем флаг в false
}

// Проверяем, совпадают ли пароли
if ($_POST['Password'] !== $_POST['Password_confirm']) {
    flash ('Пароли не совпадают.', 'error');
    header('Location: ../register.php'); // Возврат на форму регистрации
    die; // Остановка выполнения скрипта
    $all_steps_passed = false; // Если пароли не совпадают, устанавливаем флаг в false
}

// Проверяем, есть ли уже пользователь с таким логином
$stmt = pdo()->prepare("SELECT * FROM `user` WHERE `Email` = :Email");
$stmt->execute(['Email' => $_POST['Email']]);
if ($stmt->rowCount() > 0) {
    flash ('Этот Email уже используется.', 'error');
    header('Location: ../register.php'); // Возврат на форму регистрации
    die; // Остановка выполнения скрипта
    $all_steps_passed = false; // Если логин уже занят, устанавливаем флаг в false
}


// Добавим пользователя в базу
// Если все этапы пройдены успешно, добавим пользователя в базу
if ($all_steps_passed) {

    $stmt = pdo()->prepare("
        INSERT INTO user (IDUser, Login, Email,Password, DateReg) 
        VALUES (NULL, :Login, :Email, :Password, :DateReg);
        ");

    $stmt->execute([
        'Login' => $_POST['Login'], 
        'Email' => $_POST['Email'], 
        'Password' => password_hash($_POST['Password'], PASSWORD_BCRYPT),
        'DateReg' => date('Y-m-d H:i:s'),
    ]);

// получаем ID только что созданного пользователя
/*    $IDUser = pdo()->lastInsertId();*/
}


header('Location: ../../Authorization/logins.php');
flash ('Вы успешно зарегистрировались!', 'success');



// Добавление файла в папку
/*$destination = '../uploads/' . $filename;
if (!move_uploaded_file($_FILES['Avatar']['tmp_name'], $destination)) {
    flash('Ошибка загрузки файла. Попробуйте еще раз.', 'error');
    header('Location: register.php');
    die;
}*/