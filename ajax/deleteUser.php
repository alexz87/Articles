<?php
  $id = $_POST['id'];

  require_once '../mysql_connect.php';

  $sql = 'DELETE FROM `users_blog` WHERE `id` = ?';
  $query = $pdo->prepare($sql);
  $query->execute([$id]);
?>
