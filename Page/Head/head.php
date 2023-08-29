
<div class="main-header">
	<div class="left_block_header">	
		<a href="" class="header_boxs-1"><span class="header_text-1">Меню</span></a>
		<a href="" class="header_boxs-2"><span class="header_text-2">Профиль</span></a>
		<a href="" class="header_boxs-3"><span class="header_text-3">Статьи</span></a>
		<a href="" class="header_boxs-4"><span class="header_text-4">Новости</span></a>
	</div>
	<div class="center_block_header">	
		<span href="#" class="header_block_logo"><img src="../Icons/IconLogoWhite.svg" class="svg">GameHub<img src="../Icons/IconLogoRed.svg" class="svg_right"></span>
	</div>
	<div class="right_block_header">
		<?php 
		$sessionUserID = $_SESSION['IDUser'];
		$pdo = pdo();

// Выполняем запрос к базе данных для получения данных пользователя
		$stmt = $pdo->prepare("SELECT Login, Email FROM User WHERE IDUser = :IDUser");
		$stmt->bindValue(':IDUser', $sessionUserID, PDO::PARAM_INT);
		$stmt->execute();
		$user = $stmt->fetch(PDO::FETCH_ASSOC);
		echo $user['Email'];
		?>
		<form action="../PHP_comand/logout.php" method="POST">
			<input type="hidden" name="IDUser" value="<?php echo $_SESSION['IDUser']; ?>">
			<button type="submit" class="Head_exit_button">Выход</button>
		</form>
	</div>
</div>