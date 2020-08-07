<?php require_once "../Templates/UI-Components/Users/init.path.php"; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Asuntos | Registro</title>
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
        <hr class="border-default-theme">
        <h4 class="text-content-default"><strong>Registro</strong> de Oficios.</h4>
        <hr class="border-default-theme">
        <div class="col-lg-12">
          <!-- HERE COMES CONTENT -->
          
          <form id="form_record" action="<?php echo formAction; ?>" method="POST" onsubmit="setUsersSubmitValues();" enctype="multipart/form-data">
            <!---->
            <input type="hidden" name="type" value="insert">
            <input type="hidden" name="id"   value="">
            <input type="hidden" name="created" value="">
            <!---->
            <input id="dependencyID" type="hidden" value="<?php echo($_SESSION["dependency"]); ?>">
            <input id="userID" type="hidden" value="<?php echo($_SESSION["id_user"]); ?>">
            <!---->
            <div class="p-3 mb-2 rounded bg-gradient-success text-white">Datos del Oficio:</div>

            <hr class="bg-success"/>

            <div class="form-group form-inline">
              <label class="p-2 font-weight-bold">Fecha de Sello:</label>
              <label class="p-2"><span class="text-danger">*</span> Ingreso:</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <img src="<?php echo Assets;?>/images/icons/mono/16x16/form/calendar-start.png">
                  </div>
                </div>
                <input type="date" name="admission" class="form-control" value="<?php echo date('Y-m-d'); ?>">
              </div>

              <label class="p-2 font-weight-bold"><span class="text-danger">*</span> Prioridad: </label>
              <!--<div id="typePriority" class="sphere"></div>-->
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <img src="<?php echo Assets;?>/images/icons/mono/16x16/form/priority.png">
                  </div>
                </div>
                <select id="priority" class="form-control" onchange="setPriority();" name="priority">
                  <option value="alta">Alta (3 días hábiles)</option><!-- 5 dìas -->
                  <option value="normal" selected="">Normal (5 días hábiles)</option><!-- 3 dìas -->
                  <!--<option value="baja">Baja</option>-->
                </select>       
              </div>
              
              <label class="p-2"><span class="text-danger">*</span> Vencimiento:</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <img src="<?php echo Assets;?>/images/icons/mono/16x16/form/calendar-end.png">
                  </div>
                </div>
                <input id="workingDays" type="date" name="expiration" class="form-control">
              </div>
              
            </div>

            <hr class="bg-success"/>            

            <div class="form-group form-inline">

              <label class="p-2"><span class="text-danger">*</span> Ejercicio / Año:</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <img src="<?php echo Assets;?>/images/icons/mono/16x16/form/year.png">
                  </div>
                </div>
                <select class="form-control" name="year">
                  <option value="2020" selected="">2020</option>
                  <option value="2019">2019</option>
                  <option value="2018">2018</option>
                  <option value="2017">2017</option>
                  <option value="2016">2016</option>
                  <option value="2015">2015</option>
                  <option value="2014">2014</option>
                  <option value="2013">2013</option>
                  <option value="2012">2012</option>
                  <option value="2011">2011</option>
                  <option value="2010">2010</option>
                  <option value="2009">2009</option>
                  <option value="2008">2008</option>
                </select>  
              </div>

              <label class="p-2 font-weight-bold"><span class="text-danger">*</span> Referencia:</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <img src="<?php echo Assets;?>/images/icons/mono/16x16/form/work.png">
                  </div>
                </div>
                <input type="text" name="reference" class="form-control" placeholder="Ej. PMZ/OF040/2020">
              </div>
              
              <label class="p-2 font-weight-bold"><span class="text-danger">*</span> Tipo de Solicitud:</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <img src="<?php echo Assets;?>/images/icons/mono/16x16/form/request.png">
                  </div>
                </div>
                <select class="form-control" name="request">
                  <option value="Envío de Documentación">Envio de Documentación</option>
                  <option value="Solicitud de Recursos">Solicitud de Recursos</option>
                  <option value="Contestación">Contestación</option>
                  <option value="de Conocimiento">Conocimiento</option>
                  <option value="Invitación">Invitación</option>
                </select>
              </div>
              
            </div>

            <hr class="bg-success"/>

            <div class="container">
              <!---->
              <div class="text-center text-content-default">
                <span class="bg-default-theme text-light p-2 rounded text-justify">
                  Si NO hay resultados que coincidan, <strong><u>Completa</u></strong> los campos correctamente y <strong><u>marca</u></strong> la casilla "Nuevo" para agregarlo a la lista.
                </span>
              </div>
              <hr/>
              <!---->
              <div class="row col-sm-12">
                <!---->
                <div class="col-sm-2">
                  <br><br><br><br>
                  <label class="p-2 font-weight-bold"><span class="text-danger">*</span> Remitente:</label>
                </div>
                <!---->

                <!---->
                <div class="col-sm-4">
                  <label class="p-2"><span class="text-danger">*</span> Nombre:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <img src="<?php echo Assets;?>/images/icons/mono/16x16/form/user.png">
                      </div>
                    </div>
                    <!---->
                    <input type="text" id="key_senders" class="form-control" placeholder="NOMBRE(S) APELLIDOS" name="name_sender">
                    <input id="id_sender" type="hidden" value="" name="id_sender">
                    <input id="new_sender" type="hidden" name="new_sender" value="n">
                    <!---->
                  </div>
                  
                  <label class="p-2"><span class="text-danger">*</span> Cargo:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <img src="<?php echo Assets;?>/images/icons/mono/16x16/form/employee.png">
                      </div>
                    </div>
                    <input id="job_sender" name="job_sender" type="text" class="form-control" placeholder="CARGO ACTUAL" disabled="">
                  </div>
                  
                  <label class="p-2"><span class="text-danger">*</span> Dependencia:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <img src="<?php echo Assets;?>/images/icons/mono/16x16/form/suitcase.png">
                      </div>
                    </div>
                    <input id="dependency_sender" name="dependency_sender" type="text" class="form-control" placeholder="DEPENDENCIA RECEPTORA" disabled="">
                  </div>
                  <hr>
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="checkboxNewSender" 
                    onchange="allowNewSenderReceiver(this,['job_sender','dependency_sender','new_sender']);">
                    <label class="link link-sm link-outline-purple form-check-label" for="checkboxNewSender" data-toggle="tooltip" data-placement="right" title="Elige ésta opción para agregar un nuevo Remitente.">
                      Nuevo
                    </label>
                  </div>
                </div>
                <!---->

                <!---->
                <div class="col-sm-2">
                  <br><br><br><br>
                  <label class="p-2 font-weight-bold"><span class="text-danger">*</span> Para:</label>
                </div>
                <!---->

                <!---->
                <div class="col-sm-4">
                  
                  <label class="p-2"><span class="text-danger">*</span> Nombre:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <img src="<?php echo Assets;?>/images/icons/mono/16x16/form/user.png">
                      </div>
                    </div>
                    <!---->
                    <input type="text" id="key_receivers" class="form-control" placeholder="NOMBRE(S) APELLIDOS" name="name_receiver">
                    <input id="id_receiver" type="hidden" value="" name="id_receiver">
                    <input id="new_receiver" type="hidden" name="new_receiver" value="n">
                    <!---->
                  </div>
                  
                  <label class="p-2"><span class="text-danger">*</span> Cargo:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <img src="<?php echo Assets;?>/images/icons/mono/16x16/form/employee.png">
                      </div>
                    </div>
                    <input id="job_receiver" name="job_receiver" type="text" class="form-control" placeholder="CARGO ACTUAL" disabled="">
                  </div>
                  
                  <label class="p-2"><span class="text-danger">*</span> Dependencia:</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <img src="<?php echo Assets;?>/images/icons/mono/16x16/form/suitcase.png">
                      </div>
                    </div>
                    <input id="dependency_receiver" name="dependency_receiver" type="text" class="form-control" placeholder="DEPENDENCIA RECEPTORA" disabled="">
                  </div>
                  <hr>
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="checkboxNewReceiver" 
                    onchange="allowNewSenderReceiver(this,['job_receiver','dependency_receiver','new_receiver']);">
                    <label class="link link-sm link-outline-purple form-check-label" for="checkboxNewReceiver" data-toggle="tooltip" data-placement="right" title="Elige ésta opción para agregar un nuevo Destinatario o Persona Receptora.">
                      Nuevo
                    </label>
                  </div>
                </div>
                <!---->
              </div>  
              <!---->
            </div>

            <hr class="bg-success"/>

            <div class="form-group form-inline">
              <label class="p-2 font-weight-bold">Monto (si aplica):</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <img src="<?php echo Assets;?>/images/icons/mono/16x16/form/dollar.png">
                  </div>
                </div>
                <input id="amount" type="text" name="amount" class="form-control col-sm-6" placeholder="Ej. 2000000">
              </div>
            </div>

            <hr class="bg-success"/>

            <div class="form-group form-inline">
              <label class="p-2 font-weight-bold"><span class="text-danger">*</span> Asunto:</label>
              <textarea class="form-control col-sm-4" rows="4" placeholder="DESCRIPCIÓN BREVE" name="subject"></textarea>
              <label class="p-2 font-weight-bold">Indicaciones (Opcional):</label>
              <textarea id="indications" class="form-control col-sm-4" rows="4" placeholder="DESCRIPCIÓN BREVE" name="indications"></textarea>
            </div>

            <hr class="bg-info"/>

            <div class="p-3 mb-2 rounded bg-gradient-info text-white">
              Turnar a:
            </div>

            <hr class="bg-info"/>

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

            <hr class="bg-info" />

            <div class="text-center">
              <span class="bg-gradient-info text-light p-2 rounded text-justify">
                Si NO hay resultados que coincidan, <strong><u>Notifique</u></strong> al área correspondiente para que se realice el registro correspondiente.
              </span>
            </div>

            <hr class="bg-warning"/>

            <div class="p-3 mb-2 rounded bg-gradient-warning text-dark">Evidencia:</div>

            <hr class="bg-warning"/>

            <div class="form-group form-inline">
              <label class="p-2 font-weight-bold">Tipo de Archivo:</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <img src="<?php echo Assets;?>/images/icons/mono/16x16/form/paperclip.png">
                  </div>
                </div>
                <select id="typeFile" class="form-control" onchange="setInputType()" name="typeFile">
                  <option value="pdf" selected="">Archivo PDF</option>
                  <option value="image">Imágen</option>
                </select>
              </div>
              <span class="badge badge-warning text-justify">Elija un archivo PDF / Imágen con la evidencia necesaria.<br>Sólo 1 archivo.</span>
            </div>
            <!---->
            <div id="inputImage" class="container" style="display: none;">
              <label class="p-2"><span class="text-danger">*</span>Seleccione la Imágen (Máx. 5MB)</label>
              <input id="inputFileImage" type="file" class="col-sm-4" name="none" accept="image/png, image/jpeg, image/jpg" onchange="verifyFile(this);">
              <img src="" id="imagePreview" class="border rounded border-warning img-thumbnail" width="180" height="140" style="display: none">
            </div>
            <div id="inputPDF" class="container">
              <label class="p-2"><span class="text-danger">*</span>Seleccione el Archivo PDF (Máx. 5MB)</label>
              <input id="inputFilePDF" type="file" class="col-sm-4" name="file" accept="application/pdf" onchange="verifyFile(this);">
            </div>
            <p id="fileMetaInfo" class="text-justify text-success" style="display: none;">
            </p>
            <!---->
            <hr>
            <div class="col-sm-6">
              <label class="p-2 font-weight-bold">Descripción (opcional):</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <img src="<?php echo Assets;?>/images/icons/mono/16x16/form/description.png">
                  </div>
                </div>
                <textarea id="description_e" name="description_e" class="form-control" placeholder="Ej. 'Evidencia sobre ...'" rows="3"></textarea>
              </div>
            </div>
            <hr class="bg-warning">
            <!---->
            <div class="text-center">
              <a href="index.php" class="link link-outline-danger img">
                Cancelar
                <img src="<?php echo Assets;?>/images/icons/mono/16x16/back.png">
              </a>
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

          <!-- HERE END CONTENT -->
        </div>

        <hr class="border-default-theme">
        <h4 class="text-content-default text-right"><strong>Registro</strong> de Oficios.</h4>
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
    <script src="<?php echo Assets;?>/plugins/jquery-ui/jquery-ui.js" type="text/javascript"></script>
    <script src="<?php echo Assets;?>/plugins/jquery-validation/jquery.validate.min.js" type="text/javascript"></script>
    <script src="<?php echo Assets;?>/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo Assets;?>/js/user.js" type="text/javascript"></script>
    <script src="<?php echo Assets;?>/js/user.form.js" type="text/javascript"></script>
    <script src="<?php echo Assets;?>/js/user.record.form.js" type="text/javascript"></script>

  </body>

</html>
