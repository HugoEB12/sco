<?php require_once "../../Templates/UI-Components/Admin/init.path.php"; ?>
<?php $entity = (new SRController())->showById($_GET["id"]); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Personal | Edición</title>
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
        <div class="col-lg-12">
          <!-- HERE COMES YOUR CONTENT -->
          <!--CONTAINER-->
          <div class="container">

            <div class="text-center">
              Modifique al remitente/destinatario.</strong>
              <img class="img-thumbnail" src="<?php echo(Assets)."/images/icons/multi/32x32/avatar.png" ?>">
            </div>
            <hr class="border-default-theme"/>
            <!--FORM-->
            <form id="form_sr" method="POST" action="<?php echo formAction."?page=".$_GET["page"]; ?>">
              <!---->
              <input type="hidden" name="type" value="update">
              <input type="hidden" name="id"   value="<?php echo $entity["id"]?>">
              <input type="hidden" name="created" value="<?php echo $entity["created"]?>">
              <!---->
              <div class="form-group">
                <label class="p-2 col-sm-2"><span class="text-danger">*</span> Nombre Completo:</label>
                <div class="input-group col-sm-4">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <img src="<?php echo Assets;?>/images/icons/mono/16x16/form/user.png">
                    </div>
                  </div>
                  <input type="text" name="name" class="form-control" value="<?php echo $entity["name"]; ?>" />
                </div>

                <label class="p-2 col-sm-2"><span class="text-danger">*</span> Puesto:</label>
                <div class="input-group col-sm-4">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <img src="<?php echo Assets;?>/images/icons/mono/16x16/form/email.png">
                    </div>
                  </div>
                  <input type="text" name="job" class="form-control" value="<?php echo $entity["job"]; ?>" />
                </div>

                <label class="p-2 col-sm-2"><span class="text-danger">*</span> Dependencia:</label>
                <div class="input-group col-sm-4">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <img src="<?php echo Assets;?>/images/icons/mono/16x16/form/job.png">
                    </div>
                  </div>
                  <input type="text" name="dependency" class="form-control" value="<?php echo $entity["dependency"]; ?>" />
                </div>

                <label class="p-2 col-sm-2"><span class="text-danger">*</span> Tipo:</label>
                <div class="input-group col-sm-4">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <img src="<?php echo Assets;?>/images/icons/mono/16x16/form/work.png">
                    </div>
                  </div>
                  <select class="form-control" name="type_sr">
                    <option value=""> - Seleccione - </option>
                    <?php if($entity["type"] == "1"): ?>
                      <?php echo '<option value="1" selected="">Remitente</option>'; ?>
                      <?php echo '<option value="2">Destinatario</option>'; ?>
                    <?php else: ?>
                      <?php echo '<option value="1">Remitente</option>'; ?>
                      <?php echo '<option value="2" selected="">Destinatario</option>'; ?>
                    <?php endif; ?>
                  </select>
                </div>
              </div>
              <hr class="border-default-theme"/>
              <div class="form-group text-center">
                <span class="badge badge-success">
                  ¡Verifique los datos ántes modificar!.
                </span>
                <br/>
                <hr class="border-default-theme"/>
                <a href="index.php" class="link link-outline-danger img">
                  Regresar
                  <img class="align-middle" src="<?php echo(Assets)."/images/icons/mono/16x16/back.png" ?>">
                </a> |
                <a href="" class="link link-outline-success img" data-toggle="modal" data-target="#modalSubmit">
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
                    <div class="modal-body text-center text-content-default">
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
