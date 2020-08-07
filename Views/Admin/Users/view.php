<?php require_once "../../Templates/UI-Components/Admin/init.path.php"; ?>
<?php $entity = (new UserController())->showById($_GET["id"]); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Usuarios | Vista Detallada</title>
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
        <br>
        <h4>
          <strong>Vista detallada del Usuario: </strong>
          <img class="img-thumbnail" src="<?php echo(Assets)."/images/icons/multi/32x32/avatar.png" ?>">
        </h4>
        <hr class="bg-info">
        <div class="col-lg-12">
          <!-- HERE COMES YOUR CONTENT -->
          <div class="container text-center">
            <!-- DIV ROW -->
            <div class="row">
              <!-- COL -->
              <div class="col">
                <span class="badge badge-pill badge-info">Datos Personales</span>
                <hr class="border-default-theme" />
                <table class="table table-striped table-bordered text-left align-middle">
                  <tbody>
                    <tr>
                      <th><label>Nombre completo</label></th>
                      <td><?php echo($entity["name"]." ".$entity["lname"]); ?></td>
                    </tr>
                    <tr>
                      <th><label>Correo electrónico:</label></th>
                      <td><?php echo($entity["email"]); ?></td>
                    </tr>
                    <tr>
                      <th><label>Contraseña:</label></th>
                      <td><?php echo("... ".substr($entity["password"], 30)); ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- END DIV COL -->
              <!-- COL -->
              <div class="col">
                <span class="badge badge-pill badge-info">Datos Laborales</span>
                <hr class="border-default-theme" />
                <table class="table table-striped table-bordered text-left align-middle">
                  <tbody>
                    <tr>
                      <th><label>Puesto:</label></th>
                      <td><?php echo($entity["job"]); ?></td>
                    </tr>
                    <tr>
                      <th><label>Dependencia:</label></th>
                      <td><?php echo($entity["name_dependency"]); ?></td>
                    </tr>
                    <tr>
                      <th><label>Finalizar Asuntos:</label></th>
                      <td><?php echo($entity["finish"]); ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- END DIV COL -->
            </div>
            <!--END DIV ROW-->
            <hr class="border-default-theme"/>
            <!---->
            <div class="row justify-content-center">
              <div class="col-auto">
                <table class="table table-sm table-striped table-bordered text-left align-middle">
                  <tr>
                    <th><label>Fecha de Creación: </label></th>
                    <td><?php echo($entity["created"]); ?></td>
                  </tr>
                  <tr>
                    <th><label>Última modificación: </label></th>
                    <td><?php echo($entity["modified"]); ?></td>
                  </tr>
                </table>
              </div>
            </div>
            <!---->
            <hr class="border-default-theme"/>
            <div class="text-center">
              <a href="index.php<?php echo("?page=".$_GET["page"])?>" class="link link-outline-info img">
                Regresar <img class="align-middle" src="<?php echo(Assets)."/images/icons/mono/16x16/back.png" ?>">
              </a> |
              <a href="edit.php?id=<?php echo($_GET["id"]); ?>&page=<?php echo isset($_GET["page"])?$_GET["page"]:""; ?>" class="link link-outline-warning img">
                Editar <img src="<?php echo(Assets)."/images/icons/mono/16x16/edit.png" ?>">
              </a> |
              <a href="#" class="link link-outline-danger img" data-toggle="modal" data-target="#modalDelete<?php echo($key)?>">
                Eliminar <img src="<?php echo(Assets)."/images/icons/mono/16x16/delete.png" ?>">
              </a>
            </div>
            <hr class="border-default-theme" />
          </div>
          <!-- HERE END YOUR CONTENT -->
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
    <script src="<?php echo Assets;?>/js/admin.js" type="text/javascript"></script>
    <script src="<?php echo Assets;?>/plugins/popper/popper.min.js" type="text/javascript"></script>
    <script src="<?php echo Assets;?>/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

  </body>

</html>
