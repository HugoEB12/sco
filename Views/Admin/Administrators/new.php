<?php require_once "../../Templates/UI-Components/Admin/init.path.php"; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Administradores | Nueva Cuenta</title>
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

      <div class="col-lg-12">
        <!-- HERE COMES YOUR CONTENT -->
        <br>
        <!--CONTAINER-->
        <div class="container">

          <!--FORM-->
          <form id="form_admin" method="POST" action="<?php echo(formAction."?page=".$_GET["page"]); ?>">
            <!---->
            <input type="hidden" name="type" value="insert">
            <input type="hidden" name="id"   value="">
            <input type="hidden" name="created" value="">
            <!---->
            <div class="text-center">
              Agregue un nuevo Administrador(a)
              <img class="img-thumbnail" src="<?php echo(Assets)."/images/icons/multi/32x32/avatar.png" ?>">
            </div>

            <hr class="bg-info" />

            <p class="badge badge-info">
              Datos Personales
            </p>

            <div class="form-group form-inline">
              <label class="p-2 col-sm-2"><span class="text-danger">*</span> Nombre(s):</label>
              <div class="input-group col-sm-4">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <img src="<?php echo Assets;?>/images/icons/mono/16x16/form/user.png">
                  </div>
                </div>
                <input type="text" name="name" class="form-control input-upper-case" placeholder="Nombre(s) Completo(s)" />
              </div>

              <label class="p-2 col-sm-2"><span class="text-danger">*</span> Apellidos:</label>
              <div class="input-group col-sm-4">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <img src="<?php echo Assets;?>/images/icons/mono/16x16/form/user.png">
                  </div>
                </div>
                <input type="text" name="lname" class="form-control input-upper-case" placeholder="Apellidos" />
              </div>

            </div>

            <div class="form-group form-inline">
              <label class="p-2 col-sm-2"><span class="text-danger">*</span> Correo Electrónico:</label>
              <div class="input-group col-sm-4">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <img src="<?php echo Assets;?>/images/icons/mono/16x16/form/email.png">
                  </div>
                </div>
                <input id="email_admin" type="email" name="email" class="form-control" placeholder="correo@dominio" />
              </div>

              <div id="msj-email_admin" class="text-center p-2 col-sm-4"></div>

            </div>

            <div class="form-group form-inline">
              <label class="p-2 col-sm-2"><span class="text-danger">*</span> Contraseña:</label>
              <div class="input-group col-sm-4">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <img src="<?php echo Assets;?>/images/icons/mono/16x16/form/password.png">
                  </div>
                </div>
                <input id="password" type="password" name="password" class="form-control" onchange="verifyPasswords('password','confirm');" />
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="checkboxPassword" onchange="showPassword(this,'password');">
                  <label class="form-check-label" for="checkboxPassword">
                    <img src="<?php echo Assets;?>/images/icons/mono/16x16/form/unmask.png">
                  </label>
                </div>
              </div>

              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="checkboxPasswordAuto" onchange="generatePassword(this);">
                <label class="link link-outline-purple form-check-label" for="checkboxPasswordAuto" data-toggle="tooltip" data-placement="right" title="Elige ésta opción para generar una contraseña de forma automática.">
                  Generar Contraseña
                </label>
              </div>
            </div>

            <div class="form-group form-inline">
              <label class="p-2 col-sm-2"><span class="text-danger">*</span> Confirmar Contraseña:</label>
              <div class="input-group col-sm-4">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <img src="<?php echo Assets;?>/images/icons/mono/16x16/form/password.png">
                  </div>
                </div>
                <input id="confirm" type="password" name="confirm" class="form-control" onkeyup="verifyPasswords('password','confirm');" />
                <span id="confirm"></span>
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="checkboxConfirm" onchange="showPassword(this,'confirm');">
                  <label class="form-check-label" for="checkboxConfirm">
                    <img src="<?php echo Assets;?>/images/icons/mono/16x16/form/unmask.png">
                  </label>
                </div>
              </div>
              <div class="container-fluid">
                <span id="msg" class="text-info"></span>
              </div>
            </div>

            <hr class="bg-info">
            <div class="form-group text-center">
              <span class="rounded badge-success p-2">
                ¡Verifique los datos ántes de crear la cuenta!.
              </span>
              <hr/>
              <a href="index.php<?php echo("?page=".$_GET["page"])?>" class="link link-outline-danger img">
                Regresar
                <img class="align-middle" src="<?php echo(Assets)."/images/icons/mono/16x16/back.png" ?>">
              </a> |
              <a id="save" href="" class="link link-outline-success img" data-toggle="modal" data-target="#modalSubmit">
                Guardar
                <img src="<?php echo Assets;?>/images/icons/mono/16x16/save.png">
              </a>
            </div>

            <!--FORM TO SUBMIT-->
            <div class="modal fade" id="modalSubmit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title text-info" id="exampleModalLabel">
                      Crear Cuenta <img src="<?php echo(Assets)."/images/icons/multi/24x24/question.png" ?>">
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span class="link link-outline-info" aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p>¿Todos los datos son correctos?</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="link link-outline-danger" data-dismiss="modal">
                      Cancelar <img class="" src="<?php echo Assets;?>/images/icons/multi/16x16/cancel.png">
                    </button>
                    <button type="submit" class="link link-outline-info">
                      Confirmar <img class="" src="<?php echo Assets;?>/images/icons/multi/16x16/confirm.png">
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <!---->

          </form>
          <!--END FORM-->
        </div>
        <!--END CONTAINER-->

      <!--HERE END CONTENT-->
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
    <script src="<?php echo Assets;?>/plugins/jquery-validation/jquery.validate.min.js" type="text/javascript"></script>
    <script src="<?php echo Assets;?>/plugins/popper/popper.min.js" type="text/javascript"></script>
    <script src="<?php echo Assets;?>/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo Assets;?>/js/admin.js" type="text/javascript"></script>
    <script src="<?php echo Assets;?>/js/admin.form.js" type="text/javascript"></script>

  </body>

</html>
