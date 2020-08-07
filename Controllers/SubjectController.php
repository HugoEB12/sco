<?php
	require_once($currentPath."../Models/ConnectionModel.php");
	require_once($currentPath."../Models/SubjectModel.php");
  use SubjectModel as Subject;

	//CLASS
	class SubjectController
	{
		private $model;
		private $view;
		private $from;

		public function __construct()
		{
			$this->model = new Subject(true,"search.php");
			$this->view  = '../Views/Users/view.php';
			$this->from  = "subject";
		}

		public function show()
		{
			return $this->model->findAll();
		}

		public function showPaginate($current_page)
		{
			return $this->model->paginate($current_page);
		}

		public function showPages()
		{
			return $this->model->getPagination()->placePagination();
		}

		public function showById($id)
		{
			return $this->model->findById($id)[0];
		}

		public function showSender($id)
		{
			return $this->model->findSenderReceiver($id,"1")[0];
		}

		public function showReceiver($id)
		{
			return $this->model->findSenderReceiver($id,"2")[0];
		}

		public function showUser($id)
		{
			return $this->model->findUser($id)[0];
		}

		public function showTurns($id)
		{
			return $this->model->findTurns($id);
		}

		public function showBySearch($sub,$ref,$req,$status,$current_page)
		{
			$user = $this->getUserBySession();//ALL SUBJECTS RELATED WITH THE CURRENT USER
			/**/
			$whereArr = array();
			if($sub != "") $whereArr[] = "id_subject={$sub}";
			if($ref != "") $whereArr[] = "reference='{$ref}'";
			if($req != "") $whereArr[] = "request='{$req}'";
			if($status != ""){
				$current = date("Y-m-d");
				switch ($status) {
					case 'En Proceso / A tiempo'://En proceso
						$whereArr[] = "admission <= '".$current."' AND expiration > '".$current."' AND finish=0";
						break;
					case 'NO Atendidos / Fuera de Tiempo'://Vencidos
						$whereArr[] = "expiration <= '".$current."'";
						break;
					case 'Finalizados'://Finalizados
						$whereArr[] = "finish=1";
						break;
				}
			}
			$whereStr = "";
			if (count($whereArr) > 0) {
				$whereStr = " WHERE ".implode(" AND ", $whereArr);
				return $this->model->search($whereStr,$current_page,$user);
			} else {
				return $this->model->paginateByUser($current_page,$user);
			}
		}

		public function showStatus($admission,$expiration,$finish)
		{
			$status = "";
			if ($finish) {
				$status = 'Finalizado <div class="sphere sphere-blue"></div>';
			} else {
				$currentDate = date("Y-m-d");
				if ($currentDate >= $admission && $currentDate < $expiration) {
					$status = 'En Proceso <div class="sphere sphere-green"></div>';
				} else if ($currentDate >= $expiration) {
					$status = 'Venció <div class="sphere sphere-red"></div>';
				}
			}

			echo $status;
		}

		public function showRequestValues()
		{
			return array(
				":p1" => 'Envío de Documentación',
        ":p2" => 'Solicitud de Recursos',
        ":p3" => 'Contestación',
        ":p4" => 'de Conocimiento',
        ":p5" => 'Invitación'
			);
		}

		public function showStatusValues()
		{
			return array(
				"1" => 'En Proceso / A tiempo',
        "2" => 'NO Atendidos / Fuera de Tiempo',
        "3" => 'Finalizados'
			);
		}

		public function newTurn($params)
		{
			$msg = $view = "";
			if($this->model->insertTurn($params)){
				$msg = "y";
				$view = "../Views/Users/view.php";
			} else {
				$msg ="n";
				$view = "../Views/Users/index.php";
			}
			header("Refresh: 0, URL=".$view.
											 "?type=new".
											 "&msg=".$msg.
											 "&from=turn".
											 "&id=".$this->model->getLasInsertId()
			);
		}

		public function newEvidence($params,$subject)
		{
			$msg = $view = "";
			if($this->model->insertEvidence($params,$subject)){
				$msg = "y";
				$view = "../Views/Users/view.php";
			} else {
				$msg ="n";
				$view = "../Views/Users/index.php";
			}
			header("Refresh: 0, URL=".$view.
											 "?type=new".
											 "&msg=".$msg.
											 "&from=evidence".
											 "&id=".$subject
			);
		}

		public function new($params,$fileParams,$turn)
		{
			$msg = $view = "";
			if($this->model->insert($params,$fileParams,$turn)){
				$msg = "y";
				$view = "../Views/Users/view.php";
			} else {
				$msg ="n";
				$view = "../Views/Users/index.php";
			}
			header("Refresh: 0, URL=".$view.
											 "?type=new".
											 "&msg=".$msg.
											 "&from=".$this->from.
											 "&id=".$this->model->getLasInsertId()
			);
		}

		public function edit($params,$page)
		{
			$msg = ($this->model->update($params))?"y":"n";
			header("Refresh: 0, URL=".$this->view."?page=".$page."&type=update&msg=".$msg."&from=".$this->from);
		}

		public function destroy($id,$page)
		{
			$msg = ($this->model->delete($id))?"y":"n";
			header("Refresh: 0, URL=".$this->view."?page=".$page."&type=destroy&msg=".$msg."&from=".$this->from);
		}

		/*AJAX METHODS*/
		public function getSendersByAjax($key)
		{
			echo $this->model->getSuggestions($key,"1");
		}

		public function getReceiversByAjax($key)
		{
			echo $this->model->getSuggestions($key,"2");
		}

		public function getUsersByAjax($key,$dep,$usr)
		{
      echo $this->model->getSuggestionsUsers($key,$dep,$usr);
		}

		public function createDirectory($path)
		{
		  $oldumask = umask(0);
		  $success  = mkdir($path,0777,true);
		  umask($oldumask);
		  if (!$success){
		    echo "<script>alert('Falló al crear el directorio \\n ¡Permiso Denegado!');</script>";
		  } else {
		    echo "Directorio creado con éxito<br>";
		  }
		}

		public function moveFile($FILE,$type,$user,$description)
		{
		  //upload/move file to folder
		  $fileName     = date("d-m-Y-H-i-s")."-".str_replace(" ", "", $FILE["name"]);
		  $relativePath = "../../Assets/Files/".$type."/".$fileName;
		  $fullPath     = $_SERVER["DOCUMENT_ROOT"]."/SCO/Assets/Files/".$type."/".$fileName;
		  /**/
		  move_uploaded_file($FILE["tmp_name"],$fullPath);
		  /**/
		  $fileSize = $FILE["size"];/*SIZE IN BYTES*/
		  /**/
		  $fileParams = array(
		  	':p1' => null,
		  	':p2' => $fileName,
		  	':p3' => $fileSize,
		  	':p4' => $relativePath,
		  	':p5' => $user,
		  	':p6' => $description,
		  	':p7' => date('d/m/Y \\a \\l\\a\\s H:i:s \\h\\r\\s.'),
		  	':p8' => date('d/m/Y \\a \\l\\a\\s H:i:s \\h\\r\\s.')
		  );
		  /**/
		  return $fileParams;
		}

		public function getParamsSR($p1,$p2,$p3,$p4)
		{
			return	array(':p1' => null, ':p2' => $p1, ':p3' => $p2, ':p4' => $p3, ':p5' => $p4, ':p6' => date('d/m/Y \\a \\l\\a\\s H:i:s \\h\\r\\s.'),
			':p7' => date('d/m/Y \\a \\l\\a\\s H:i:s \\h\\r\\s.'));
		}

		public function newSR($params)
		{
			return $this->model->insertSenderReceiver($params);
		}

		public function getTurnParams($user,$users)
		{
			$turns = $user;
			if ($users != "") {
				$turns .= ",".$users;
			}
			$params = array();
			$users = explode(",", $turns);
        for ($i = 0; $i < count($users); $i++) {
        	array_push($params,
        		array(
							":p1" => null,
							":p2" => (isset($_POST["id"]))?$_POST["id"]:"",
							":p3" => $this->getUserBySession(),//by
							":p4" => $users[$i],
							":p5" => date('d/m/Y \\a \\l\\a\\s H:i:s \\h\\r\\s.')
						)
        	);
				}
			return $params;
		}

		public function getUserBySession()
		{
			if (session_status() == PHP_SESSION_NONE) {
				session_start();
			}
			return $_SESSION["id_user"];
		}

		public function finalResponse($params,$subject)
		{
			$msg = $view = "";
			if($this->model->finishSubject($params,$subject)){
				$msg = "y";
				$view = "../Views/Users/view.php";
			} else {
				$msg ="n";
				$view = "../Views/Users/index.php";
			}
			header("Refresh: 0, URL=".$view.
											 "?type=finish".
											 "&msg=".$msg.
											 "&from=finish".
											 "&id=".$subject
			);	
		}

	}
	//END_CLASS

	use SubjectController as Controller;
	/**/
	if (isset($_POST["type"])) {
		date_default_timezone_set('America/Mexico_City');
		$controller = new Controller();
		if ($_POST["type"] == "insert" || $_POST["type"] == "update") {
			$params = array(
				':p1'	 => null,
				':p2'	 => strip_tags($_POST["admission"]),
				':p3'	 => strip_tags($_POST["expiration"]),
				':p4'	 => strip_tags($_POST["year"]),
				':p5'	 => strtoupper(strip_tags($_POST["reference"])),
				':p6'	 => strip_tags($_POST["request"]),
				':p7'	 => strtoupper(strip_tags($_POST["priority"])),
				':p8'	 => strip_tags($_POST["id_sender"]),
				':p9'	 => strip_tags($_POST["id_receiver"]),
				':p10' => strip_tags($_POST["amount"]),
				':p11' => strtoupper(strip_tags($_POST["subject"])),
				':p12' => strtoupper(strip_tags($_POST["indications"])),
				':p13' => $controller->getUserBySession(),
				':p14' => 0,//NOT FINISHED
				':p15' => strtoupper("En Proceso"),
				':p16' => (strip_tags($_POST["created"]) == '')?date('d/m/Y \\a \\l\\a\\s H:i:s \\h\\r\\s.'):strip_tags($_POST["created"]),
				':p17' => date('d/m/Y \\a \\l\\a\\s H:i:s \\h\\r\\s.')
			);
		}
		switch ($_POST["type"]) {
			case 'insert':
				/**/
				$fileParams = $controller->moveFile($_FILES["file"],$_POST["typeFile"],$controller->getUserBySession(),strip_tags($_POST["description_e"]));
				/**/
				if ($_POST["new_sender"] == "y") {
					$senderParams = $controller->getParamsSR($_POST["name_sender"],$_POST["job_sender"],$_POST["dependency_sender"],"1");//TYPE SENDER = 1 / RECEIVER = 2
					$params[":p8"] = $controller->newSR($senderParams);
				}
				/**/
				if ($_POST["new_receiver"] == "y") {
					$receiverParams = $controller->getParamsSR($_POST["name_receiver"],$_POST["job_receiver"],$_POST["dependency_receiver"],"2");//TYPE SENDER = 1 / RECEIVER = 2
					$params[":p9"] = $controller->newSR($receiverParams);
				}
				/**/
				$turns = $controller->getTurnParams(strip_tags($_POST["id_user"]),strip_tags($_POST["turns"]));
				/**/
      	$controller->new($params,$fileParams,$turns);
				break;
			case 'new':
				switch ($_POST["from"]) {
					case 'turns':
						$params = $controller->getTurnParams(strip_tags($_POST["id_user"]),strip_tags($_POST["turns"]));
						$controller->newTurn($params);
						break;
					case 'evidences':
						$params = $controller->moveFile($_FILES["file"],$_POST["typeFile"],$controller->getUserBySession(),strip_tags($_POST["description_e"]));
						$controller->newEvidence($params,$_POST["id"]);
						break;
					case 'finish':
						$controller->finalResponse(strtoupper(strip_tags($_POST["final_response"])),$_POST["id"]);
						break;
				}
				break;
		}
	}

	if (isset($_GET["type"])) {
		$controller = new Controller();
		switch ($_GET["type"]) {
			case "delete":
				$controller->destroy($_GET["id"],$_GET["page"]);
				break;
			case "find":
				$controller->showById($_GET["key"]);
				break;
		}
	}

	/*AJAX REQUEST*/
	if (isset($_GET["type"]) && $_GET["type"] == 'ajax') {
		$controller = new Controller();
		switch ($_GET["from"]) {
			case 'senders':
				$controller->getSendersByAjax($_POST["key"]);
				break;
			case 'receivers':
				$controller->getReceiversByAjax($_POST["key"]);
				break;
			case 'users':
				$controller->getUsersByAjax($_POST["key"],$_POST["dep"],$_POST["usr"]);
				break;
		}
	}


?>
