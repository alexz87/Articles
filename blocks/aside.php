<aside class="col-md-3">
  <div class="p-3 mr-2 mb-3">
    <img class="img-thubnail" src="/img/php.png" width="300px" heigth="300px">
  </div>
  <div class="p-3 mr-2 mb-3 bg-warning rounded">
    <h4><b>Цікаві факти</b></h4>
    <p>PHP — це зручна мова програмування високого рівня. 
      Не дивлячись на можливості застосування PHP в різноманітних галузях розробки, 
      його спеціалізація, зрештою це backend. 
      Хороший програміст вміє підібрати правильні інструменти виходячі із задачі, 
      а орієнтування PHP на веб-розробку робить його чудовим вибором для створення сайтів аба веб-сервісів. 
      Але не забувайте: мова програмування — це просто форма вираження, а зміст — це якість коду. 
      І зміст в цьому разі залежить не від мови, а від вашого досвіда та навичок!</p>
  </div>
  <div class="mt-3">
    <h4 class="mb-3">Чат</h4>
    <form id='test' action="" method="post">

      <?php
        $mess = '';
        if (isset($_POST['message'])) {
          echo $_POST['message'];
        }
      ?>

    </form>
    <form action="" method="post">
      <input name="message" id="message" class="form-control mt-3" placeholder="Повідомлення"></input>
      <button type="button" id="chat_send" class="btn btn-info mt-3 mb-5">Надіслати</button>
    </form>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <script>

    $('#chat_send').click(function () {
      var message = $('#message').val();

      $.ajax({
        url: 'ajax/chat_out.php',
        type: 'POST',
        cache: false,
        data: {'message' : message},
        dataType: 'html',
        success: function(data) {
          $('#message').val(null);
          if (data == 'error'){
            alert('ERROR');
          }
        }
      });
    })

    setInterval(function showAll() {
      console.log(
        $.ajax({
          url: 'ajax/chat_show.php',
          type: 'POST',
          cache: false,
          data: {},
          dataType: 'html',
          success:function(data) {
            if(data != 'no messages') {
              $('#test').html(data);
              $('#errorBlock').hide();
            }
          }
        })
      );
    }, 3000);

  </script>
</aside>
