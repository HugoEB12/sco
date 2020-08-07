<?php require_once "../Templates/UI-Components/Users/init.path.php"; ?>
<?php $controller = new SubjectController(); ?>
<?php $id = $_GET["id"]; ?>
<?php $entity = $controller->showById($id); ?>
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
              <a href="doc.pdf" target="_blank" class="link link-outline-default img">
                Imprimir Turno
                <img src="<?php echo Assets;?>/images/icons/mono/16x16/printer.png">
              </a>
              <a href="search.php" class="link link-outline-default img">
                Búsqueda
                <img src="<?php echo Assets;?>/images/icons/mono/16x16/busqueda.png">
              </a>
              <a href="turns.php" class="link link-outline-default img">
                Turnos
                <img src="<?php echo Assets;?>/images/icons/mono/16x16/turn.png">
              </a>
              <a href="#" class="link link-outline-purple img">
                Finalizar Asunto
                <img src="<?php echo Assets;?>/images/icons/mono/16x16/finish.png">
              </a>
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
                <span><?php echo $entity["id_subject"]; ?></span> |
                <a class="link link-sm link-outline-default img" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                  Ver
                  <img src="<?php echo Assets;?>/images/icons/mono/16x16/down-arrow.png">
                </a>
              </div>
              <div class="collapse" id="collapseExample">
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
              </div>
              <div class="card-footer">
                <small>Fecha de Creación: <?php echo $entity["created"]; ?></small>
              </div>
            </div>
            <!--card-->

            <hr class="bg-info"/>

            <div class="p-3 mb-2 rounded bg-gradient-info text-white">
              Turnar a:
            </div>

            <hr class="bg-info"/>

            <form id="form_record" action="<?php echo formAction; ?>" method="POST" onsubmit="setUsersSubmitValues();" >
              <!---->
              <input type="hidden" name="type" value="new">
              <input type="hidden" name="id"   value="<?php echo $entity["id_subject"]?>">
              <input type="hidden" name="created" value="<?php echo $entity["created"]?>">
              <input type="hidden" name="from" value="turns">
              <!---->
              <input id="dependencyID" type="hidden" value="<?php echo($_SESSION["dependency"]); ?>">
              <input id="userID" type="hidden" value="<?php echo($_SESSION["id_user"]); ?>">
              <!---->
              <a href="javascript:void(0);" class="float-right link link-outline-info img" onclick="addDependency();">
                Agregar
                <img src="<?php echo Assets;?>/images/icons/mono/16x16/form/add.png">
              </a>
              <input id="turns" type="hidden" name="turns" value="">
              <!---->
              <div id="dependencies" class="container">
                <div class="form-group form-inline">
                  <label class="p-2"><span class="text-danger">*</span> Nombre:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <img src="<?php echo Assets;?>/images/icons/mono/16x16/form/user.png">
                      </div>
                    </div>
                    <input type="text" id="key_users" class="form-control" placeholder="NOMBRE(S) APELLIDOS" name="turn">
                    <input id="id_user" type="hidden" value="" name="id_user">
                  </div>

                  <label class="p-2"><span class="text-danger">*</span> Cargo:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <img src="<?php echo Assets;?>/images/icons/mono/16x16/form/employee.png">
                      </div>
                    </div>
                    <input id="job_user" type="text" class="form-control" placeholder="CARGO ACTUAL" disabled="">
                  </div>

                  <label class="p-2"><span class="text-danger">*</span> Dependencia:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <img src="<?php echo Assets;?>/images/icons/mono/16x16/form/suitcase.png">
                      </div>
                    </div>
                    <input id="dependency_user" type="text" class="form-control" placeholder="DEPENDENCIA RECEPTORA" disabled="">
                  </div>
                </div>
              </div>
              <!---->
              <hr class="bg-info" />
              <!---->
              <div class="text-center">
                <a href="" class="link link-outline-success img" data-toggle="modal" data-target="#modalSubmit">
                  Confirmar
                  <img src="<?php echo Assets;?>/images/icons/mono/16x16/complete.png">
                </a>
              </div>
              <!--FORM TO SUBMIT-->
              <div class="modal fade" id="modalSubmit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title text-info" id="exampleModalLabel">
                        Finalizar Asunto <img src="<?php echo(Assets)."/images/icons/multi/24x24/question.png" ?>">
                      </h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="link link-outline-info" aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body text-center">
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

          </div>
          <!--container-->

          <!-- HERE END CONTENT -->
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
    <script src="<?php echo Assets;?>/plugins/jquery-ui/jquery-ui.js" type="text/javascript"></script>
    <script src="<?php echo Assets;?>/plugins/jquery-validation/jquery.validate.min.js" type="text/javascript"></script>
    <script src="<?php echo Assets;?>/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo Assets;?>/js/user.js" type="text/javascript"></script>
    <script src="<?php echo Assets;?>/js/user.form.js" type="text/javascript"></script>
    <script src="<?php echo Assets;?>/js/user.record.form.js" type="text/javascript"></script>

  </body>

</html>
