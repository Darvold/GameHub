<?php
session_start();
require_once __DIR__ . "/../../DataBase/DataBase.php";

// Получаем ID сессии пользователя
$sessionID = session_id();

// Удаляем данные сессии пользователя из таблицы БД по IDUser сессии
$stmt = pdo()->prepare("DELETE FROM `session` WHERE `SessionID` = :SessionID AND `IDUser` = :IDUser");
$stmt->execute([
    'SessionID' => $sessionID,
    'IDUser' => $_SESSION['IDUser']
]);

// Удаляем переменные сессии
unset($_SESSION['IDUser']);
unset($_SESSION[$_POST['IDUser']]);

// Завершаем сессию
session_destroy();

// Перенаправляем пользователя
header('Location: ../../index.php');
?>
