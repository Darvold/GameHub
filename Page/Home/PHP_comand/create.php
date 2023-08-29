<?php
require_once __DIR__ . "/../../../DataBase/DataBase.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_POST['Genres'])) {
    header('Location: ../home.php');
    $_SESSION['notification'] = '<div class="response-success">Выберите хотя бы один жанр</div>';
    exit;
}

if (!isset($_FILES['Preview'])) {
    header('Location: ../home.php');
    $_SESSION['notification'] = '<div class="response-success">Файл предварительного просмотра отсутствует</div>';
    exit;
}

$file = $_FILES['Preview'];
$allowedFormats = ['jpg', 'jpeg', 'png', 'gif'];

if ($file['error'] !== UPLOAD_ERR_OK || !in_array(pathinfo($file['name'], PATHINFO_EXTENSION), $allowedFormats)) {
    header('Location: ../home.php');
    $_SESSION['notification'] = '<div class="response-success">Неверный формат файла или ошибка при загрузке файла.</div>';
    exit;
}

$newFileName = substr(md5(time()), 0, 9) . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);
$uploadPath = '../../img/' . $newFileName;

if (!move_uploaded_file($file['tmp_name'], $uploadPath)) {
    header('Location: ../home.php');
    $_SESSION['notification'] = '<div class="response-success">Ошибка загрузки файла</div>';
    exit;
}

$data = [
    'IDUser' => $_SESSION['IDUser'],
    'NameGame' => $_POST['NameGame'],
    'NameStudio' => $_POST['NameStudio'],
    'Preview' => $newFileName,
    'Description' => $_POST['Description'],
    'Genres' => implode(', ', $_POST['Genres']),
];

$stmt = pdo()->prepare("INSERT INTO gameinfo (IDUser, NameGame, NameStudio, Preview, Description, Genres) VALUES (:IDUser, :NameGame, :NameStudio, :Preview, :Description, :Genres)");

if ($stmt->execute($data)) {
    header('Location: ../home.php');
    $_SESSION['notification'] = '<div class="response-success">Игра успешно создана!</div>';
} else {
    header('Location: ../home.php');
    $_SESSION['notification'] = '<div class="response-success">Ошибка при вставке данных</div>';
}
