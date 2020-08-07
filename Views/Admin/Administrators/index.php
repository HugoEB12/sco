<?php require_once "../../Templates/UI-Components/Admin/init.path.php"; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Administradores | Principal</title>
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

          <!-- BEGIN -->
          <?php //require_once ui_component."verify.message.php"; ?>
          <!-- END -->
          <hr class="border-default-theme"/>
          <h4 class="text-default text-center"><strong>Administradores(as)</strong> registrado(as) actualmente</h4>
          <hr class="border-default-theme"/>
          <a href="new.php?page=<?php echo isset($_GET["page"])?$_GET["page"]:"";?>" class="link link-outline-success img">
            Crear Cuenta <img src="<?php echo(Assets)."/images/icons/mono/16x16/plus.png" ?>">
          </a>
          <!---->
          <?php $controller = new AdminController(); ?>
          <?php $administrators = $controller->showPaginate(isset($_GET["page"])?$_GET["page"]:0); ?>
          <?php if (count($administrators) > 0){ ?>
            <hr class="border-default-theme"/>
            <div class="table-responsive">
              <table class="table table-sm table-hover table-bordered">
                <caption>Lista de Administradores del Sistema</caption>
                <thead align="center" class="bg-default-theme text-default">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Clave</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Correo Electrónico</th>
                    <th colspan="3" class="border border-default-theme">Acciones</th>
                  </tr>
                </thead>
                <tbody align="center">
                  <?php foreach ($administrators as $key => $a):?>
                    <?php $id = $a["id_admin"]; ?>
                    <tr>
                      <th class="bg-default-theme"><?php echo($key); ?></th>
                      <td><?php echo($id); ?></td>
                      <td><?php echo($a["name"]." ".$a["lname"]); ?></td>
                      <td><?php echo($a["email"]); ?></td>
                      <td class="bg-light">
                        <a href="view.php?id=<?php echo($id); ?>&page=<?php echo isset($_GET["page"])?$_GET["page"]:""; ?>" class="link link-sm link-outline-info img">
                          Ver <img src="<?php echo(Assets)."/images/icons/mono/16x16/resume.png" ?>">
                        </a>
                      </td>
                      <td class="bg-light">
                        <a href="edit.php?id=<?php echo($id); ?>&page=<?php echo isset($_GET["page"])?$_GET["page"]:""; ?>" class="link link-sm link-outline-warning img">
                          Editar <img src="<?php echo(Assets)."/images/icons/mono/16x16/edit.png" ?>">
                        </a>
                      </td>
                      <td class="bg-light">
                        <a href="#" class="link link-sm link-outline-danger img" data-toggle="modal" data-target="#modalDelete<?php echo($key)?>">
                          Eliminar <img src="<?php echo(Assets)."/images/icons/mono/16x16/delete.png" ?>">
                        </a>
                      </td>
                    </tr>
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
                            <a href="<?php echo(formAction."?page=".$_GET["page"])."&id=".$id."&type=delete"; ?>" class="link link-outline-info">
                              Confirmar <img class="" src="<?php echo Assets;?>/images/icons/multi/16x16/confirm.png">
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- MODAL FOR DELETE BUTTON-->
                  <?php endforeach; ?>
                </tbody>
              </table>
              <hr class="border-default-theme"/>
              <!--PAGINATION-->
              <?php $controller->showPages();?>
              <!--END PAGINATION-->

            </div>

            <!---->
          <?php } else {?>
            <p class="text-center text-info">No hay registros actualmente</p>
          <?php }?>
          <!--HERE END YOUR CONTENT-->
        </div>

        <hr class="border-default-theme" />

        <!-- BEGIN FOOTER CONTENT-->
        <div class="footer">
        </div>
      <!-- END FOOTER CONTENT-->
      </div>
      <!-- END CONTAINER -->
    </div>
    <!-- END SIDE CONTENT -->

    <?php include_once ui_component."bottombar.php"; ?>

    <!-- SRCRIPTS-->
    <script src="<?php echo Assets;?>/plugins/jquery/jquery-3.4.1.min.js" type="text/javascript"></script>
    <script src="<?php echo Assets;?>/js/admin.js" type="text/javascript"></script>
    <script src="<?php echo Assets;?>/plugins/popper/popper.min.js" type="text/javascript"></script>
    <script src="<?php echo Assets;?>/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!---->

  </body>

</html>
