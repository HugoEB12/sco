<?php require_once "../Templates/UI-Components/Users/init.path.php"; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Asuntos | Turnos</title>
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
        <div class="col-lg-12">
          <!-- HERE COMES CONTENT -->
          <!---->
          <hr class="border-default-theme">
          <h4 class="text-default-theme text-content-default">Te han <strong>Turnado</strong> los siguientes: <strong>Asuntos</strong></h4>
          <hr class="border-default-theme">
          <!---->
          <?php $controller = new TurnController(); ?>
          <?php $entity = $controller->showPaginateFor(isset($_GET["page"])?$_GET["page"]:0,$controller->getUserBySession()); ?>
          <?php if (count($entity) > 0){ ?>
            <!--TABLE-->
            <table class="table table-bordered table-hover">
              <thead class="bg-default-theme text-light">
                <tr>
                  <th>#</th>
                  <th>
                    Turno
                    <img class="invert" src="<?php echo Assets;?>/images/icons/mono/24x24/turn.png">
                  </th>
                  <th>
                    Asunto
                    <img class="invert" src="<?php echo Assets;?>/images/icons/mono/24x24/sco.png">
                  </th>
                  <th>
                    Turnado por:
                    <img class="invert" src="<?php echo Assets;?>/images/icons/mono/24x24/user2.png">
                  </th>
                  <th>
                    Fecha
                    <img class="invert" src="<?php echo Assets;?>/images/icons/mono/24x24/timetable.png">
                  </th>
                  <th align="center">
                    Acciones
                    <img class="invert" src="<?php echo Assets;?>/images/icons/mono/24x24/tools.png">
                  </th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($entity as $key => $e):?>
                  <tr>
                    <td><?php echo $key; ?></td>
                    <td><?php echo $e["id_turn"]; ?></td>
                    <td><?php echo $e["subject"]; ?></td>
                    <td align="left" class="col-sm-4">
                      <?php $u = $controller->showUser($e["by"]); ?>
                      <img src="<?php echo Assets;?>/images/icons/mono/16x16/employee.png">
                      <?php echo $u["name"]." ".$u["lname"];; ?><br/>
                      <img src="<?php echo Assets;?>/images/icons/mono/16x16/job.png">
                      <?php echo $u["job"]; ?><br/>
                      <img src="<?php echo Assets;?>/images/icons/mono/16x16/place.png">
                      <?php echo $u["name_dependency"]; ?>
                    </td>
                    <!--<td><?php //echo $e["for"]; ?></td>-->
                    <td><?php echo $e["created"]; ?></td>
                    <td>
                      <a href="view.php?id=<?php echo $e["subject"]; ?>" class="link link-outline-default link-sm img">
                        Ver Asunto
                        <img class="float-right" src="<?php echo Assets;?>/images/icons/mono/16x16/full-screen.png">
                      </a>
                      <a href="new.turn.php?id=<?php echo $e["subject"]; ?>" class="link link-outline-info link-sm img">
                        Turnar
                        <img class="float-right" src="<?php echo Assets;?>/images/icons/mono/16x16/turn.png">
                      </a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
            <!--END TABLE-->
            <!--PAGINATION-->
            <?php $controller->showPages();?>
            <!--END PAGINATION-->
          <?php } else {?>
            <p class="text-center text-info">No hay registros actualmente</p>
          <?php }?>
          <!---->
          <hr class="border-default-theme">
          <h4 class="text-default-theme text-content-default"><strong>Asuntos</strong> que has <strong>Turnado</strong></h4>
          <hr class="border-default-theme">
          <!---->
          <?php $controller = new TurnController(); ?>
          <?php $entity = $controller->showPaginateBy(isset($_GET["page"])?$_GET["page"]:0,$controller->getUserBySession()); ?>
          <?php if (count($entity) > 0){ ?>
            <!--TABLE-->
            <table class="table table-bordered table-hover">
              <thead class="bg-default-theme text-light">
                <tr>
                  <th>#</th>
                  <th>
                    Turno
                    <img class="invert" src="<?php echo Assets;?>/images/icons/mono/24x24/turn.png">
                  </th>
                  <th>
                    Asunto
                    <img class="invert" src="<?php echo Assets;?>/images/icons/mono/24x24/sco.png">
                  </th>
                  <th>
                    Turnado a:
                    <img class="invert" src="<?php echo Assets;?>/images/icons/mono/24x24/user2.png">
                  </th>
                  <th>
                    Fecha
                    <img class="invert" src="<?php echo Assets;?>/images/icons/mono/24x24/timetable.png">
                  </th>
                  <th align="center">
                    Acciones
                    <img class="invert" src="<?php echo Assets;?>/images/icons/mono/24x24/tools.png">
                  </th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($entity as $key => $e):?>
                  <tr>
                    <td><?php echo $key; ?></td>
                    <td><?php echo $e["id_turn"]; ?></td>
                    <td><?php echo $e["subject"]; ?></td>
                    <!--<td><?php //echo $e["by"]; ?></td>-->
                    <td align="left" class="col-sm-4">
                      <?php $u = $controller->showUser($e["for"]); ?>
                      <img src="<?php echo Assets;?>/images/icons/mono/16x16/employee.png">
                      <?php echo $u["name"]." ".$u["lname"]; ?><br/>
                      <img src="<?php echo Assets;?>/images/icons/mono/16x16/job.png">
                      <?php echo $u["job"]; ?><br/>
                      <img src="<?php echo Assets;?>/images/icons/mono/16x16/place.png">
                      <?php echo $u["name_dependency"]; ?>
                    </td>
                    <td><?php echo $e["created"]; ?></td>
                    <td>
                      <a href="view.php?id=<?php echo $e["subject"]; ?>" class="link link-outline-default link-sm img">
                        Ver Asunto
                        <img class="float-right" src="<?php echo Assets;?>/images/icons/mono/16x16/full-screen.png">
                      </a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
            <!--END TABLE-->
            <!--PAGINATION-->
            <?php $controller->showPages();?>
            <!--END PAGINATION-->
          <?php } else {?>
            <p class="text-center text-info">No hay registros actualmente</p>
          <?php }?>

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
