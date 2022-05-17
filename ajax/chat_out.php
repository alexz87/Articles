<?php
  $message = trim(filter_var($_POST['message'], FILTER_SANITIZE_STRING));

  require_once '../mysql_connect.php';

  if ($_POST['message'] != ''){
    $sql = 'INSERT INTO chat(message) VALUES(?)';
    $query = $pdo->prepare($sql);
    $query->execute([$message]);
  } else {
    echo "error";
  }
?>
