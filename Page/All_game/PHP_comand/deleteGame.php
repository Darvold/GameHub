<?php require_once __DIR__ . "/../../../DataBase/DataBase.php";
$stmt = pdo()->prepare("DELETE FROM gameinfo WHERE IDGame = :IDGame");
$stmt->execute(['IDGame' => $_POST['IDGame']]);
header('Location: ../all_game.php');