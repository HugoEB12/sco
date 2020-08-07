<?php
	require_once($currentPath."../Models/ConnectionModel.php");
	require_once($currentPath."../Models/SessionModel.php");
  use SessionModel as Session;

	//CLASS
	class SessionController
	{
		private $model;
		private $view;
		private $from;
		private $viewUser;
		/**/
		private $emailProvided;
		/**/
		private $sessionId;

		public function __construct($admin)
		{
			$this->model 		= new Session(false,"login.php",$admin);
			$this->view  		= '../Views/Sessions/login.php';
			$this->from  		= ($admin)?"admin"  :"user";
			$this->viewUser = ($admin)?"../Views/Admin/":"../Views/Users/";
			/**/
			$this->emailProvided = "";
			/**/
		}

		/**/
		public function setEmailProvided($email)
		{
			$this->emailProvided = $email;
		}

		public function getEmailProvided()
		{
			return $this->emailProvided;
		}
		/**/

		public function getUser($email,$pass,$attempt)
		{
			$msg = ($this->model->findUser($email,$pass))?"y":"n";
			$this->setEmailProvided($email);
			if ($msg == "n") {
				if ($this->model->findEmail() && $this->getEmailProvided() == $email) {
					//SI EL EMAIL CORRESPONDE AL ANTERIOR AUMENTAN LOS INTENTOS
					$a = (int)($attempt)+1;
					if ($a == 5){
						$this->model->blockUser($email);
						echo "<script>alert('Se ha bloqueado la cuenta, deberás esperar 5 minutos para volver a ingresar.');</script>";
						echo "<script>location.replace(\"".$this->view."\")</script>";
					} else {
						header("Refresh: 0, URL=".$this->view."?from=".$this->from."&type=login&msg=".$msg."&attempt=".$a);
					}
				} else {
					//USUARIO NO REGISTRADO
					header("Refresh: 0, URL=".$this->view."?from=".$this->from."&type=login&msg=".$msg."&data=n");
				}
			} else {
				//ENCONTRO EL EMAIL Y LA CONTRASEÑA INGRESADA ES CORRECTA
				if ($this->from == "user") {
					$user = $this->model->getUser($email,$pass);
					$this->startSessionUser($user);
				} else {
					$admin = $this->model->getAdmin($email,$pass);
					$this->startSessionAdmin($admin);
				}
				header("Refresh: 0, URL=".$this->viewUser."?from=".$this->from."&type=login&msg=".$msg);
			}
		}

		public function userBlock($email)
		{
			return $this->model->isBlockedUser($email);
		}

		public function checkTimeBlocked($email)
		{
			return $this->model->checkTimeBlock($email);
		}

		public function unlockedUser($email)
		{
			return $this->model->unlockUser($email);
		}

		public function getTime()
		{
			return $this->model->getTimeRemaining();
		}
/**/
		public function setSessionId($id)
		{
			$this->sessionId = $id;
		}

		public function getSessionId()
		{
			return $this->sessionId;
		}

/**/
		public function destroySessionAdmin()
		{
			//session_start();
			//session_destroy();
			//session_commit();
			unset($_SESSION["id_admin"]);
			unset($_SESSION["name_admin"]);
			unset($_SESSION["lname_admin"]);
			unset($_SESSION["from_admin"]);
			unset($_SESSION["timeout_admin"]);
			unset($_SESSION["token_admin"]);
			header("Refresh: 0, URL=".$this->view);
		}

		public function destroySessionUser()
		{
			//session_start();
			//session_destroy();
			//session_commit();
			unset($_SESSION["id_user"]);
			unset($_SESSION["name_user"]);
			unset($_SESSION["lname_user"]);
			unset($_SESSION["from_user"]);
			unset($_SESSION["timeout_user"]);
			unset($_SESSION["token_user"]);
			unset($_SESSION["dependency"]);
			unset($_SESSION["finish"]);
			header("Refresh: 0, URL=".$this->view);
		}

		public function startSessionUser($params)
		{
			session_start();
			//crea un nuevo ID único para representar la sesión actual del usuario. EVITA ATAQUES DE SESIÓN
			session_regenerate_id();
			$this->setSessionId(session_id());
			$_SESSION["id_user"] 			= $params['id_user'];
			$_SESSION["name_user"]  	= $params['name'];
			$_SESSION["lname_user"] 	= $params['lname'];
			$_SESSION["from_user"] 		= 'user';
			$_SESSION["timeout_user"] = time();
			$_SESSION["token_user"] 	= md5(uniqid(mt_rand(), true));//GENERA UN ID ÚNICO Y ALEATORIO y DEVUELVE UN HASH*/
			$_SESSION["dependency"]   = $params["dep"]; //type of dependency
			/**/
			if ($params["finish"] == "SI") {
				$_SESSION["finish"] = "SI";
			}
			/**/
		}

		public function startSessionAdmin($params)
		{
			session_start();
			//crea un nuevo ID único para representar la sesión actual del usuario. EVITA ATAQUES DE SESIÓN
			session_regenerate_id();
			$this->setSessionId(session_id());
			$_SESSION["id_admin"] = $params['id_admin'];
			$_SESSION["name_admin"]  		= $params['name'];
			$_SESSION["lname_admin"] 		= $params['lname'];
			$_SESSION["from_admin"] 		= 'admin';
			$_SESSION["timeout_admin"] 	= time();
			$_SESSION["token_admin"] 		= md5(uniqid(mt_rand(), true));//GENERA UN ID ÚNICO Y ALEATORIO y DEVUELVE UN HASH*/
		}

		public function verifyUser($params)
		{
			$user 	 = $params["user"];
			$pswd 	 = $params["pswd"];
			$attempt = $params["attempt"];
			if ($this->userBlock($user)){
				//echo "usuario bloqueado<br>";
				if ($this->checkTimeBlocked($user)) {
					//echo $this->getTime()."<br>Tu cuenta aún sigue bloqueada";
					header("Refresh: 0, URL=../Views/Sessions/time_remaining.php?elapsed=".$this->getTime());
				} else {
					$this->unlockedUser($user);
					//echo "Desbloquear Usuario<br>";
					header("Refresh: 0, URL=".$this->view."?from=".$this->from."&type=login&msg=".$msg."&unlock=y");
				}
			} else {
				$this->getUser($user,$pswd,$attempt);
			}
		}

	}
	//END_CLASS


///MAIN

	if (isset($_POST["type"])) {
		switch ($_POST["type"]) {
			case 'new'://NEW SESSION
				$params = array(
					"user" 	  => strip_tags($_POST["user"]),
					"pswd"	  => strip_tags($_POST["pswd"]),
					"attempt" => filter_input(INPUT_POST, 'attempt', FILTER_VALIDATE_INT)
				);
				$session = new SessionController((isset($_POST["admin"]) && $_POST["admin"] == "on")?true:false);
				$session->verifyUser($params);
				break;
		}
	}

	if (isset($_GET["from"])) {
		switch ($_GET["from"]) {
			case 'user':
				$session = new SessionController(false);//Admin = false
				session_start();
				//CUANDO SE TRATA DE "CERRAR LA SESIÓN"
				//VERIFICAMOS QUE LA PETICIÓN CORRESPONDA CON UN USUARIO DEL SISTEMA (VERIFICAMOS EL TOKEN)
				//EL TOKEN GENERADO AL INICIAR LA SESIÓN TIENE QUE SER EL MISMO DE DONDE PROVIENE LA PETICIÓN
				if ($_GET["destroy"] == "yes" && $_GET["csrf"] == $_SESSION["token_user"]) { 
					$session->destroySessionUser();
				}
				break;
			case 'admin':
				$session = new SessionController(true);//Admin = true
				session_start();
				if ($_GET["destroy"] == "yes" && $_GET["csrf"] == $_SESSION["token_admin"]) { 
					$session->destroySessionAdmin();
				}
				break;
		}
	}

///END_MAIN
?>