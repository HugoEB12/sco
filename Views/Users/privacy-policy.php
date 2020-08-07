<?php require_once "../Templates/UI-Components/Users/init.path.php"; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Asuntos | Política de Privacidad</title>
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
          <br/>
					<h2 class="text-center">
						<strong>POLÍTICA DE PRIVACIDAD</strong>
					</h2>
					<hr class="border-default-theme" />
					<p class="text-justify">
						El presente Política de Privacidad establece los términos en que H. Ayuntamiento de San José del Rincón usa y protege la información que es proporcionada por sus usuarios al momento de utilizar su sitio web. Esta compañía está comprometida con la seguridad de los datos de sus usuarios. Cuando le pedimos llenar los campos de información personal con la cual usted pueda ser identificado, lo hacemos asegurando que sólo se empleará de acuerdo con los términos de este documento. Sin embargo esta Política de Privacidad puede cambiar con el tiempo o ser actualizada por lo que le recomendamos y enfatizamos revisar continuamente esta página para asegurarse que está de acuerdo con dichos cambios.
					</p>
					<hr class="border-default-theme" />
					<p><strong>Información que es recogida</strong></p>
					<hr class="border-default-theme" />
					<p class="text-justify">
						Nuestro sitio web podrá recoger información personal por ejemplo: Nombre; información de contacto como; su dirección de correo electrónico. Así mismo cuando sea necesario podrá ser requerida información específica para procesar algún asunto o verificar algún "turno".
					</p>
					<hr class="border-default-theme" />
					<p><strong>Uso de la información recogida</strong></p>
					<hr class="border-default-theme" />
					<p class="text-justify">
						Nuestro sitio web emplea la información con el fin de proporcionar el mejor servicio posible, particularmente para mantener un registro de usuarios y control de asuntos. Es posible que sean enviados correos electrónicos periódicamente a través de nuestro sitio con información publicitaria que consideremos relevante para usted o que pueda brindarle algún beneficio, estos correos electrónicos serán enviados a la dirección que usted proporcione y podrán ser cancelados en cualquier momento.
						<br/><br/>
						H. Ayuntamiento de San José del Rincón está altamente comprometido para cumplir con el compromiso de mantener su información segura. Usamos los sistemas más avanzados y los actualizamos constantemente para asegurarnos que no exista ningún acceso no autorizado.
					</p>
					<hr class="border-default-theme" />
					<p><strong>Cookies</strong></p>
					<hr class="border-default-theme" />
					<p class="text-justify">
						Una cookie se refiere a un archivo que es enviado con la finalidad de solicitar permiso para almacenarse en su ordenador, al aceptar dicho fichero se crea y la cookie sirve entonces para tener información respecto al tráfico web, y también facilita las futuras visitas a una web recurrente. Otra función que tienen las cookies es que con ellas las web pueden reconocerte individualmente y por tanto brindarte el mejor servicio personalizado de su web.
					</p>
					<p class="text-justify">
						Nuestro sitio web emplea las cookies para poder identificar las páginas que son visitadas y su frecuencia. Esta información es empleada únicamente para análisis estadístico y después la información se elimina de forma permanente. Usted puede eliminar las cookies en cualquier momento desde su ordenador. Sin embargo las cookies ayudan a proporcionar un mejor servicio de los sitios web, estás no dan acceso a información de su ordenador ni de usted, a menos de que usted así lo quiera y la proporcione directamente.
						<br/><br/>
						Usted puede aceptar o negar el uso de cookies, sin embargo la mayoría de navegadores aceptan cookies automáticamente pues sirve para tener un mejor servicio web. También usted puede cambiar la configuración de su ordenador para declinar las cookies. Si se declinan es posible que no pueda utilizar algunos de nuestros servicios.
					</p>
					<hr class="border-default-theme" />
					<p><strong>Enlaces a Terceros</strong></p>
					<hr class="border-default-theme" />
					<p class="text-justify">
						Este sitio web pudiera contener en laces a otros sitios que pudieran ser de su interés. Una vez que usted de clic en estos enlaces y abandone nuestra página, ya no tenemos control sobre al sitio al que es redirigido y por lo tanto no somos responsables de los términos o privacidad ni de la protección de sus datos en esos otros sitios terceros. Dichos sitios están sujetos a sus propias políticas de privacidad por lo cual es recomendable que los consulte para confirmar que usted está de acuerdo con estas.
					</p>
					<hr class="border-default-theme" />
					<p><strong>Control de información personal</strong></p>
					<hr class="border-default-theme" />
					<p class="text-justify">
						<i>
							No se venderá, ni se distribuirá la información personal que es recopilada sin su consentimiento, salvo que sea requerido por un juez con un orden judicial.
							<br/><br/>
							H. Ayuntamiento de San José del Rincón Se reserva el derecho de cambiar los términos de la presente Política de Privacidad en cualquier momento.
						</i>
					</p>

				<!---->
        </div>

        <hr class="border-default-theme" />

      </div>
      <!-- END CONTAINER -->
    </div>
    <!-- END SIDE CONTENT -->

    <?php include_once ui_component."bottombar.php"; ?>

    <!-- SRCRIPTS-->
    <script src="<?php echo Assets;?>/plugins/jquery/jquery-3.4.1.min.js" type="text/javascript"></script>
    <script src="<?php echo Assets;?>/plugins/popper/popper.min.js" type="text/javascript"></script>
    <script src="<?php echo Assets;?>/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo Assets;?>/js/admin.js" type="text/javascript"></script>
    <!---->

  </body>

</html>
