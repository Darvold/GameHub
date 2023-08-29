<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}  // добавляем эту строку, чтобы начать сессию
// Инициализируем сессию


// Простой способ сделать глобально доступным подключение в БД
function pdo(): PDO
{
    static $pdo;

    if (!$pdo) {
        $config = include __DIR__.'/config.php';
        // Подключение к БД
        $dsn = 'mysql:dbname='.$config['db_name'].';host='.$config['db_host'];
        $pdo = new PDO($dsn, $config['db_user'], $config['db_pass']);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    return $pdo;
}

function flash(?string $message = null, ?string $type = null)
{
    if ($message) {
        $_SESSION['flash'] = [
            'message' => $message,
            'type' => $type ?? 'info'
        ];
    } else {
        if (!empty($_SESSION['flash'])) { 
            $message = $_SESSION['flash']['message'];
            $type = $_SESSION['flash']['type'];
            $class = 'msg';
            if ($type === 'success') {
                $class .= ' msg_green';
            } elseif ($type === 'error') {
                $class .= ' msg_red';
            }
            ?>
            <div class="<?=$class?>">
                <?=$message?>
            </div>
            <?php 
        }
        unset($_SESSION['flash']);
    }
}

// Функция для обновления содержимого на основе выбранного региона и города
function updateRegionCities($region, $city) {
  // Ваша логика обновления содержимого
  // Например, выполнение запросов к базе данных или другие действия

  // Создаем ассоциативный массив с информацией о выбранном регионе и городе
  $data = array(
    'region' => $region,
    'city' => $city
  );

  // Преобразуем массив в формат JSON
  $json = json_encode($data);

  // Устанавливаем заголовки для указания типа содержимого
  header('Content-Type: application/json');

  // Возвращаем данные в формате JSON
  echo $json;
}
function LogoTitle() {
  echo '<link rel="icon" href="Page/Icons/IconLogo.svg" type="image/x-icon">';
}
function LogoTitlePage() {
  echo '<link rel="icon" href="../Icons/IconLogo.svg" type="image/x-icon">';
}


?>