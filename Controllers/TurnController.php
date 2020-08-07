<?php
	require_once($currentPath."../Models/ConnectionModel.php");
	require_once($currentPath."../Models/TurnModel.php");
  use TurnModel as Turn;

	//CLASS
	class TurnController
	{
		private $model;
		private $view;
		private $from;

		public function __construct()
		{
			$this->model = new Turn(true,"turns.php");
			$this->view  = '../Views/turns.php';
			$this->from  = "turn";
		}

		public function show()
		{
			return $this->model->findAll();
		}

		public function showPaginateFor($current_page,$usr)
		{
			return $this->model->paginateFor($current_page,$usr);
		}

		public function showPaginateBy($current_page,$usr)
		{
			return $this->model->paginateBy($current_page,$usr);
		}

		public function showPages()
		{
			return $this->model->getPagination()->placePagination();
		}

		public function showById($id)
		{
			return $this->model->findById($id);
		}

		public function showUser($id)
		{
			return $this->model->findUser($id)[0];
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

		public function getUserBySession()
		{
			if (session_status() == PHP_SESSION_NONE) {
				session_start();
			}
			return $_SESSION["id_user"];
		}

	}
	//END_CLASS

?>
