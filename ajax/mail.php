<?php
  $username = trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING));
  $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
  $mess = trim(filter_var($_POST['mess'], FILTER_SANITIZE_STRING));

  $error = '';

  if (strlen($username) <= 3) {
    $error = "Введіть ім'я";
  } else if (strlen($email) <= 3) {
    $error = 'Введіть email';
  } else if (strlen($mess) <= 3) {
    $error = 'Введіть повідомлення';
  }

  if ($error != ''){
    echo $error;
    exit();
  }

  $my_email = 'admin@alexproger.com';
  $subject = "=?utf-8?B?" . base64_decode('Нове повідомлення з AlexProger Articles') . "?=";
  $headers = "From: $email\r\nReply-to: $email\r\nContent-type: text/html; charset=utf-8\r\n"; //text/html

  mail($my_email, $subject, $mess, $headers);

  echo "Готово";
?>
