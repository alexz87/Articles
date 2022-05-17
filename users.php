<!DOCTYPE html>
<html lang="ru">
  <head>
    <?php
    $website_title = 'Всі користувачі';
    require 'blocks/head.php';
    ?>
  </head>
  <body>

    <?php require 'blocks/header.php'; ?>

    <main class="conteiner mt-5">
      <div class="row">
        <div class="col-md-8 ml-5 mb-3">
          <h4>Список користувачів</h4>
          <a class="btn btn-info mt-3 mb-3" href="/auth.php">Назад</a><br>
          <?php
            require_once 'mysql_connect.php';

            $sql = 'SELECT * FROM `users_blog`'; // ORDER BY `id` DESC
            $query = $pdo->prepare($sql);
            $query->execute();
            $users = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach($users as $el) {

              echo '<div class="alert alert-info" id="'.$el['id'].'">
                <b>Імя:</b> '.$el['name'].', <b>логін:</b> '.$el['login'].'
                <button onclick="deleteUser(\''.$el['id'].'\')" class="btn btnx btn-danger">Видалити</button>
              </div>';
            }
          ?>
        </div>

        <?php require 'blocks/aside.php'; ?>

      </div>
    </main>

    <?php require 'blocks/footer.php'; ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>

      function deleteUser(id) {
        $.ajax({
          url: 'ajax/deleteUser.php',
          type: 'POST',
          cache: false,
          data: {'id' : id},
          dataType: 'html',
          success: function(data) {
            $('#' + id).remove();
            document.location.reload(true);
          }
        });
      }

    </script>
  </body>
</html>
