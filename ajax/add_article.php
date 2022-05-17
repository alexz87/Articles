<?php
  $title = trim(filter_var($_POST['title'], FILTER_SANITIZE_STRING));
  $intro = trim(filter_var($_POST['intro'], FILTER_SANITIZE_STRING));
  $text = trim($_POST['text']);

  $error = '';

  if (strlen($title) <= 3) {
    $error = 'Введіть назву статті';
  } else if (strlen($intro) <= 15) {
    $error = 'Введіть інтро статті';
  } else if (strlen($text) <= 20) {
    $error = 'Введіть текст статті';
  }

  if ($error != ''){
    echo $error;
    exit();
  }

  require_once '../mysql_connect.php';

  $login = $_COOKIE['log'];
  $sql = 'SELECT * FROM `users_blog` WHERE `login` = :login';
  $query = $pdo->prepare($sql);
  $query->execute(['login' => $login]);
  $user = $query->fetch(PDO::FETCH_OBJ);

  $sql = 'INSERT INTO articles(title, intro, text, date, author) VALUES(?, ?, ?, ?, ?)';
  $query = $pdo->prepare($sql);
  $query->execute([$title, $intro, $text, time(), $user->name]);

  echo "Готово";
?>
