<?php define('ui_component',dirname( __DIR__ , 1)."/Templates/UI-Components/Session/"); ?>
<?php define('Assets',"../../Assets") ?>
<?php define('formAction',"../../Controllers/SessionController.php"); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <link rel="shortcut icon" href="<?php echo Assets;?>/images/sco/edomex-logo.png" type="image/png">
  <title>Inicio de Sesión</title>
  <link href="<?php echo Assets;?>/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
  <link href="<?php echo Assets;?>/css/session.css" rel="stylesheet">
</head>
<body>
	<div class="row container" style="padding-top: 2em;">
		<div class="col text-center">
			<h4><i>Visita nuestro portal principal.</i></h4>
			<a href="https://sanjosedelrincon.gob.mx/" data-toggle="tooltip" data-placement="right" title="Visitar Portal Principal" target="_blank">
				<img class="mb-4 img-hover" src="<?php echo Assets;?>/images/sco/sjr-logo.png">
			</a>
			<hr style="width: 50%;"/>
			<h1 class="h3 mb-3 font-weight-normal">Bienvenido(a), por favor inicia sesión.</h1>
		</div>
		<!---->
		<div class="col text-center">
			<div class="container text-justify">
				<?php require_once ui_component.'verify_message.php'; ?>
			</div>
			<img src="<?php echo Assets;?>/images/sco/logos/logo.png" style="width: 100px; height: 110px">
			<p class="">
				Teléfono: 712 124 2097 | 712 124 2098 | <br/>
				Correo: municipio@sanjosedelrincon.gob.mx <br/>
				<hr class="bg-info">
				San José del Rincón, Estado de México, 2020
				<hr class="bg-info">
				<img src="<?php echo Assets;?>/images/sco/logos/img_ico.png" style="width: 40px; height: 40px;">
		    <b>Sistema de Control de Oficios</b>
			</p>
			<form id="form_session" class="form-signin" method="POST" action="<?php echo formAction; ?>">
				<!---->
				<input type="hidden" name="type" value="new">
				<input type="hidden" name="attempt" value="<?php echo $_GET["attempt"]; ?>">
				<!---->
        <input type="text" id="inputEmail" class="form-control" placeholder="Correo Electrónico" required="" autofocus="" name="user">

        <br>

        <input type="password" id="inputPassword" class="form-control" placeholder="Contraseña" required="" name="pswd">

	      <div class="form-check mb-3">
	        <input type="checkbox" class="form-check-input" id="checkboxAdmin" name="admin">
	        <label class="badge link-outline-purple cursor" for="checkboxAdmin" data-toggle="tooltip" data-placement="top" title="Elige ésta opción para iniciar sesión como Administrador(a) del Sistema.">
	          Iniciar Sesión como: Administrador(a).
	        </label>
	      </div>
	      <hr/>
		    <button class="link link-lg link-outline-info link-block" type="submit">Iniciar Sesión</button>
		    <hr class="bg-info">
			  <div class="text-center"><span class="badge badge-pill badge-info">Verifique sus credenciales.</span></div>
		  </form>
		</div>
	  <!---->
	</div>

	<!-- SRCRIPTS-->
  <script src="<?php echo Assets;?>/plugins/jquery/jquery-3.4.1.min.js" type="text/javascript"></script>
  <script src="<?php echo Assets;?>/plugins/jquery-validation/jquery.validate.min.js" type="text/javascript"></script>
  <script src="<?php echo Assets;?>/js/session.form.js" type="text/javascript"></script>
  <script src="<?php echo Assets;?>/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
</body>
</html>
