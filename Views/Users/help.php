<?php require_once "../Templates/UI-Components/Users/init.path.php"; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Asuntos | Ayuda</title>
    <?php require_once ui_component."head.php"; ?>
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
                Asuntos &nbsp; <img class="float-right" src="<?php echo Assets;?>/images/icons/mono/24x24/clipboard.png">
              </a>
              <a class="nav-item nav-link text-content-default" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">
                Búsqueda &nbsp; <img class="float-right" src="<?php echo Assets;?>/images/icons/mono/24x24/busqueda.png">
              </a>
              <a class="nav-item nav-link text-content-default" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">
                Turnos &nbsp; <img class="float-right" src="<?php echo Assets;?>/images/icons/mono/24x24/turn.png">
              </a>
            </div>
          </nav>
          <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active border bg-white" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
              <p class="text-justify">
                <ul>
                  <li>
                    <b>Asuntos:</b>
                    <p class="text-justify">
                      En ésta sección se realiza el registro de los oficios para iniciar un nuevo asunto.
                    </p>
                  </li>
                  <li>
                    <b>Turnar Asunto:</b>
                    <p class="text-justify">
                      En el formulario de registro, cada asunto/oficio registrado se <u>turnará o asignará</u> al personal correspondiente.
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
                    <b>Búsqueda:</b>
                    <p class="text-justify">
                      Se podrá tener acceso sólo a los oficios registrados por el usuario en la sesión actual.
                    </p>
                  </li>
                </ul>
              </p>
            </div>
            <div class="tab-pane fade border bg-white" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
              <p class="text-justify">
                <ul>
                  <li>
                    <b>Turnos:</b>
                    <p class="text-justify">
                      En ésta sección aparecen todos los asuntos que se asignaron al usuario(a) actual y aquellos que el usuario(a) actual asignó o turnó.
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
