<!DOCTYPE html>
<html lang="ru">
  <head>
    <?php
      $website_title = 'AlexProger Articles';
      require 'blocks/head.php';
    ?>
  </head>
  <body>
    <?php require 'blocks/header.php'; ?>

    <main class="conteiner mt-5">
      <div class="row">
        <div class="col-md-8 ml-5 mb-3">
          <?php
            require_once 'mysql_connect.php';

            $sql = 'SELECT * FROM `articles` ORDER BY `date` DESC';
            $query = $pdo->query($sql);
            while ($row = $query->fetch(PDO::FETCH_OBJ)) {
              echo "<h2>$row->title</h2>
                <p>$row->intro</p>
                <p><b>Автор статті:</b> <mark>$row->author</mark></p>
                <a href='/news.php?id=$row->id' title='$row->title'>
                <button class='btn btn-warning mb-3'>Більше ...</button></a>
                <hr>";
            }
          ?>
        </div>

        <?php require 'blocks/aside.php'; ?>

      </div>
    </main>

    <?php require 'blocks/footer.php'; ?>
  </body>
</html>
