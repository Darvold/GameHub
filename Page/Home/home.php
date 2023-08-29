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
				<form method="POST" action="PHP_comand/create.php" class="big-form-create" enctype="multipart/form-data">

					<!-- Шапка -->
					<div class="head-form-name">
						<h1>Создание новой игры</h1>
					</div>
					<div class="head-form-border">
						<span class="border-button"></span>
					</div>
					<!-- Конец шапки -->

					<!-- поля заполнения -->
					<div class="input-block">
						<div class="input-block-content">
							<label class="name-game">Название игры:</label>
							<input type="text" name="NameGame" class="name-input-game"required>
						</div>
						<div class="input-block-content">
							<label class="name-studio">Название студии:</label>
							<input type="text" name="NameStudio" class="name-input-studio"required>
						</div>						
						<div class="input-img">
							<label class="name-studio">Загрузка изображения игры:</label>
							<input type="file" name="Preview" class="file-game"required>
							<div class="preview-container-block">
								<div class="preview-container"></div>
							</div>
						</div>

						<div class="flex-block">
							
						
						<div class="text-description-block">
							<label class="name-description">Описание игры:</label>
							<br>
							<textarea type="textarea" name="Description" class="text-description" maxlength="2000" placeholder="максимум символов: 2000"></textarea>
						</div>
						<div class="block-option-genre">
							<span class="title-genre-list">Список для выбора жанра</span>
							<br>
							<label for="genreSelect" class="text-genre">Жанры:</label>
							<?php require_once __DIR__ . "/genres-list.php" ?>
						</div>
					</div>
				</div>
				<!-- конец полей заполнений -->
				<div class="absolute">
						<div id="errorContainer" class="errorContainer"></div>
				</div>
				<!-- Создать -->
				<div class="submit-button">
					<button type="submit" class="submit" id="save-btn">Создать</button>
				</div>
				<!-- Создать -->
			</form>
		</div>
		<!-- Конец правого блока контент -->
	</div>

</div>
</body>
</html>
