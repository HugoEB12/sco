<?php require_once "../../Templates/UI-Components/Admin/init.path.php"; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Personal | Principal</title>
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
          <hr class="border-default-theme"/>
          <h4 class="text-default text-center"><strong>Remitentes y Destinatarios</strong> registrados actualmente</h4>
          <hr class="border-default-theme"/>
          <?php require_once ui_component.'verify.message.php'; ?>
          <p class="text-justify">
            El catálogo de <i>"Remitentes y Destinatarios"</i>, también <b><u>se modifica</u></b> desde la sección de "Usuarios" al momento de realizar el registro de Asuntos u oficios."<br>
            <hr>
            <a href="new.php?page=<?php echo isset($_GET["page"])?$_GET["page"]:"";?>" class="link link-outline-success">Nuevo Registro</a>
            &nbsp;&nbsp;|&nbsp;&nbsp;Modifique algun valor si los datos son incorrectos.
          </p>
          <?php $controller = new SRController(); ?>
          <?php $rows = $controller->showPaginate(isset($_GET["page"])?$_GET["page"]:0); ?>
          <?php if (count($rows) > 0){ ?>
            <hr class="border-default-theme"/>
            <div class="table-responsive">
              <table class="table table-sm table-hover table-bordered">
                <caption>Lista de Remitentes y Destinatarios.</caption>
                <thead align="center" class="bg-default-theme">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Puesto</th>
                    <th scope="col">Dependencia</th>
                    <th colspan="3" class="border border-default-theme">Acciones</th>
                  </tr>
                </thead>
                <tbody align="center">
                  <?php foreach ($rows as $key => $a):?>
                    <?php $id = $a["id"]; ?>
                    <tr>
                      <th class="bg-default-theme text-default"><?php echo($key); ?></th>
                      <td><?php echo $a["name"]; ?></td>
                      <td><?php echo $a["job"]; ?></td>
                      <td><?php echo $a["dependency"]; ?></td>
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

              <!--PAGINATION-->
              <?php $controller->showPages();?>
              <!--END PAGINATION-->
            </div>
            <!---->
          <?php } else {?>
            <p class="text-center text-info">No hay registros actualmente</p>
          <?php }?>
          <!---->
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

    <!-- MODAL FOR DELETE BUTTON-->
      <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title text-info" id="exampleModalLabel">
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
              <a href="" class="link link-outline-info">
                Confirmar <img class="" src="<?php echo Assets;?>/images/icons/multi/16x16/confirm.png">
              </a>
            </div>
          </div>
        </div>
      </div>

    <!-- SRCRIPTS-->
    <script src="<?php echo Assets;?>/plugins/jquery/jquery-3.4.1.min.js" type="text/javascript"></script>
    <script src="<?php echo Assets;?>/js/admin.js" type="text/javascript"></script>
    <script src="<?php echo Assets;?>/plugins/popper/popper.min.js" type="text/javascript"></script>
    <script src="<?php echo Assets;?>/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo Assets;?>/js/admin.js" type="text/javascript"></script>
    <script src="<?php echo Assets;?>/js/admin.form.js" type="text/javascript"></script>
    <!---->

  </body>

</html>
