<?php
	require_once($currentPath."../Models/ConnectionModel.php");
	require_once($currentPath."../Models/UserModel.php");
  use UserModel as User;

	//CLASS
	class UserController
	{
		private $model;
		private $view;
		private $from;

		public function __construct()
		{
			$this->model = new User(true,"index.php");
			$this->view  = '../Views/Admin/Users/index.php';
			$this->from  = "user";
		}

		public function verifyDependencies()
		{
			$dependencies = $this->model->findAllDependencies();
			if (count($dependencies) <= 0) {
				echo "<script>alert('Registra primero una dependencia para agregar Usuarios(as)');</script>";
				$this->model->redirectTo("../../../Views/Admin/Dependencies/new.php",0);
			}
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

		public function showDependencies()
		{
			$dependencies = $this->model->findAllDependencies();
			return $dependencies;
		}

		public function new($params,$page)
		{
			$msg = ($this->model->insert($params))?"y":"n";
			header("Refresh: 0, URL=".$this->view."?page=".$page."&type=new&msg=".$msg."&from=".$this->from);
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

	}
	//END_CLASS

	if (isset($_POST["type"])) {
		date_default_timezone_set('America/Mexico_City');
		$controller = new UserController();
		if ($_POST["type"] == "insert" || $_POST["type"] == "update") {
			$params = array(
				':p1'	=> (strip_tags($_POST["id"]) == '')?null:strip_tags($_POST["id"]),
				':p2'	=> mb_strtoupper(strip_tags($_POST["name"])),
				':p3'	=> mb_strtoupper(strip_tags($_POST["lname"])),
				':p4'	=> strip_tags($_POST["email"]),
				':p5'	=> password_hash(strip_tags($_POST["password"]), PASSWORD_DEFAULT, array('cost' => 12)),
				':p6'	=> mb_strtoupper(strip_tags($_POST["job"])),
				':p7'	=> strip_tags($_POST["dependency"]),
				':p8'	=> (strip_tags($_POST["finish"]) == 'on')?"SI":"NO",
				':p9' => '',
				':p10' => '',
				':p11' => '',
				':p12'	=> (strip_tags($_POST["created"]) == '')?date('d/m/Y \\a \\l\\a\\s H:i:s \\h\\r\\s.'):strip_tags($_POST["created"]),
				':p13' => date('d/m/Y \\a \\l\\a\\s H:i:s \\h\\r\\s.')
			);
		}
		switch ($_POST["type"]) {
			case 'insert':
				$controller->new($params,$_GET["page"]);
				break;
			case 'update':
				$params[":p5"] = ($_POST["checkModifyPswd"] == "on")?password_hash(strip_tags($_POST["password"]), PASSWORD_DEFAULT, array('cost' => 12)):strip_tags($_POST["password"]);
				$controller->edit($params,$_GET["page"]);
				break;
		}
	}

	if (isset($_GET["type"])) {
		$controller = new UserController();
		switch ($_GET["type"]) {
			case "delete":
				$controller->destroy($_GET["id"],$_GET["page"]);
				break;
			case "find":
				$controller->showById($_GET["key"]);
				break;
		}
	}

?>
