<?php
  $login = trim(filter_var($_POST['login'], FILTER_SANITIZE_STRING));
  $pass = trim(filter_var($_POST['pass'], FILTER_SANITIZE_STRING));

  $error = '';

  if (strlen($login) <= 3) {
    $error = 'Ввеіть логін';
  } else if (strlen($pass) <= 3) {
    $error = 'Введіть пароль';
  }

  if ($error != ''){
    echo $error;
    exit();
  }

  $hash = 'nasty';
  $pass = md5($pass . $hash);

  require_once '../mysql_connect.php';

  $sql = 'SELECT `id` FROM `users_blog` WHERE `login` = :login && `pass` = :pass';
  $query = $pdo->prepare($sql);
  $query->execute(['login' => $login, 'pass' => $pass]);

  $user = $query->fetch(PDO::FETCH_OBJ);
  if ($query->rowCount() == 0) { // или так $user->id == 0
    echo "Такого користувача не існує!";
  } else {
    setcookie('log', $login, time() + 3600 * 24 * 30, "/");
    echo "Готово";
  }
?>
