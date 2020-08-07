<?php require_once "../Templates/UI-Components/Users/init.path.php"; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Usuarios | Inicio</title>
    <?php require_once ui_component."head.php"; ?>
  </head>

  <!-- BEGIN BODY -->
  <body onload="startTime()">

    <!-- BEGIN TOPBAR -->
    <?php include_once ui_component."topbar.php"; ?>
    <!-- END TOPBAR -->

    <!-- BEGIN SIDEBAR -->
    <?php include_once ui_component."sidebar.php"; ?>
    <!-- END SIDEBAR -->

    <!-- BEGIN PAGE CONTENT -->
    <div class="side-content">

      <div class="container">
        <hr class="border-default-theme">
        <h4 class="text-content-default"><strong>Bienvenido(a)</strong> <?php echo $_SESSION["name_user"]; ?>.</h4>
        <hr class="border-default-theme">
        <?php require_once ui_component.'verify_message.php'; ?>
        <hr class="border-default-theme">
        <div class="col-lg-12">
          <!-- HERE COMES CONTENT -->
          <h4 class="text-content-default text-center">Secciones del Sistema:</h4>
          <hr class="border-default-theme">

          <div class="card-deck">

            <div class="card border border-default-theme">
              <div class="card-body">
                <h5 class="card-title text-center text-default-theme"><i><u>Registro</u></i></h5>
                <p class="card-text text-justify">
                  En ésta sección se inicia un nuevo "Asunto".<br>
                  <ul>
                    <li>
                      Cada oficio se <b>registrará</b> y se <b>turnará</b> a al <b>personal</b> correspondiente.
                    </li>
                    <li>
                      Se deben <b>capturar</b> los <b>datos del oficio</b> (Referencia, Ejercicio, Asunto, Remitente, etc).
                    </li>
                    <li>
                      Es necesario <b>adjuntar</b> el oficio (escaneado), ya sea en formato <b>".pdf"</b>, de preferencia, o en su defecto un archivo en formato <b>".jpg"/".png"</b>.
                    </li>
                  </ul>
                </p>
                <p class="card-text">
                  <a href="record.php" class="link link-outline-default"> ir a "Registro". </a>
                </p>
              </div>
            </div>

            <div class="card border border-default-theme">
              <div class="card-body">
                <h5 class="card-title text-center text-default-theme"><i><u>Búsqueda</u></i></h5>
                <p class="card-text">
                  Consulta libre y búsqueda de oficios / asuntos específicos.<br>
                  Verificar estatus, modificar información, etc.
                </p>
                <p class="card-text">
                  <a href="search.php" class="link link-outline-default"> ir a "Búsqueda". </a>
                </p>
              </div>
            </div>
          </div>
          <hr class="border-default-theme">
          <!-- HERE END CONTENT -->
        </div>

        <!-- BEGIN FOOTER CONTENT-->
        <div class="footer">
        </div>
      <!-- END FOOTER CONTENT-->
      </div>
      <!-- END PAGE CONTENT -->
    </div>
    <!-- END MAIN CONTENT -->

    <?php include_once ui_component."bottombar.php"; ?>

    <!-- SRCRIPTS-->
    <script src="<?php echo Assets;?>/plugins/jquery/jquery-3.4.1.min.js" type="text/javascript"></script>
    <script src="<?php echo Assets;?>/plugins/popper/popper.min.js" type="text/javascript"></script>
    <script src="<?php echo Assets;?>/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo Assets;?>/js/user.js" type="text/javascript"></script>

  </body>

</html>
