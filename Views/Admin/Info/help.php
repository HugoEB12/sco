<?php require_once "../../Templates/UI-Components/Admin/init.path.php"; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <link rel="shortcut icon" href="<?php echo Assets;?>/images/sco/edomex-logo.png" type="image/png">
    <title>Administración | Ayuda</title>
    <link href="<?php echo Assets;?>/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo Assets;?>/css/admin.css" rel="stylesheet">
  </head>

  <!-- BEGIN BODY -->
  <body onload="startTime()">

    <!-- BEGIN TOPBAR -->
    <?php require_once ui_component."topbar.php"; ?>
    <!-- END TOPBAR -->

    <!-- BEGIN SIDEBAR -->
    <?php require_once ui_component."sidebar.php"; ?>
    <!-- END SIDEBAR -->

    <!-- BEGIN PAGE CONTENT -->
    <div class="side-content">

      <div class="container">

        <div class="col-lg-12">
          <!-- HERE COMES YOUR CONTENT -->
          <hr class="bg-info" />
          <h4>Bienvenido(a) a la sección de "Ayuda".</h4>
          <hr class="bg-info" />
          <!---->
          <p class="text-justify">
            Descripción por sección:
          </p>
          <hr/>
          <!---->
          <nav class="text-info">
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
              <a class="nav-item nav-link text-content-default active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">
                Usuarios &nbsp; <img class="float-right" src="<?php echo Assets;?>/images/icons/mono/24x24/user.png">
              </a>
              <a class="nav-item nav-link text-content-default" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">
                Dependencias &nbsp; <img class="float-right" src="<?php echo Assets;?>/images/icons/mono/24x24/dependencia.png">
              </a>
              <a class="nav-item nav-link text-content-default" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">
                Remitentes y Destinatarios &nbsp; <img class="float-right" src="<?php echo Assets;?>/images/icons/mono/24x24/external.png">
              </a>
            </div>
          </nav>
          <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active border bg-white" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
              <p class="text-justify">
                <ul>
                  <li>
                    <b>Usuarios del Sistema:</b>
                    <p class="text-justify">
                      Cada usuario registrado en el sistema será encargado de realizar el registro de Asuntos.
                    </p>
                  </li>
                  <li>
                    <b>Finalizar Asuntos:</b>
                    <p class="text-justify">
                      Cuando el asunto se ha atendido (favorable o negativamente) se tendrá que finalizar.
                      <br/>
                      Sólo aquellos usuarios registrados con el privilegio "Finalizar Asuntos" tendrán la posibilidad de concluir asuntos. Por ejemplo: Jefes de área o usuarios específicos según se indique.
                    </p>
                  </li>
                </ul>
              </p>
            </div>
            <div class="tab-pane fade border bg-white" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
              <p class="text-justify">
                <ul>
                  <li>
                    <b>Dependencias:</b>
                    <p class="text-justify">
                      Las dependencias se clasifican de acuerdo a 4 tipos:
                      <ol>
                        <li>PRESIDENCIA</li>
                        <li>DIRECCIÓN</li>
                        <li>SUBDIRECCIÓN</li>
                        <li>DEPARTAMENTO</li>
                      </ol>
                      <br/>
                      La clasificación se eligió con base al organigrama definido por el Ayuntamiento de San José del Rincón.
                    </p>
                  </li>
                </ul>
              </p>
            </div>
            <div class="tab-pane fade border bg-white" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
              <p class="text-justify">
                <ul>
                  <li>
                    <b>Remitentes y Destinatarios:</b>
                    <p class="text-justify">
                      El personal registrado como remitente y destinatario se utiliza para realizar un registro de asuntos más rápido y eficiente.
                    </p>
                  </li>
                </ul>
              </p>
            </div>
          </div>
          <!---->
        </div>

      </div>
      <!-- END CONTAINER -->
    </div>
    <!-- END SIDE CONTENT -->

    <?php include_once ui_component."bottombar.php"; ?>

    <!-- SRCRIPTS-->
    <script src="<?php echo Assets;?>/plugins/jquery/jquery-3.4.1.min.js" type="text/javascript"></script>
    <script src="<?php echo Assets;?>/plugins/popper/popper.min.js" type="text/javascript"></script>
    <script src="<?php echo Assets;?>/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo Assets;?>/js/admin.js" type="text/javascript"></script>
    <!---->

  </body>

</html>
