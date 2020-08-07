<?php require_once "../../Templates/UI-Components/Admin/init.path.php"; ?>
<?php $entity = (new SRController())->showById($_GET["id"]); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Personal | Vista Detallada</title>
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
          <div class="container text-center">
            <hr class="bg-info">
            <span class="badge-success">VISTA DETALLADA DEL REMITENTE/DESTINATARIO.</span>
            <img class="img-thumbnail" src="<?php echo(Assets)."/images/icons/multi/32x32/avatar.png" ?>">
            <hr class="bg-info">
            <div class="row justify-content-center">
              <div class="col-auto">
                <table class="table table-striped table-bordered text-left align-middle">
                  <tbody>
                    <tr>
                      <th><label>Nombre</label></th>
                      <td><?php echo $entity["name"]; ?></td>
                    </tr>
                    <tr>
                      <th><label>Puesto:</label></th>
                      <td><?php echo $entity["job"]; ?></td>
                    </tr>
                    <tr>
                      <th><label>Dependencia:</label></th>
                      <td><?php echo $entity["dependency"]; ?></td>
                    </tr>
                    <tr>
                      <th><label>Tipo:</label></th>
                      <td><?php echo ($entity["type"] == "1")?"Remitente":"Destinatario"; ?></td>
                    </tr>
                    <tr>
                      <th><label>Fecha de Creación: </label></th>
                      <td><?php echo $entity["created"]; ?></td>
                    </tr>
                    <tr>
                      <th><label>Última modificación: </label></th>
                      <td><?php echo $entity["modified"]; ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          <hr class="border-default-theme" />
          <div class="text-center">
            <a href="index.php" class="link link-outline-info img">
              Regresar <img class="align-middle" src="<?php echo(Assets)."/images/icons/mono/16x16/back.png" ?>">
            </a> |
            <a href="edit.php" class="link link-outline-warning img">
              Editar <img class="align-middle" src="<?php echo(Assets)."/images/icons/mono/16x16/edit.png" ?>">
            </a> |
            <a href="#" class="link link-outline-danger img">
              Eliminar <img class="align-middle" src="<?php echo(Assets)."/images/icons/mono/16x16/delete.png" ?>">
            </a>
          </div>

        </div>

          <!---->
      </div>

        <hr class="bg-secondary">

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
    <script src="<?php echo Assets;?>/js/admin.js" type="text/javascript"></script>
    <script src="<?php echo Assets;?>/plugins/popper/popper.min.js" type="text/javascript"></script>
    <script src="<?php echo Assets;?>/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

  </body>

</html>
