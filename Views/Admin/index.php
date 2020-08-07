<?php require_once "../Templates/UI-Components/Admin/init.path.php"; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Dashboard | Subdirecciones</title>
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
      <!--BEGIN CONTAINER-->
      <div class="container">
        <h4 class="text-default"><strong>Bienvenido(a)</strong> Administrador(a)</h4>
        <!--START COL-LG-12-->
        <div class="col-lg-12">
          <!-- HERE COMES YOUR CONTENT -->
          <?php require_once ui_component."verify.message.php"; ?>
          <hr class="border-default-theme">
          <p class="text-justify">
            Resúmen de cada sección.
          </p>
          <div class="card-deck">
            <!---->
            <div class="card border border-default-theme">
              <div class="card-body">
                <h5 class="card-title text-center text-default-theme"><i><u>Usuarios(as).</u></i></h5>
                <p class="card-text text-justify">
                  En ésta sección se administran los Usuarios(as)/Empleados(as) del Sistema.<br>
                  <ul>
                    <li>
                      Cada <b>Usuario(a)</b> tendrá privilegios para realizar el registro y control de asuntos.
                    </li>
                    <li>
                      Pero sólo <b>algunos</b> tendrán la posibilidad de <i>"Finalizar Asuntos"</i>, por ejemplo: Jefes de Área o Personal expecífico.
                    </li>
                  </ul>
                </p>
                <p class="card-text">
                  <a href="Users/" class="link link-outline-default"> ir a "Usuarios". </a>
                </p>
              </div>
            </div>
            <!---->

            <!---->
            <div class="card border border-default-theme">
              <div class="card-body">
                <h5 class="card-title text-center text-default-theme"><i><u>Dependencias.</u></i></h5>
                <p class="card-text text-justify">
                  En ésta sección se administran las Dependencias.<br>
                  <ul>
                    <li>
                      Las dependencias se clasifican por 4 tipos: (Presidencia, Dirección, Subdirección y Departamento).
                    </li>
                  </ul>
                </p>
                <p class="card-text">
                  <a href="Dependencies/" class="link link-outline-default"> ir a "Dependencias". </a>
                </p>
              </div>
            </div>
            <!---->

            <!---->
            <div class="card border border-default-theme">
              <div class="card-body">
                <h5 class="card-title text-center text-default-theme"><i><u>Remitentes y Destinatarios.</u></i></h5>
                <p class="card-text text-justify">
                  Éste catálogo está destinado para controlar al personal que se necesita en el registro de los Asuntos.
                </p>
                <p class="card-text">
                  <a href="Employees/" class="link link-outline-default"> ir a "Remitentes y Destinatarios". </a>
                </p>
              </div>
            </div>
            <!---->
          </div>
          <hr>
          <div class="card-deck">
            <!---->
            <div class="card border border-default-theme">
              <div class="card-body">
                <h5 class="card-title text-center text-default-theme"><i><u>Administradores.</u></i></h5>
                <p class="card-text text-justify">
                  Realice modificaciones pertinentes para delegar la administración del sitema al personal correspondiente.
                </p>
                <p class="card-text">
                  <a href="Administrators/" class="link link-outline-default"> ir a "Administradores". </a>
                </p>
              </div>
            </div>
            <!---->
          </div>

          <hr class="border-default-theme">

          <!-- BEGIN FOOTER CONTENT-->
        </div>
        <!--END COL-LG-12-->

        <!--BEGIN FOOTER CONTENT-->
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
    <script src="<?php echo Assets;?>/js/admin.js" type="text/javascript"></script>
    <script src="<?php echo Assets;?>/plugins/popper/popper.min.js" type="text/javascript"></script>
    <script src="<?php echo Assets;?>/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

  </body>

</html>
