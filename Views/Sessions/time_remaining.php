<?php define('Assets',"../../Assets") ?>
<!DOCTYPE html>
<html>
<head>
	<title>Cuenta Bloqueada</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="<?php echo Assets;?>/images/sco/edomex-logo.png" type="image/png">
  <link href="<?php echo Assets;?>/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo Assets;?>/css/session.css" rel="stylesheet">
</head>
<body>
	<?php $elapsed = (isset($_GET["elapsed"]))?$_GET["elapsed"]:"";?>
	<div class="row" style="padding-top: 10em; width: 90%;">
		<div class="col text-center">
			<a href="https://sanjosedelrincon.gob.mx/" data-toggle="tooltip" data-placement="right" title="Visitar Portal Principal" target="_blank">
				<img class="mb-4 img-hover" src="<?php echo Assets;?>/images/sco/sjr-logo.png">
			</a>
			<hr style="width: 50%;"/>
			<h1 class="h3 mb-3 font-weight-normal">¡Oops!, parece que algo ha sucedido.</h1>
		</div>
		<div class="col">
			<br><br>
			<p>
				Tu cuenta se ha bloqueado durante 5 minutos, después de varios intentos de inicio de sesión.
				<hr>
				<div class="text-center">
					Tiempo Restante: <b><?php echo $elapsed; ?> minuto(s).</b>
				</div>
				<hr>
				Espera hasta que tu cuenta sea desbloqueada, o notifica al Departamento o Administradores(as) del sistema para que
				te permitan el acceso.
				<hr>
				<div class="text-center">
					<a href="login.php" class="link link-outline-warning">Volver a intentar</a>	
				</div>
			</p>
		</div>
	</div>
</body>
</html>