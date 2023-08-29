<?php 
require_once __DIR__ . "/../../../DataBase/DataBase.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$IDGame = $_POST['IDGame'];
$stmt = pdo()->prepare('SELECT * FROM gameinfo WHERE IDGame = :IDGame');
$stmt->execute(['IDGame' => $IDGame]); 
$games = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($games as $game) {
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $pdo = PDO(); // Функция для получения подключения к базе данных

    // Подготовка SQL запроса с параметрами для обновления
    $sql = "UPDATE gameinfo SET";
    $params = [];

    // Проверка и добавление атрибута NameGame
    if (!empty($_POST['NameGame'])) {
        $sql .= " NameGame = :NameGame,";
        $params['NameGame'] = $_POST['NameGame'];
    }

    // Проверка и добавление атрибута NameStudio
    if (!empty($_POST['NameStudio'])) {
        $sql .= " NameStudio = :NameStudio,";
        $params['NameStudio'] = $_POST['NameStudio'];
    }

    // Проверка и добавление атрибута Description
    if (!empty($_POST['Description'])) {
        $sql .= " Description = :Description,";
        $params['Description'] = $_POST['Description'];
    }

if (!empty($_FILES['Preview'])) {
    $file = $_FILES['Preview'];
    $allowedFormats = ['jpg', 'jpeg', 'png', 'gif'];

    if ($file['error'] === UPLOAD_ERR_OK &&
        in_array(pathinfo($file['name'], PATHINFO_EXTENSION), $allowedFormats)) {

        // Удаление старой фотографии, если она существует
        if (!empty($game['Preview'])) {
            unlink('../../img/' . $game['Preview']);
        }

        $newFileName = substr(md5(time()), 0, 9) . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);
        $uploadPath = '../../img/' . $newFileName;
        move_uploaded_file($file['tmp_name'], $uploadPath);

        $sql .= " Preview = :Preview,";
        $params['Preview'] = $newFileName;
    }
}


    if (!empty($_POST['Genres'])) {
    $genres = implode(', ', $_POST['Genres']);
    $sql .= " Genres = :Genres,";
    $params['Genres'] = $genres;
}



    // Убираем лишнюю запятую в запросе
    $sql = rtrim($sql, ',');

    // Добавляем условие WHERE для обновления конкретной строки
    $sql .= " WHERE IDGame = :IDGame";
    $params['IDGame'] = $IDGame;

    // Выполнение запроса с параметрами
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);

    // Редирект и уведомление
    header("Location: ../page_game.php?IDGame=$IDGame");
    $_SESSION['notification'] = '<div class="response-success">Изменения успешно сделаны!</div>';
    exit();
}