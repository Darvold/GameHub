<?php if(isset($_POST['update-submit'])) { ?>
<style type="text/css">
    .update-submit {
        display: none;
    }
</style>
<form method="POST" action="PHP_comand/update_inf.php" enctype="multipart/form-data">
	<input type="hidden" name="IDGame" value="<?php echo $IDGame ?>">
<!-- Начало головы -->
   <div class="head-form-name">
       <span><input type="text" name="NameGame" value="<?php echo $game['NameGame'] ?>"></span>
   </div>
   <div class="head-form-border">
       <span class="border-button"></span>
   </div>
  <!-- Конец головы -->

  <div class="body-content-inf">
    <!-- Содержимое игры -->
    <span class="text-info-if">Студия разработчиков: <input type="text" name="NameStudio" value="<?php echo $game['NameStudio'] ?>"></span> <br> <br> 

    <span class="text-info-if">Описание: <input type="textarea" name="Description" value="<?php echo $game['Description'] ?>"></span> <br> <br> 

    <span class="text-info">Жанры: <?php require_once __DIR__."/genres-list.php" ?></span><br> <br> 
    <div></div>
    <span class="text-info">Изображение игры (Загрузите новое изображение, если хотите изменить его):</span> 
    <input style="color: white;" type="file" name="Preview" class="file-game"><br>  <br> 
    <div class="preview-container"></div>
     <!-- Конец содержимого игры -->
     <button type="submit" name="cencel-submit" class="confirm-submit">Подтвердить изменения</button>
</form>

<?php } elseif(isset($_POST['cencel-submit'])) { ?>

<!-- Начало головы -->
   <div class="head-form-name">
       <span><?php echo $game['NameGame']; ?></span>
   </div>
   <div class="head-form-border">
       <span class="border-button"></span>
   </div>
  <!-- Конец головы -->

  <div class="body-content-inf">
    <!-- Содержимое игры -->
    <span class="text-info">Студия разработчиков: <?php echo $game['NameStudio']; ?></span> <br> <br> 
    <span class="text-info">Описание: <?php echo $game['Description']; ?></span> <br> <br> 
    <span class="text-info">Жанры: <?php echo $game['Genres']; ?></span><br> <br> 
    <span class="text-info">Изображение игры:</span> <br> <br> 
     <img src="../img/<?php echo $game['Preview'] ?>">
     <!-- Конец содержимого игры -->

<?php } else { ?>

<!-- Начало головы -->
   <div class="head-form-name">
       <span><?php echo $game['NameGame']; ?></span>
   </div>
   <div class="head-form-border">
       <span class="border-button"></span>
   </div>
  <!-- Конец головы -->

  <div class="body-content-inf">
    <!-- Содержимое игры -->
    <span class="text-info">Студия разработчиков: <?php echo $game['NameStudio']; ?></span> <br> <br> 
    <span class="text-info">Описание: <?php echo $game['Description']; ?></span> <br> <br> 
    <span class="text-info">Жанры: <?php echo $game['Genres']; ?></span><br> <br> 
    <span class="text-info">Изображение игры:</span> <br> <br> 
     <img src="../img/<?php echo $game['Preview'] ?>">
     <!-- Конец содержимого игры -->

<?php } ?>