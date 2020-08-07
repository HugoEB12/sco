<?php require_once "../Templates/UI-Components/Users/init.path.php"; ?>
<?php define('imagePath', "http://".$_SERVER["SERVER_NAME"]."/SCO/Assets"); ?>
<?php $controller = new SubjectController(); ?>
<title>Turno | Vista Previa</title>
<?php require_once ui_component."head.php"; ?>
<body onload="startTime()">

  <!-- BEGIN TOPBAR -->
  <?php include_once ui_component."topbar.php"; ?>
  <!-- END TOPBAR -->

  <!-- BEGIN SIDEBAR -->
  <?php include_once ui_component."sidebar.php"; ?>
  <!-- END SIDEBAR -->
  <br>

  <div class="side-content">
    <div class="container">
      <div class="col-lg-12">

        <hr class="border-default-theme" />
        <h4 class="text-content-default">
          Vista previa del Turno
          <img src="<?php echo Assets; ?>/images/icons/multi/24x24/pdf.png">
        </h4>
        <hr class="border-default-theme" />

        <div class="border border-default-theme rounded" style="padding: 1em;">

          <!--GET CONTENT FROM INPUT-->
          <?php $entity = unserialize(base64_decode($_POST["report"])); ?>

          <!--START BUFFER-->
          <?php ob_start(); ?>

          <!-- HERE COMES CONTENT TO SHOW IN PDF -->
          <?php date_default_timezone_set('America/Mexico_City');?>
          <style type="text/css">
            *{
              font-size: 12px;
            }
            .table {
              margin-bottom: 10rem;
              color: #212529;
              border-collapse: collapse;
              font-size: 10px;
            }
            .table th,
            .table td {
              padding: 1rem;
              vertical-align: middle;
              text-align: center;
              border-top: 1px solid #dee2e6;
              font-size: 10px;
            }
            .table thead th {
              vertical-align: middle;
              border-bottom: 2px solid #dee2e6;
              font-size: 10px;
            }
            .table tbody + tbody {
              border-top: 2px solid #dee2e6;
              font-size: 10px;
            }
            .table-bordered {
              border: 1px solid #dee2e6;
              font-size: 10px;
            }
            .table-bordered th,
            .table-bordered td {
              border: 1px solid #dee2e6;
              font-size: 10px;
            }
            .table-bordered thead th,
            .table-bordered thead td {
              border-bottom-width: 2px;
              font-size: 10px;
            }
            .hr-report{
              border: solid 0.1px gray;
            }
          </style>

          <page backtop="10mm" backbottom="10mm" backleft="10mm" backright="10mm">
            <page_header>
              <table style="width: 100%; border: solid 1px black;">
                <tr>
                  <td style="text-align: left;   width: 33%">Asunto Turnado</td>
                  <td style="text-align: center; width: 34%">San José del Rincón, Estado de México.</td>
                  <td style="text-align: right;  width: 33%"><?php echo date('d/m/Y'); ?></td>
                </tr>
              </table>
            </page_header>
            <page_footer>
              <table style="width: 100%; border: solid 1px black;">
                <tr>
                  <td style="text-align: left;  width: 25%">SCO</td>
                  <td style="text-align: center; width: 50%">Fecha de impresión: <?php echo date('d/m/Y \\a \\l\\a\\s H:i:s \\h\\r\\s.'); ?></td>
                  <td style="text-align: right; width: 25%">Página [[page_cu]]/[[page_nb]]</td>
                </tr>
              </table>
            </page_footer>
            <!--START CONTENT-->

              <div style="text-align: center;">
                <img src="<?php echo imagePath; ?>/images/sco/sanjose3.png">
              </div>
              
              <hr class="hr-report" />
              
              <div style="text-align: center; text-transform: capitalize;">
                <b>Comprobante de Turno</b>
              </div>
              
              <hr class="hr-report" />

              <div style="text-align: justify;">
                
                <b>Datos del Asunto:</b><br/>

                <hr class="hr-report" />

                <table cellspacing="10">
                  <thead>
                    <tr>
                      <th width="300">Ingresó:</th>
                      <th width="300">Vence:</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><?php echo $entity["admission"]; ?></td>
                      <td><?php echo $entity["expiration"]; ?></td>
                    </tr>
                  </tbody>
                </table>

                <table cellspacing="10">
                  <thead>
                    <tr>
                      <th width="300">Ejercicio:</th>
                      <th width="300">Referencia:</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><?php echo $entity["year"]; ?></td>
                      <td><?php echo $entity["reference"]; ?></td>
                    </tr>
                  </tbody>
                </table>

                <table cellspacing="10">
                  <thead>
                    <tr>
                      <th width="300">Tipo de Solicitud:</th>
                      <th width="300">Prioridad:</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><?php echo $entity["request"]; ?></td>
                      <td><?php echo $entity["priority"]; ?></td>
                    </tr>
                  </tbody>
                </table>

                <br/>

              </div>

              <hr class="hr-report" />

              <table cellspacing="10">
                <thead>
                  <tr>
                    <th>Remitente</th>
                    <?php $s = $controller->showSender($entity["sender"]); ?>
                    <th>Para</th>
                    <?php $r = $controller->showReceiver($entity["receiver"]); ?>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td width="300"><?php echo $s["name"]; ?></td>
                    <td width="300"><?php echo $r["name"]; ?></td>
                  </tr>
                  <tr>
                    <td width="300"><?php echo $s["job"]; ?></td>
                    <td width="300"><?php echo $r["job"]; ?></td>
                  </tr>
                  <tr>
                    <td width="300"><?php echo $s["dependency"]; ?></td>
                    <td width="300"><?php echo $r["dependency"]; ?></td>
                  </tr>
                </tbody>
              </table>

              <hr class="hr-report" />

              <b>Asunto: </b>
              <br/><br/>
              <?php echo $entity["subject"]; ?>
              <br/><br/>
              <b>Indicaciones: </b>
              <br/><br/>
              <?php echo $entity["indications"]; ?>

              <hr class="hr-report" />

              <?php $u = $controller->showUser($entity["by"]); ?>
              <b>Turnado por: </b>
              <br/><br/>
              <?php echo $u["name"]; ?> <br/>
              <?php echo $u["job"]; ?> <br/>
              <?php echo $u["name_dependency"]; ?> <br/>
              
              <hr class="hr-report" />

              <span>Historial de Turnos:</span>
              <br>
              <br>
              <table class="table table-bordered">
                <tr>
                  <th scope="col" align="center">#</th>
                  <th scope="col" align="center">Turnado por: <img src="<?php echo imagePath;?>/images/icons/mono/16x16/employee.png"></th>
                  <th colspan="1"></th>
                  <th scope="col" align="center">Turnado a: <img src="<?php echo imagePath;?>/images/icons/mono/16x16/user.png"></th>
                  <th scope="col" align="center">Fecha / Hora <img src="<?php echo imagePath;?>/images/icons/mono/16x16/timetable.png"></th>
                </tr>
                <?php foreach ($controller->showTurns($entity["id_subject"]) as $key => $t):?>
                  <tr>
                    <td width="20"><?php echo $key; ?></td>
                    <td align="left" width="230">
                      <?php $u = $controller->showUser($t["by"]); ?>
                      <img src="<?php echo imagePath;?>/images/icons/mono/16x16/employee.png">
                      <?php echo $u["name"]." ".$u["lname"]; ?><br/>
                      <img src="<?php echo imagePath;?>/images/icons/mono/16x16/job.png">
                      <?php echo $u["job"]; ?><br/>
                      <img src="<?php echo imagePath;?>/images/icons/mono/16x16/place.png">
                      <?php echo $u["name_dependency"]; ?>
                    </td>
                    <td width="40">
                      <img class="" src="<?php echo imagePath;?>/images/icons/multi/24x24/arrow.png">
                    </td>
                    <td align="left" width="230">
                      <?php $u = $controller->showUser($t["for"]); ?>
                      <img src="<?php echo imagePath;?>/images/icons/mono/16x16/employee.png">
                      <?php echo $u["name"]." ".$u["lname"]; ?><br/>
                      <img src="<?php echo imagePath;?>/images/icons/mono/16x16/job.png">
                      <?php echo $u["job"]; ?><br/>
                      <img src="<?php echo imagePath;?>/images/icons/mono/16x16/place.png">
                      <?php echo $u["name_dependency"]; ?>
                    </td>
                    <td width="150">
                      <?php echo $t["created"]; ?>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </table>

              <br/>
              <hr class="hr-report" />

              <b>Fecha: </b><?php echo $entity["created"]; ?>

              <br>

            <!--END CONTENT-->
          </page>

          <!-- HERE END CONTENT -->

          <!--PUT CONTENT IN FILE-->
          <?php file_put_contents('../Templates/pdf/pdf.turn.php', ob_get_contents()); ?>

        </div>
        <br/>

        <div class="text-center">
          <a class="link link-outline-default img" href="../../Controllers/PDFController.php?template=pdf.turn.php">
            Generar PDF <img src="<?php echo Assets;?>/images/icons/mono/16x16/complete.png">
          </a> | 
          <a class="link link-outline-danger img" href="view.php?id=<?php echo $_POST["id"]; ?>">
            Cancelar <img src="<?php echo Assets;?>/images/icons/mono/16x16/back.png">
          </a>
        </div>
          
        <hr class="border-default-theme" />
        <h4 class="text-content-default text-right">
          <img src="<?php echo Assets;?>/images/icons/multi/24x24/pdf.png">
          Vista previa del Turno
        </h4>
        <hr class="border-default-theme" />
        
        <div class="footer">
        </div>

      </div>
    </div>

  </div>
  <?php include_once ui_component."bottombar.php"; ?>
  <!-- SRCRIPTS-->
  <script src="<?php echo Assets;?>/plugins/jquery/jquery-3.4.1.min.js" type="text/javascript"></script>
  <script src="<?php echo Assets;?>/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  <script src="<?php echo Assets;?>/js/user.js" type="text/javascript"></script>
</body>








