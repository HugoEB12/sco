<?php
	require_once($currentPath."../Models/ConnectionModel.php");
	require_once($currentPath."../Models/DependencyModel.php");
  use DependencyModel as Dependency;

	//CLASS
	class DependencyController
	{
		private $model;
		private $view;
		private $from;

		public function __construct()
		{
			$this->model = new Dependency(true,"index.php");
			$this->view  = '../Views/Admin/Dependencies/index.php';
			$this->from  = "dependency";
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

		public function showTypeDependencies()
		{
			return $this->model->findAllTypes();
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
		$controller = new DependencyController();
		if ($_POST["type"] == "insert" || $_POST["type"] == "update") {
			$params = array(
				':p1'	=> (strip_tags($_POST["id"]) == '')?null:strip_tags($_POST["id"]),
				':p2'	=> mb_strtoupper(strip_tags($_POST["name"])),
				':p3'	=> mb_strtoupper(strip_tags($_POST["principal"])),
				':p4'	=> mb_strtoupper(strip_tags($_POST["description"])),
				':p5'	=> strip_tags($_POST["type_dependency"]),
				':p6'	=> (strip_tags($_POST["created"]) == '')?date('d/m/Y \\a \\l\\a\\s H:i:s \\h\\r\\s.'):strip_tags($_POST["created"]),
				':p7' => date('d/m/Y \\a \\l\\a\\s H:i:s \\h\\r\\s.')
			);
		}
		switch ($_POST["type"]) {
			case 'insert':
				$controller->new($params,$_GET["page"]);
				break;
			case 'update':
				$controller->edit($params,$_GET["page"]);
				break;
		}
	}

	if (isset($_GET["type"])) {
		$controller = new DependencyController();
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
