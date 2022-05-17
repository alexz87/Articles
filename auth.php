<!DOCTYPE html>
<html lang="ru">
  <head>
    <?php
    $website_title = 'Авторизація';
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

            $login = $_COOKIE['log'];
            $sql = 'SELECT * FROM `users_blog` WHERE `login` = :login';
            $query = $pdo->prepare($sql);
            $query->execute(['login' => $login]);
            $user = $query->fetch(PDO::FETCH_OBJ);

          ?>

          <?php
            if ($_COOKIE['log'] == ''):
          ?>
          <h4>Авторизація користувача</h4>
          <form action="" method="post">
            <label for="login">Логін</label>
            <input type="text" name="login" id="login" class="form-control">

            <label for="pass">Пароль</label>
            <input type="password" name="pass" id="pass" class="form-control">

            <div class="alert alert-danger mt-2" id="errorBlock"></div>

            <button type="button" id="auth_user" class="btn btn-success mt-3">Увійти</button>
          </form>
          <?php
            else:
          ?>
          <h2><?=$user->name?></h2>
          <button class="btn btn-danger" id="exit_btn">Вийти</button><br>
          <?php
            endif;
          ?>

          <?php if ($_COOKIE['log'] == 'admin'): ?>
          <a class="btn btn-info mt-3" href="/users.php">Всі користувачі</a>
          <?php endif; ?>

        </div>

        <?php require 'blocks/aside.php'; ?>

      </div>
    </main>

    <?php require 'blocks/footer.php'; ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
      $('#exit_btn').click(function () {

        $.ajax({
          url: 'ajax/exit.php',
          type: 'POST',
          cache: false,
          data: {},
          dataType: 'html',
          success: function(data) {
            document.location.reload(true);
          }
        });
      })

      $('#auth_user').click(function () {
        var login = $('#login').val();
        var pass = $('#pass').val();

        $.ajax({
          url: 'ajax/auth.php',
          type: 'POST',
          cache: false,
          data: {'login' : login, 'pass' : pass},
          dataType: 'html',
          success: function(data) {
            if(data == 'Готово') {
              $('#auth_user').text("Готово");
              $('#errorBlock').hide();
              document.location.reload(true);
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
