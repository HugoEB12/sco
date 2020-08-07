<?php
	
	/*
		Class used to establish a connection with MySQL server
		through the parameters file: "database.parameters.config".

		Don´t modify/remove the config file.
		
	*/
	//START_CLASS
	class ConnectionModel {

		//ATRIBUTES
		private $host;
		private $db;
		private $user;
		private $pass;
		private $connect;

		//CONSTRUCTOR
		/*
			@param: none.
		*/
		public function __construct()
		{
			$this->connect = null;
			$this->initDatabaseParameters();
		}

		//METHODS
		/*
			@params: none.
			@return: none.
		*/
		public function initDatabaseParameters()
		{
			$fileName = dirname(__DIR__)."/Config/database.config.xml";
			//$fileName = "../Config/database.config.xml";
			try {
				$xml = simplexml_load_file($fileName);
				$listParameters = $xml->connection;
				$this->host = $listParameters->host;
				$this->db   = $listParameters->name;
				$this->user = $listParameters->user;
				$this->pass = $listParameters->password;
			} catch (Exception $e) {
				$this->showMessage("Error en: ".__METHOD__."<br>Tipo: ".$e->getMessage());
			}
			
		}

		/*
			@params: none.
			@return: value of connection.
		*/
		public function getConnection()
		{
			return $this->connect;
		}

		/*
			@params: none.
			@return: boolean value specifying if connection was made successfully.
		*/
		public function tryConnection()
		{
			$success = false;
			try {
				$this->connect = new PDO('mysql:host='.$this->host.'; dbname='.$this->db,$this->user,$this->pass);
				$this->connect->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
				$this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$this->connect->exec("SET CHARACTER SET UTF8");
				//$this->showMessage("¡Conexión Exitosa!");
				$success = true;
			} catch (PDOException $e) {
				$this->showMessage("Error en: ".__METHOD__."<br>Tipo: ".$e->getMessage());
			}
			return $success;
		}

		/*
			@params: none.
			@return: none.
		*/
		public function closeConnection()
		{
			$this->connect = null;
		}

		/*
			@param:
				$msg  -> string content.
			@return: none.
		*/
		private function showMessage($msg)
		{
			echo '<br>'.
					 '<hr>'.
					 '<h3 style="color: #8388a4; font-family: Arial">'.
					 		'Mensaje:<br>'.
					 		'<span style="color: #d36868;">'.$msg.'</span>'.
					 '</h3>'.
					 '<hr>';
		}

	}
	//CLASS_END


	//TESTING DATABASE CONNECTION
	//$cm = new ConnectionModel();
	//$cm->tryConnection();
	//$cm->closeConnection();


 ?>
