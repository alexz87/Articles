<?php
  require_once '../mysql_connect.php';

  // Получаем все сообщения из БД
  $sql = 'SELECT * FROM `chat` ORDER BY `id` ASC';
  $query = $pdo->prepare($sql);
  $query->execute();
  $messages = $query->fetchAll(PDO::FETCH_ASSOC);

  // Если сообщений нет, то выводим сообщение что их нет
  // Плюс выходим из скрипта при помощи exit()
  if(count($messages) == 0) {
    echo 'no messages';
    exit();
  }

  // Создаем переменную, в которую через цикл поместим все сообщения
  $html = '';
  foreach($messages as $el)
    $html .= '<div class="alert alert-info">'.$el['message'].'</div>';

  // Возвращаем из скрипта все эти сообщения
  echo $html;
?>
