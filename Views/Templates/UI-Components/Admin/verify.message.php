<?php
	if (isset($_GET["type"]) && isset($_GET["msg"]) && isset($_GET["from"])) {
		$message = "";
		$type  = $_GET["type"];
		$msg   = $_GET["msg"];
		$model = "";
		switch ($_GET["from"]) {
			case 'administrator':
				$model = "Administrador(a)";
				break;
			case 'dependency':
				$model = "Dependencia";
				break;
			case 'user':
				$model = "Usuario(a)";
				break;
			case 'employee':
				$model = "Remitente/Destinatario";
				break;
		}

		switch ($type) {
			case 'new':
				if ($msg == "y") {
					$message = "<strong>".$model."</strong> registrado(a) satisfactoriamente.";
					$alert = "alert-success";
				} else {
					$message = "No fue posible registrar el/la <strong>".$model."</strong>";
					$alert = "alert-danger";
				}
				break;
			case 'update':
				if ($msg == "y") {
					$message = "<strong>".$model."</strong> actualizado(a) satisfactoriamente.";
					$alert = "alert-warning";
				} else {
					$message = "No fue posible actualizar el/la <strong>".$model."</strong>";
					$alert = "alert-danger";
				}
				break;
			case 'destroy':
				if ($msg == "y") {
					$message = "<strong>".$model."</strong> eliminado(a) satisfactoriamente.";
					$alert = "alert-danger";
				} else {
					$message = "No fue posible eliminar el/la <strong>".$model."</strong>, probablemente otro <b>Registro</b> depende del registro actual.";
					$alert = "alert-danger";
				}
				break;
			case 'login':
				if ($msg == "y") {
					$message = "<strong>".$model."</strong>Sesión Iniciada, Bienvenido(a).";
					$alert = "alert-primary";
				} else {
					$message = "No fue posible iniciar sesión <strong>".$model."</strong>";
					$alert = "alert-danger";
					if (isset($_GET["attempt"])) {
						$message .= "<br>¡Contraseña Incorrecta!<br><strong>Intentos de Inicio de Sesión = ".$_GET["attempt"]."<strong>";
					}
					if (isset($_GET["data"]) && $_GET["data"] == "n") {
						$message .= "<br><br> No existe una cuenta asociada, Intente de nuevo.";
					}
				}
				break;
		}
		echo '
			<div class="alert '.$alert.' alert-dismissible fade show text-center" role="alert">
			  '.$message.'
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			  </button>
			</div>
			';
	}
?>
