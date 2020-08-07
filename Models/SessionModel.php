<?php
	date_default_timezone_set('America/Mexico_City');
	require_once('ConnectionModel.php');
  require_once('PaginationModel.php');
  use PaginationModel as Pagination;

	//CLASS_START
	class SessionModel extends ConnectionModel {

		private $cModel;
		private $tuples;
		private $table_name;
		private $pKey;
		private $conn;
		/**/
		private $containsEmail;
		private $time_remaining;

		public function __construct($pagination,$view,$admin) {
			parent::__construct();
      if (parent::tryConnection() == false) {
        $this->redirectTo("../Views/Templates/Error/page-500.php");
      }
      $this->cModel = parent::getConnection();
      $this->tuples = array();
      $this->table_name = ($admin == true)?"sco_administrators":"sco_users";
      $this->pKey = "id_user";
			/**/
			if ($pagination) {
        $this->pagination = new Pagination($view,$this->getAllRows(),10);
      }
			/**/
			$this->containsEmail = false;
			$this->time_remaining = "";
		}

		private function redirectTo($page)
    {
      /* "<script>setTimeout(\"location.href = '".$page."';\",1000);</script>";*/
      echo "<script>setTimeout(\"location.href = '".$page."'\");</script>";
    }

		/**/
		public function findEmail()
		{
			return $this->containsEmail;
		}
		public function setFindEmail($flag)
		{
			$this->containsEmail = $flag;
		}
		/**/

		public function getTimeRemaining()
		{
			return $this->time_remaining;
		}

		public function setTimeRemaining($value)
		{
			$this->time_remaining = $value;
		}

		public function findUser($email,$pass)
		{
			try {
				$query = $this->cModel->query(
					"SELECT * FROM ".$this->table_name.
					" WHERE email='".$email."' AND block='N'"
				);
				while ($rows = $query->fetch(PDO::FETCH_ASSOC)) {
					$this->tuples[] = $rows;
				}
				if (isset($this->tuples[0]) && strlen($this->tuples[0]["email"]) > 0){
					//ENCONTRÓ EL EMAIL, DESPUÉS SE VERIFICA SI LA CONTRASEÑA CORRESPONDE
					$this->setFindEmail(true);
				}
				return (isset($this->tuples[0]) && password_verify($pass, $this->tuples[0]["password"]))?true:false;
			} catch (Exception $e) {
				echo '<h3 style="color: blue; font-family: Arial"> Error en: <span style="color: red;">'.__METHOD__.
					'</span><br> Tipo: '.$e->getMessage().'</h3>';
			}
		}

		public function blockUser($email)
		{
			$queryString = "UPDATE ".$this->table_name." SET ".
			"block='Y',".
			" block_time='".date("H:i:s")."',".
			" block_during='5'".
			" WHERE email='".$email."'";
			try {
				$this->cModel->query($queryString);
				return true;
			} catch (Exception $e) {
				echo '<h3 style="color: blue; font-family: Arial"> Error en: <span style="color: red;">'.__METHOD__.
					'</span><br> Tipo: '.$e->getMessage().'</h3>';
				return false;
			}
		}

		public function isBlockedUser($email)
		{
			try {
				$query = $this->cModel->query(
					"SELECT * FROM ".$this->table_name.
					" WHERE email='".$email."'"
				);
				while ($rows = $query->fetch(PDO::FETCH_ASSOC)) {
					$this->tuples[] = $rows;
				}
				return ($this->tuples[0]["block"] == 'Y')?true:false;
			} catch (Exception $e) {
				echo '<h3 style="color: blue; font-family: Arial"> Error en: <span style="color: red;">'.__METHOD__.
					'</span><br> Tipo: '.$e->getMessage().'</h3>';
			}
		}

		public function checkTimeBlock($email)
		{
			try {
				$query = $this->cModel->query("SELECT * FROM ".$this->table_name." WHERE email='".$email."'");
				while ($rows = $query->fetch(PDO::FETCH_ASSOC)) {
					$this->tuples[] = $rows;
				}
				/**/
				list($h,$m,$s) = explode(':',$this->tuples[0]["block_time"]);
				//
				$totalMinutes = intval($m)+intval($this->tuples[0]["block_during"]);
				//
				$current = intval(date("i"));
				//
				$currentMinute = $current;
				//
				if ($totalMinutes > 59 && $currentMinute < 55){
					$currentMinute = 60 + $current;
				}
				//
				$elapsed = $totalMinutes - $currentMinute;
				//
				$this->setTimeRemaining($elapsed);
				/**/
				return ($elapsed > 0)?true:false;
				//
			} catch (Exception $e) {
				echo '<h3 style="color: blue; font-family: Arial"> Error en: <span style="color: red;">'.__METHOD__.
					'</span><br> Tipo: '.$e->getMessage().'</h3>';
			}
		}

		public function unlockUser($email)
		{
			$queryString = "UPDATE ".$this->table_name." SET ".
			"block='N', ".
			"block_time='', ".
			"block_during='' ".
			" WHERE email='".$email."'";
			try {
				$this->cModel->query($queryString);
				return true;
			} catch (Exception $e) {
				echo '<h3 style="color: blue; font-family: Arial"> Error en: <span style="color: red;">'.__METHOD__.
					'</span><br> Tipo: '.$e->getMessage().'</h3>';
				return false;
			}
		}


		public function getUser($email,$pass)
		{
			$tuples = array();
			try {
				$stringQuery =
        "SELECT ".
          "sco_users.*, ".
          "sco_dependencies.name_dependency, sco_dependencies.type_dependency as dep ".
        "FROM ".
          "sco_users ".
            "INNER JOIN ".
            "sco_dependencies ".
        "WHERE ".
          "email='".$email."' ".
        "AND ".
          "sco_users.dependency=sco_dependencies.id_dependency";
				$query = $this->cModel->prepare($stringQuery);
        if ($query->execute()) {
          $tuples = $query->fetchAll(PDO::FETCH_ASSOC);
          if (password_verify($pass,$tuples[0]["password"])) {
						return $tuples[0];
					}
        }
			} catch (Exception $e) {
				echo '<p style="color: red">'.$e->getMessage().'</p>';
			}
		}

		public function getAdmin($email,$pass)
		{
			$tuples = array();
			try {
				$stringQuery =
        "SELECT * FROM ".$this->table_name." WHERE email='".$email."'";
				$query = $this->cModel->prepare($stringQuery);
        if ($query->execute()) {
          $tuples = $query->fetchAll(PDO::FETCH_ASSOC);
          if (password_verify($pass,$tuples[0]["password"])) {
						return $tuples[0];
					}
        }
			} catch (Exception $e) {
				echo '<p style="color: red">'.$e->getMessage().'</p>';
			}
		}
/*
SELECT
	sco_users.id_user,sco_users.name,sco_users.lname,sco_users.job,sco_users.dependency,
	sco_dependencies.name_dependency, sco_dependencies.type_dependency as dep
FROM
	sco_users
		INNER JOIN
    sco_dependencies
WHERE
	email="hugo@hotmail"
AND
	sco_users.dependency=sco_dependencies.id_dependency
*/
	}
	//CLASS_END

?>
