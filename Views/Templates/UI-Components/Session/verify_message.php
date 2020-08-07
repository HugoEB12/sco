<?php
	if (isset($_GET["type"]) && isset($_GET["msg"]) && isset($_GET["from"])) {
		$message = "";
		$type  	 = $_GET["type"];
		$msg   	 = $_GET["msg"];
		$model 	 = ""; 
		//
		switch ($_GET["from"]) {
			case 'admin':
				$model = "Administrador(a)";
				break;
			case 'user':
				$model = "Usuario(a)";
				break;
		}
		//
		switch ($type) {
			case 'login':
				if ($msg == "y") {
					$message = "<strong>Sesión Iniciada</strong>, Bienvenido(a).";
					$alert = "alert-primary";
				} else {
					$message = "No fue posible iniciar sesión de <strong>".$model."</strong>";
					$alert = "alert-danger";
					if (isset($_GET["attempt"])) {
						$message .= "<br>¡Contraseña Incorrecta!<br><strong>Intentos de Inicio de Sesión = ".$_GET["attempt"]."<strong>";
					}
					if (isset($_GET["data"]) && $_GET["data"] == "n") {
						$message .= "<br> ¡No existe una cuenta asociada!, intente de nuevo.";
					}
					if (isset($_GET["unlock"]) && $_GET["unlock"] == "y") {
						$alert = "alert-success";
						$message = "Tu cuenta de se ha <b>Desbloqueado, </b>¡Intenta de Nuevo!.";
					}
				}
				break;
			}
			//
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