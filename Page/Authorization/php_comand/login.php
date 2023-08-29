<?php
session_start();
require_once __DIR__ . '/../../../DataBase/DataBase.php';

// Проверяем наличие пользователя с указанным email
$stmt = pdo()->prepare("SELECT * FROM `User` WHERE `Email` = :Email");
$stmt->execute(['Email' => $_POST['Email']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    flash('Пользователь с такими данными не зарегистрирован', 'error');
    header('Location: ../logins.php');
    exit();
}

// Проверяем пароль
if (password_verify($_POST['Password'], $user['Password'])) {
    // Проверяем, не нужно ли использовать более новый алгоритм хэширования
    if (password_needs_rehash($user['Password'], PASSWORD_DEFAULT)) {
        $newHash = password_hash($_POST['Password'], PASSWORD_DEFAULT);
        $stmt = pdo()->prepare('UPDATE `User` SET `Password` = :Password WHERE `Email` = :Email');
        $stmt->execute([
            'Email' => $_POST['Email'],
            'Password' => $newHash,
        ]);
    }

    // Проверяем, существует ли уже сессия для пользователя
    $stmt = pdo()->prepare("SELECT * FROM `Session` WHERE `IDUser` = :IDUser");
    $stmt->bindValue(':IDUser', $user['IDUser'], PDO::PARAM_INT);
    $stmt->execute();
    $session = $stmt->fetch();

    // Если сессия существует, удаляем её
    if ($session) {
        $stmt = pdo()->prepare("DELETE FROM `Session` WHERE `IDUser` = :IDUser");
        $stmt->bindValue(':IDUser', $user['IDUser'], PDO::PARAM_INT);
        $stmt->execute();
    }

    // Добавляем сессию пользователя в таблицу БД
    $stmt = pdo()->prepare("INSERT INTO `Session` (`SessionID`, `IDUser`, `Start_Time`, `IPAddress`) VALUES (:SessionID, :IDUser, NOW(), :IPAddress)");
    $stmt->execute([
        'SessionID' => session_id(),
        'IDUser' => $user['IDUser'],
        'IPAddress' => filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP) ?: 'Unknown'
    ]);

    $_SESSION['IDUser'] = $user['IDUser'];
    $_SESSION['Email'] = $user['Email'];
    $_SESSION['IDUser_' . $user['IDUser']] = true;

    header('Location: ../../Home/home.php');


    exit();
} else {
    flash('Пароль неверен', 'error');
    header('Location: ../logins.php');
    exit();
}