<?php require_once "../Templates/UI-Components/Users/init.path.php"; ?>
<?php $controller = new UserController(); ?>
<?php $entity = $controller->showById($_SESSION["id_user"]); ?>
<!DOCTYPE html>
<html>
	<head>
    <title>Usuarios | Perfil</title>
    <?php require_once ui_component."head.php"; ?>
  </head>
<body onload="startTime()">
	<!-- BEGIN TOPBAR -->
  <?php include_once ui_component."topbar.php"; ?>
  <!-- END TOPBAR -->

  <!-- BEGIN SIDEBAR -->
  <?php include_once ui_component."sidebar.php"; ?>
  <!-- END SIDEBAR -->

  <!-- BEGIN PAGE CONTENT -->
    <div class="side-content">
    	<!--CONTAINER-->
      <div class="container">
        <div class="col-lg-12">
          <!-- HERE COMES CONTENT -->
          <hr class="border-default-theme">
          <h4 class="text-content-default text-center">
          	Perfil del Usuario:
        		<img src="<?php echo Assets;?>/images/icons/mono/24x24/profile.png">
          </h4>
          <hr class="border-default-theme">
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
          <hr class="border-default-theme">
          <div class="text-center text-content-default">
          	ir a:<br><hr>
            <a href="index.php" class="link link-outline-default img">
              Inicio
              <img src="<?php echo Assets;?>/images/icons/mono/16x16/home.png">
            </a>
            <a href="record.php" class="link link-outline-default img">
              Registro
              <img src="<?php echo Assets;?>/images/icons/mono/16x16/clipboard.png">
            </a>
            <a href="search.php" class="link link-outline-default img">
              Búsqueda
              <img src="<?php echo Assets;?>/images/icons/mono/16x16/busqueda.png">
            </a>
            <a href="turns.php" class="link link-outline-default img">
              Turnos
              <img src="<?php echo Assets;?>/images/icons/mono/16x16/turn.png">
            </a>
          </div>
          <!-- HERE END CONTENT -->
        </div>
        <!-- BEGIN FOOTER CONTENT-->
        <div class="footer">
        </div>
      <!-- END FOOTER CONTENT-->
      </div>
      <!-- END CONTAINER -->
    </div>
    <!-- END MAIN CONTENT -->

  <!--BEGIN BOTTOMBAR-->
  <?php include_once ui_component."bottombar.php"; ?>
  <!--END BOTTOMBAR-->

  <!-- SRCRIPTS-->
  <script src="<?php echo Assets;?>/plugins/jquery/jquery-3.4.1.min.js" type="text/javascript"></script>
  <script src="<?php echo Assets;?>/plugins/popper/popper.min.js" type="text/javascript"></script>
  <script src="<?php echo Assets;?>/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  <script src="<?php echo Assets;?>/js/user.js" type="text/javascript"></script>
</body>
</html>
