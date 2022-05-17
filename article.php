<?php
  if ($_COOKIE['log'] == '') {
    header('Location: /auth.php');
    exit();
  }
?>

<!DOCTYPE html>
<html lang="ru">
  <head>
    <?php
    $website_title = 'Додавання статті';
    require 'blocks/head.php';
    ?>
  </head>
  <body>
    <?php require 'blocks/header.php'; ?>

    <main class="conteiner mt-5">
      <div class="row">
        <div class="col-md-8 ml-5 mb-3">
          <h4>Додавання статті</h4>
          <form action="" method="post">
            <label for="title">Заголовок статті</label>
            <input type="text" name="title" id="title" class="form-control">

            <label for="title">Інтро статті</label>
            <textarea name="intro" id="intro" class="form-control"></textarea>

            <label for="text">Текст статті</label>
            <textarea name="text" id="text" class="form-control"></textarea>

            <button type="button" id="article_send" class="btn btn-success mt-3">Додати</button>
          </form>
        </div>

        <?php require 'blocks/aside.php'; ?>

      </div>
    </main>

    <?php require 'blocks/footer.php'; ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
      $('#article_send').click(function () {
        var title = $('#title').val();
        var intro = $('#intro').val();
        var text = $('#text').val();

        $.ajax({
          url: 'ajax/add_article.php',
          type: 'POST',
          cache: false,
          data: {'title' : title, 'intro' : intro, 'text' : text},
          dataType: 'html',
          success: function(data) {
            if(data == 'Готово') {
              $('#article_send').text("Всё готово");
              $('#errorBlock').hide();
            } else {
              $('#errorBlock').show();
              $('#errorBlock').text(data);
            }
          }
        });
      })
    </script>
  </body>
</html>
