<?php require_once "../../Templates/UI-Components/Admin/init.path.php"; ?>
<?php $entity = (new DependencyController())->showById($_GET["id"]); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Dependencias | Vista Detallada</title>
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
          <strong>
            Vista detallada de la Dependencia:
            <i>
              <?php echo($entity["id_dependency"]); ?>
            </i>
          </strong>
        </h4>
        <hr class="bg-info">
        <div class="col-lg-12">
          <!-- HERE COMES YOUR CONTENT -->
          <!--CONTAINER-->
          <div class="container text-center">
            <div class="row justify-content-center">
              <div class="col-auto">
                <table class="table table-striped table-bordered text-left align-middle">
                  <tbody>
                    <tr>
                      <th><label>Nombre</label></th>
                      <td><?php echo($entity["name_dependency"]); ?></td>
                    </tr>
                    <tr>
                      <th><label>Titular:</label></th>
                      <td><?php echo($entity["principal_dependency"]); ?></td>
                    </tr>
                    <tr>
                      <th><label>Descripción:</label></th>
                      <td><?php echo($entity["description_dependency"]); ?></td>
                    </tr>
                    <tr>
                      <th><label>Tipo:</label></th>
                      <td><?php echo($entity["name_type"]); ?></td>
                    </tr>
                    <tr>
                      <th><label>Fecha de Creación: </label></th>
                      <td><?php echo($entity["created"]); ?></td>
                    </tr>
                    <tr>
                      <th><label>Última modificación: </label></th>
                      <td><?php echo($entity["modified"]); ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <hr class="border-default-theme" />
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

              <!-- MODAL FOR DELETE BUTTON-->
              <div class="modal fade" id="modalDelete<?php echo($key)?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title text-info" id="exampleModalLabel<?php echo($key)?>">
                        Eliminar Registro <img src="<?php echo(Assets)."/images/icons/multi/24x24/question.png" ?>">
                      </h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="link link-outline-info" aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body text-info">
                      <p>¿Seguro(a) que deseas Eliminar?</p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="link link-outline-danger" data-dismiss="modal">
                        Cancelar <img class="" src="<?php echo Assets;?>/images/icons/multi/16x16/cancel.png">
                      </button>
                      <a href="<?php echo(formAction."?page=".$_GET["page"])."&id=".$_GET["id"]."&type=delete"; ?>" class="link link-outline-info">
                        Confirmar <img class="" src="<?php echo Assets;?>/images/icons/multi/16x16/confirm.png">
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- MODAL FOR DELETE BUTTON-->
            </div>
          </div>
        <!--END CONTAINER-->
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
