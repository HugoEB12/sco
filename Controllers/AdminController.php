<?php
	require_once($currentPath."../Models/ConnectionModel.php");
	require_once($currentPath."../Models/AdminModel.php");
  	use AdminModel as Administrator;

	//CLASS
	class AdminController
	{
		private $model;
		private $view;
		private $from;

		public function __construct()
		{
			$this->model = new Administrator(true,"index.php");
			$this->view  = '../Views/Admin/Administrators/index.php';
			$this->from  = "administrator";
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
			return $this->model->findById($id);
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

		/*AJAX REQUESTS*/
		public function verifyAvailableEmail($key,$from)
		{
			$table = ($from == "u")?"sco_users":"sco_administrators";
			echo $this->model->getAvailableEmail($key,$table);
		}
		/**/
	}
	//END_CLASS

	if (isset($_POST["type"])) {
		date_default_timezone_set('America/Mexico_City');
		$controller = new AdminController();
		if ($_POST["type"] == "insert" || $_POST["type"] == "update") {
			$params = array(
				':p1'	=> (strip_tags($_POST["id"]) == '')?null:strip_tags($_POST["id"]),
				':p2'	=> mb_strtoupper(strip_tags($_POST["name"])),
				':p3'	=> mb_strtoupper(strip_tags($_POST["lname"])),
				':p4'	=> strip_tags($_POST["email"]),
				':p5'	=> password_hash(strip_tags($_POST["password"]), PASSWORD_DEFAULT, array('cost' => 12)),
				':p6' => '',
				':p7' => '',
				':p8' => '',
				':p9'	=> (strip_tags($_POST["created"]) == '')?date('d/m/Y \\a \\l\\a\\s H:i:s \\h\\r\\s.'):strip_tags($_POST["created"]),
				':p10' => date('d/m/Y \\a \\l\\a\\s H:i:s \\h\\r\\s.')
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
		$controller = new AdminController();
		switch ($_GET["type"]) {
			case "delete":
				$controller->destroy($_GET["id"],$_GET["page"]);
				break;
			case "find":
				$controller->showById($_GET["key"]);
				break;
			case "ajax":
				$controller->verifyAvailableEmail($_POST["key"],$_GET["from"]);
				break;
		}
	}



?>
