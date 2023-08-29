<?php require_once __DIR__ . "/../../DataBase/DataBase.php";
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

$IDGame = $_GET['IDGame'];
$stmt = pdo()->prepare('SELECT * FROM gameinfo WHERE IDGame = :IDGame');
$stmt->execute(['IDGame' => $IDGame]); 
$games = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($games as $game) {
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" type="text/css" href="style/style.css">
	<link rel="stylesheet" type="text/css" href="../Head/head.css">
	<link rel="stylesheet" type="text/css" href="../Left-block/left-block.css">
  <script src="../JS/jquery-3.7.0.js"></script>
  <script>
    $(document).ready(function() {
      $('.file-game').on('change', function() {
    var file = $(this)[0].files[0]; // Получаем только первый выбранный файл
    $('.preview-container').empty();
    
    if (file) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('.preview-container').html('<div class="flex-img-delete"><img class="image-preview" src="' + e.target.result + '" /><div class="position-button"><button class="remove-btn">Удалить</button></div></div>');
      };
      reader.readAsDataURL(file);
    }
  });

      $(document).on('click', '.remove-btn', function() {
        $('.preview-container').empty();
    $('.file-game').val(""); // Очищаем значение input для файла
  });
    });
  </script>
</head>
<body>

	<!-- Голова -->
	<?php require_once __DIR__."/../Head/head.php"?>
 <?php $notification = $_SESSION['notification'] ?? null;
unset($_SESSION['notification']); // Очищаем уведомление после отображения

if ($notification) {
  echo '<div class="notification-content">
  <div class="notification">' . $notification . '</div>
  </div>';
} ?>
<script>
  $(document).ready(function() {
            $(".notification").css('top', '-100px'); // Скрываем уведомление за пределами видимой области
            setTimeout(function() {
              $(".notification").animate({top: 0}, 1000, function() {
                setTimeout(function() {
                  $(".notification").animate({top: '-100px'}, 1000, function() {
                    $(this).remove();
                  });
                    }, 7000); // 3 секунды
              });
            }, 0); // Задержка перед появлением
          });
        </script>
        <!-- Конец головы -->
        <div class="main-body">
          <div class="main">
           <!-- левый блок навигации -->
           <?php require_once __DIR__."/../Left-block/left-block.php"?>
           <!-- конец левого блока навигации -->

           <!-- Правый блок контент -->
           <div class="right-block-content">
            <?php require_once __DIR__ . "/update_form.php"; ?>

            <form method="POST">
             <input type="hidden" name="update" value="<?php echo $game['IDGame'] ?>">
             <button type="submit" name="update-submit" class="update-submit">Изменить</button>
           </form>
           <?php if(isset($_POST['update-submit'])) { ?>
           <form method="POST">
            <input type="hidden" name="update" value="<?php echo $game['IDGame'] ?>">
            <button type="submit" name="cencel-submit" class="cencel-submit">Отменить</button>
          </form>
          <?php } else { ?>
          <?php }  ?>
        </div>

      </div>
      <!-- Конец правого блока контент -->
    </div>

  </div>
</body>
</html>
