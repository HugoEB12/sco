<?php define('Assets',"../../../Assets/") ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Error | Conexi&oacute;n</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?php echo Assets;?>/images/sco/edomex-logo.png" type="image/png">
    <link href="<?php echo Assets;?>/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  </head>
  <body class="container">
    <div class="text-center">
      <h1 class="display-4 text-info">
        <span id="500"></span>
      </h1>
      <h3>
        <span id="500-txt"></span>
      </h3>
      <h4 class="text-info">
        <span id="500-txt-2"></span>
      </h4>
      <div id="content-500" style="display: none;">
        <hr>
        <a href="https://sanjosedelrincon.gob.mx/" class="btn btn-sm btn-outline-secondary">
          Ir al Portal Principal
        </a>
        <a class="btn btn-outline-secondary btn-sm" href="../../Sessions/login.php">
          Volver a intentar
        </a>
        <hr>
        <p class="text-center badge">
          Notifica a los administradores(as) del sistema si el problema continua.
        </p>
      </div>
    </div>
    <hr>
    <div class="footer text-center">
      <img src="<?php echo Assets;?>/images/sco/sjr-logo.png">
      <p class="text-info">Sistema de Control de Oficios <br> San José del Rincón, Estado de México 2020</p>
      <hr>
      <h3>Contáctanos:</h3>
      <p>
        <img src="<?php echo Assets;?>/images/icons/mono/24x24/phone.png">  712-1242097 | 712-1242098 | <img src="<?php echo Assets;?>/images/icons/mono/24x24/email.png">  municipio@sanjosedelrincon.gob.mx
      </p>
    </div>
    <script type="text/javascript" src="<?php echo Assets;?>/plugins/jquery/jquery-3.4.1.min.js"></script>
    <script src="<?php echo Assets;?>/plugins/typed/typed.min.js"></script>
    <script src="<?php echo Assets;?>/bootstrap/js/bootstrap.min.js"></script>
    <script>
      $(function(){
        $("#500").typed({
          strings: ["Error: 500"],
          typeSpeed: 100,
          backDelay: 500,
          loop: false,
          contentType: 'html',
          loopCount: false,
          callback: function() {
            $('h1 .typed-cursor').css('-webkit-animation', 'none').animate({opacity: 0}, 400);
            $("#500-txt").typed({
              strings: ["Internal server error.<br>Oops!, parece que algo no ha salido bien."],
              typeSpeed: 1,
              backDelay: 20,
              loop: false,
              contentType: 'html',
              loopCount: false,
              callback: function() {
                $('h3 .typed-cursor').css('-webkit-animation', 'none').animate({opacity: 0}, 400);
                $("#500-txt-2").typed({
                  //strings: ["Go back to our site or <a href='mailbox-send.html'>contact us</a> about the problem. "],
                  strings: ["Ve a la página de inicio y vuelve a intentarlo."],
                  typeSpeed: 1,
                  backDelay: 20,
                  loop: false,
                  contentType: 'html',
                  loopCount: false,
                  callback: function() {
                    $('#content-500').fadeIn(2000);
                  },
                });
              }
            });
          }
        });
      });
    </script>
  </body>
</html>
