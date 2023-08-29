<?php require_once __DIR__ . "/../../DataBase/DataBase.php";
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" type="text/css" href="style/style.css">
  <link rel="stylesheet" type="text/css" href="style/scroll.css">
  <link rel="stylesheet" type="text/css" href="../Head/head.css">
  <link rel="stylesheet" type="text/css" href="../Left-block/left-block.css">

  <script src="../JS/jquery-3.7.0.js"></script>
</head>
<body>
	<!-- Голова -->
	<?php require_once __DIR__."/../Head/head.php"?>
	<!-- Конец головы -->
	<div class="main-body">
		<div class="main">
			<!-- левый блок навигации -->
			<?php require_once __DIR__."/../Left-block/left-block.php"?>
			<!-- конец левого блока навигации -->

			<!-- Правый блок контент -->
			<div class="right-block-content">
        <div class="scroll">
          <div class="game-block-content">
            <?php
            $stmt = pdo()->prepare("SELECT * FROM gameinfo");
            $stmt->execute();
            $games = $stmt->fetchAll(PDO::FETCH_ASSOC);

               // Получаем параметры из формы поиска
            $searchTitle = $_POST['search_title'] ?? '';
            $selectedGenres = $_POST['Genres'] ?? [];

            foreach ($games as $game) {
              // Проверяем соответствие названия игры поисковому запросу
              if (!empty($searchTitle) && stripos($game['NameGame'], $searchTitle) === false) {
      continue; // Пропускаем игру, если название не соответствует запросу
    }

    // Проверяем, выбраны ли жанры для фильтрации
    if (!empty($selectedGenres)) {
      $gameGenres = explode(', ', $game['Genres']);
      $intersection = array_intersect($gameGenres, $selectedGenres);
      if (empty($intersection)) {
        continue; // Пропускаем игру, если нет пересечения жанров
      }
    }

    // Вывод информации о игре
    ?>
    <div class="block-game">
      <div class="img-block">
        <img src="../img/<?php echo $game['Preview'] ?>">
      </div>
      <div class="right-block-inf">
        <div>
          <span class="NameGame">Название: <?php echo $game['NameGame'] ?></span> <br>
          <span class="NameGame">Студия: <?php echo $game['NameStudio'] ?></span> <br>
          <span class="NameGameGenres">
            Жанры: <?php echo (count($words = explode(' ', trim($game['Genres']))) > 6) ? implode(' ', array_slice($words, 0, 6)) . '...' : $game['Genres'] ?>
          </span> <br>

          <div class="button-block">
              <a href="../PageGame/page_game.php?IDGame=<?php echo $game['IDGame']; ?>">Подробнее</a>
              <form method="POST" action="PHP_comand/deleteGame.php">
                <input type="hidden" name="IDGame" value="<?php echo $game['IDGame'] ?>">
                <button type="submit" class="delete-button">Удалить</button>
              </form>
          </div>
        </div>
      </div>
    </div>
    <?php
  }
  ?>
</div>

</div>
</div>
<!-- Конец правого блока контент -->

<!-- начало блока поиска -->
<div class="seach-game-content">
  <form method="POST" action="">
    <div class="seach-input-position">
      <img src="../Icons/seach.svg">
      <input type="text" name="search_title" class="input-seach" placeholder="Поиск по названию">
    </div>
    <div class="label-genre">
     <label>Поиск по жанрам:</label>
    </div>
    <div class="genre-checkboxes">
      <?php require_once __DIR__ . "/genres-list.php"; ?>
    </div>
    <div class="seach-input-position">
      <button type="submit" class="button-seach">Поиск</button>
    </div>
  </form>

</div>
<!-- Конец блока поиска -->
</div>

</div>
</body>
</html>
<?php 
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Получаем параметры из формы
  $searchTitle = $_POST['search_title'] ?? '';
  $selectedGenres = $_POST['Genres'] ?? [];

  // Строка для условия жанров
  $genresCondition = "";
  if (!empty($selectedGenres)) {
    $genresCondition = "AND Genres IN ('" . implode("','", $selectedGenres) . "')";
  }

  // SQL-запрос с учетом поиска по названию и выбранным жанрам
  $stmt = pdo()->prepare("SELECT * FROM gameinfo WHERE NameGame LIKE :title $genresCondition");
  $stmt->bindValue(':title', "%$searchTitle%", PDO::PARAM_STR);
  $stmt->execute();
  $games = $stmt->fetchAll(PDO::FETCH_ASSOC);
} ?>