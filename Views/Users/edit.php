<?php require_once "../Templates/UI-Components/Users/init.path.php"; ?>
<?php $controller = new SubjectController(); ?>
<?php $id = $_GET["id"]; ?>
<?php $entity = $controller->showById($id); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Asuntos | Edición</title>
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
        <br/>
        <div class="col-lg-12">
          <!-- HERE COMES CONTENT -->
          <?php require_once ui_component.'verify_message.php'; ?>
          <!--container-->
          <div class="container">
            <hr class="border-default-theme"/>
            <div class="text-right">
              <label class="p-2 font-weight-bold">Opciones:</label>
              <a href="view.php?id=<?php echo $id; ?>" class="link link-outline-danger img">
                Cancelar
                <img src="<?php echo Assets;?>/images/icons/mono/16x16/back.png">
              </a>
              <a href="search.php" class="link link-outline-default img">
                Búsqueda
                <img src="<?php echo Assets;?>/images/icons/mono/16x16/busqueda.png">
              </a>
              <a href="turns.php" class="link link-outline-default img">
                Turnos
                <img src="<?php echo Assets;?>/images/icons/mono/16x16/turn.png">
              </a>
              <?php //session_start(); ?>
              <?php if ($_SESSION["finish"] == "SI"): ?>
                <a href="final.response.php?id=<?php echo $id; ?>" class="link link-outline-purple img">
                  Finalizar Asunto
                  <img src="<?php echo Assets;?>/images/icons/mono/16x16/complete.png">
                </a>
              <?php endif; ?>
            </div>

            <hr class="border-default-theme"/>

            <div class="text-content-default text-center">
              <img src="<?php echo Assets;?>/images/icons/mono/24x24/information.png"> 
              Datos del Oficio
            </div>
            <hr class="border-default-theme">

            <!--card-->
            <div class="card border border-default-theme">
              <div class="card-header">
                <label class="p-2 font-weight-bold">#:</label>
                <span><?php echo $entity["id_subject"]; ?></span>
              </div>
              <div class="card-body">
                <!--start card-body-->
                <label class="p-2 font-weight-bold">Referencia:</label>
                <span><?php echo $entity["reference"]; ?></span>
                <label class="p-2 font-weight-bold">Ejercicio:</label>
                <span><?php echo $entity["year"]; ?><span>
                <label class="p-2 font-weight-bold">Tipo:</label>
                <span><?php echo $entity["request"]; ?></span>

                <hr class="border-default-theme">

                <label class="p-2 font-weight-bold">Ingresó:</label>
                <span><?php echo $entity["admission"]; ?></span>

                <label class="p-2 font-weight-bold">Venció:</label>
                <span><?php echo $entity["expiration"]; ?></span>

                <label class="p-2 font-weight-bold">Prioridad:</label>
                <span><?php echo $entity["priority"]; ?></span>

                <label class="p-2 font-weight-bold">Estatus:</label>
                <span>En proceso <div class="sphere sphere-green"></div></span>               

                <hr class="border-default-theme">

                <div class="row">
                  <div class="col">
                    <label class="p-2 font-weight-bold">Remitente:</label>
                    <br/>
                    <span>
                      <?php $s = $controller->showSender($entity["sender"]); ?>
                      <?php echo $s["name"]; ?><br/>
                      <?php echo $s["job"]; ?><br/>
                      <?php echo $s["dependency"]; ?>
                    </span>    
                  </div>
                  <div class="col">
                    <label class="p-2 font-weight-bold">Para:</label>
                    <br/>
                    <span>
                      <?php $r = $controller->showReceiver($entity["receiver"]); ?>
                      <?php echo $r["name"]; ?><br/>
                      <?php echo $r["job"]; ?><br/>
                      <?php echo $r["dependency"]; ?>
                    </span>
                  </div>
                  <div class="col">
                    <label class="p-2 font-weight-bold">Turnado por:</label>
                    <br/>
                    <span>
                      <?php $u = $controller->showUser($entity["by"]); ?>
                      <?php echo $u["name"]; ?><br/>
                      <?php echo $u["job"]; ?><br/>
                      <?php echo $u["name_dependency"]; ?>
                    </span>
                  </div>
                </div>

                <hr class="border-default-theme">

                <div class="row">
                  <div class="col">
                    <label class="p-2 font-weight-bold">Asunto:</label>
                    <p class="text-justify">
                      <?php echo $entity["subject"]; ?>
                    </p>
                  </div>

                  <div class="col">
                    <label class="p-2 font-weight-bold">Indicaciones:</label>
                    <p class="text-justify">
                      <?php echo $entity["indications"]; ?>
                    </p>
                  </div>
                </div>

                <!-- END CARD-BODY-->
              </div>
              <div class="card-footer">
                <small>Fecha de Creación: <?php echo $entity["created"]; ?></small>
              </div>
            </div>  
            <!--card-->

            <hr class="border-default-theme">

            <div class="text-content-default text-center">
              <img src="<?php echo Assets;?>/images/icons/mono/24x24/history.png"> Historial de turnos y Seguimiento
            </div>

            <hr class="border-default-theme">

            <a href="new.turn.php?id=<?php echo $id; ?>" class="link link-outline-default img">
              Agregar turno:
              <img class="" src="<?php echo Assets;?>/images/icons/mono/16x16/plus.png">
            </a>

            <hr class="border-default-theme">

            <table class="table">
              <caption>Turnos sobre el asunto</caption>
              <thead class="bg-default-theme text-light">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Turnado por: <img class="invert" src="<?php echo Assets;?>/images/icons/mono/24x24/friend.png"></th>
                  <th colspan="1"></th>
                  <th scope="col">Turnado a: <img class="invert" src="<?php echo Assets;?>/images/icons/mono/24x24/user.png"></th>
                  <th scope="col">Fecha / Hora <img class="invert" src="<?php echo Assets;?>/images/icons/mono/24x24/timetable.png"></th>
                </tr>
              </thead>
              <tbody>
              <?php foreach ($controller->showTurns($id) as $key => $t):?>
                <tr>
                  <td><?php echo $key; ?></td>
                  <td>
                    <?php $u = $controller->showUser($t["by"]); ?>
                    <?php echo $u["name"]; ?><br/>
                    <?php echo $u["job"]; ?><br/>
                    <?php echo $u["name_dependency"]; ?>
                  </td>
                  <td>
                    <img class="" src="<?php echo Assets;?>/images/icons/multi/24x24/arrow.png">
                  </td>
                  <td>
                    <?php $u = $controller->showUser($t["for"]); ?>
                    <?php echo $u["name"]; ?><br/>
                    <?php echo $u["job"]; ?><br/>
                    <?php echo $u["name_dependency"]; ?>
                  </td>
                  <td>
                    <?php echo $t["created"]; ?>
                  </td>
                </tr>
              <?php endforeach; ?>
              </tbody>
            </table>

            <hr class="border-default-theme">

            <div class="text-content-default text-center">
              <img class="" src="<?php echo Assets;?>/images/icons/mono/24x24/investigation.png"> Evidencia sobre el Asunto:
            </div>

            <hr class="border-default-theme">

            <a href="new.evidence.php?id=<?php echo $id; ?>" class="link link-outline-default img">
              Agregar Evidencia:
              <img class="" src="<?php echo Assets;?>/images/icons/mono/16x16/plus.png">
            </a>

            <hr class="border-default-theme">

            <table class="table table-bordered">
              <caption>Archvos adjuntos sobre el asunto.</caption>
              <thead class="bg-default-theme text-light">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Archivo <img class="invert" src="<?php echo Assets;?>/images/icons/mono/24x24/paperclip.png"></th>
                  <th scope="col">Descripción <img class="invert" src="<?php echo Assets;?>/images/icons/mono/24x24/file.png"></th>
                  <th scope="col">Subido por <img class="invert" src="<?php echo Assets;?>/images/icons/mono/24x24/file.png"></th>
                  <th scope="col">Fecha / Hora <img class="invert" src="<?php echo Assets;?>/images/icons/mono/24x24/timetable.png"></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach (explode("$", $entity["evidences"]) as $key => $e):?>
                  <?php $evidence = explode("#", $e); ?>
                  <tr>
                    <td><?php echo $key; ?></td>
                    <td>
                      <a href="<?php echo $evidence[0]; ?>" target="_blank" class="link link-sm link-outline-default"><img src="<?php echo Assets;?>/images/icons/multi/24x24/pdf.png"><?php echo $evidence[1]; ?></a>
                    </td>
                    <td>
                      <?php echo $evidence[2]; ?>
                    </td>
                    <td>
                      <?php $u = $controller->showUser($evidence[3]); ?>
                      <?php echo $u["name"]; ?><br/>
                      <?php echo $u["job"]; ?><br/>
                      <?php echo $u["name_dependency"]; ?>
                    </td>
                    <td>
                      <?php echo $evidence[4]; ?>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
            
          </div>
          <!--container-->
          
          <hr class="border-default-theme"/>

          <div class="text-left">
            <label class="p-2 font-weight-bold">Opciones:</label>
            <a href="view.php?id=<?php echo $id; ?>" class="link link-outline-danger img">
              Cancelar
              <img src="<?php echo Assets;?>/images/icons/mono/16x16/back.png">
            </a>
            <a href="search.php" class="link link-outline-default img">
              Búsqueda
              <img src="<?php echo Assets;?>/images/icons/mono/16x16/busqueda.png">
            </a>
            <a href="turns.php" class="link link-outline-default img">
                Turnos
                <img src="<?php echo Assets;?>/images/icons/mono/16x16/turn.png">
              </a>
            <?php //session_start(); ?>
            <?php if ($_SESSION["finish"] == "SI"): ?>
              <a href="final.response.php?id=<?php echo $id; ?>" class="link link-outline-purple img">
                Finalizar Asunto
                <img src="<?php echo Assets;?>/images/icons/mono/16x16/complete.png">
              </a>
            <?php endif; ?>
          </div>
          
          <hr class="border-default-theme"/>
          
          <h4 class="text-content-default text-right"><strong>Vista detallada</strong> del Asunto.</h4>
          <!-- HERE END CONTENT -->
        </div>

        <hr class="border-default-theme">

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
