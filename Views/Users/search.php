<?php require_once "../Templates/UI-Components/Users/init.path.php"; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Asuntos | Búsqueda</title>
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
          <hr class="border-default-theme">
          <h4 class="text-content-default"><strong>Búsqueda</strong> de Asuntos</h4>
          <hr class="border-default-theme">
          <h3 class="text-center">Criterios de Búsqueda</h3>
          <hr>
          <!---->
          <?php $controller = new SubjectController(); ?>
          <!--form-->
          <form id="form_search" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <!---->
            <?php
              $sub = (isset($_POST["subject"]))  ?strip_tags($_POST["subject"]):"";
              $ref = (isset($_POST["reference"]))?strip_tags($_POST["reference"]):"";
              $req = (isset($_POST["request"]))  ?strip_tags($_POST["request"]):"";
              $sta = (isset($_POST["status"]))   ?strip_tags($_POST["status"]):"";
            ?>
            <!---->
            <input type="hidden" name="type" value="search">
            <!---->
            <div class="form-group form-inline">
              <label class="p-2 text-content-default"># Asunto:</label>
              <input id="subject" type="text" name="subject" class="form-control col-sm-2" placeholder="..." value="<?php echo $sub; ?>">
              <label class="p-2 text-content-default">Referencia:</label>
              <input id="reference" type="text" name="reference" class="form-control col-sm-2" placeholder="..." value="<?php echo $ref; ?>">
              <label class="p-2 text-content-default">Tipo de Solicitud:</label>
              <select class="form-control col-sm-2" name="request" id="request">
                <option value="" selected="">- Seleccionar -</option>
                <?php
                  foreach ($controller->showRequestValues() as $r){
                    if ($r == $req) {
                      echo '<option value="'.$r.'" selected="">'.$r.'</option>';
                    } else {
                      echo '<option value="'.$r.'">'.$r.'</option>';
                    }
                  }
                ?>
              </select>
              <label class="p-2 text-content-default">Estatus:</label>
              <select class="form-control col-sm-2" name="status" id="status">
                <option selected="" value="">- Seleccionar -</option>
                <?php
                  foreach ($controller->showStatusValues() as $r){
                    if ($r == $sta) {
                      echo '<option value="'.$r.'" selected="">'.$r.'</option>';
                    } else {
                      echo '<option value="'.$r.'">'.$r.'</option>';
                    }
                  }
                ?>
              </select>
            </div>
            <hr/>
            <div class="form-group form-inline justify-content-center">
              <a href="#" class="link link-outline-info img" onclick="cleanSearchInputs();">
                Eliminar Filtros
                <img src="<?php echo Assets;?>/images/icons/mono/16x16/refresh.png">
              </a>
              |
              <button type="submit" class="link link-outline-default img">
                Buscar
                <img src="<?php echo Assets;?>/images/icons/mono/16x16/busqueda.png">
              </button>
            </div>
          </form>
          <!--end-form-->
          <hr class="border-default-theme">
          <?php $entity = $controller->showBySearch($sub,$ref,$req,$sta,isset($_GET["page"])?$_GET["page"]:0); ?>
          <?php if (count($entity) > 0){ ?>
            <!--container-->
            <div class="container">
              <h4 class="text-content-default">Listando todos los asuntos:</h4>
              <hr/>
              <div class="row">
                <?php foreach ($entity as $key => $e):?>
                  <div class="card border border-default-theme" style="width: 26rem; margin-left: 1px;">
                    <div class="card-header">
                      <label class="p-2 font-weight-bold">#:<?php echo $e["id_subject"]; ?> | Referencia:</label>
                      <span><?php echo $e["reference"]; ?></span>
                      <span> | <?php echo $controller->showStatus($e["admission"],$e["expiration"],$e["finish"]); ?></span>
                    </div>
                    <div class="card-body">
                      <!-- START CARD-BODY-->
                      <label class="p-2 font-weight-bold">Tipo:</label>
                      <span><?php echo $e["request"]; ?></span><br/>

                      <label class="p-2 font-weight-bold">Ingresó:</label>
                      <span><?php echo $e["admission"]; ?></span><br/>

                      <label class="p-2 font-weight-bold">Venció:</label>
                      <span><?php echo $e["expiration"]; ?></span>

                      <div class="row">
                        <div class="col">
                          <label class="p-2 font-weight-bold">Remitente:</label>
                          <br/>
                          <span>
                            <?php $u = $controller->showSender($e["sender"]); ?>
                            <?php echo $u["name"]; ?><br/>
                            <?php echo $u["job"]; ?><br/>
                            <?php echo $u["dependency"]; ?>
                          </span>
                        </div>
                        <div class="col">
                          <label class="p-2 font-weight-bold">Para:</label>
                          <br/>
                          <span>
                            <?php $u = $controller->showReceiver($e["receiver"]); ?>
                            <?php echo $u["name"]; ?><br/>
                            <?php echo $u["job"]; ?><br/>
                            <?php echo $u["dependency"]; ?>
                          </span>
                        </div>
                      </div>
                      <!-- END CARD-BODY-->
                    </div>
                    <div class="card-footer text-center">
                      <a href="view.php?id=<?php echo $e["id_subject"]; ?>" class="link link-outline-default link-sm img">
                        Vista Detallada
                        <img src="<?php echo Assets;?>/images/icons/mono/16x16/full-screen.png">
                      </a>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>
              <!--PAGINATION-->
              <?php $controller->showPages();?>
              <!--END PAGINATION-->

            </div>
            <!--container-->
          <?php } else {?>
            <p class="text-center text-content-default">No hay registros actualmente, <br><strong>¡verifique los criterios de Búsqueda!</strong></p>
          <?php }?>

          <!-- HERE END CONTENT -->
        </div>

        <hr class="border-default-theme">
        <h4 class="text-content-default text-right"><strong>Búsqueda</strong> de Asuntos</h4>
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
    <script src="<?php echo Assets;?>/plugins/jquery-validation/jquery.validate.min.js" type="text/javascript"></script>
    <script src="<?php echo Assets;?>/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo Assets;?>/js/user.js" type="text/javascript"></script>
    <script src="<?php echo Assets;?>/js/user.search.form.js" type="text/javascript"></script>

  </body>

</html>
