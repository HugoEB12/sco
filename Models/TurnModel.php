<?php   
  require_once('ConnectionModel.php');
  require_once('PaginationModel.php');
  use PaginationModel as Pagination;

  //CLASS_START
  class TurnModel extends ConnectionModel{

    private $cModel;
    private $tuples;
    private $table_name;
    private $pKey;
    private $pagination;

    /*CONSTRUCTOR*/
    public function __construct($pagination,$view)
    {
      parent::__construct();
      if (parent::tryConnection() == false) {
        $this->redirectTo("../Templates/Error/page-500.php");
      }
      $this->cModel = parent::getConnection();
      $this->tuples = array();
      $this->table_name = "sco_turns";
      $this->pKey = "id_turn";
      if ($pagination) {
        $this->pagination = new Pagination($view,$this->getAllRows(),10);
      }
    }

    private function redirectTo($page)
    {
      echo "<script>setTimeout(\"location.href = '".$page."'\");</script>";
    }

    public function findById($id)
    {
      try {
        $query = $this->cModel->prepare("SELECT * FROM ".$this->table_name." WHERE ".$this->pKey."=".$id);
        if ($query->execute()) {
          $this->tuples = $query->fetchAll(PDO::FETCH_ASSOC);
        }
        return $this->tuples;
      } catch (Exception $e) {
        echo '<h3 style="color: blue; font-family: Arial"> Error en: <span style="color: red;">'.__METHOD__.
          '</span><br> Tipo: '.$e->getMessage().'</h3>';
      }
    }

    public function findAll()
    {
      try {
        $query = $this->cModel->prepare("SELECT * FROM ".$this->table_name);
        if ($query->execute()) {
          $this->tuples = $query->fetchAll(PDO::FETCH_ASSOC);
        }
        return $this->tuples;
      } catch (Exception $e) {
        echo '<h3 style="color: blue; font-family: Arial"> Error en: <span style="color: red;">'.__METHOD__.
          '</span><br> Tipo: '.$e->getMessage().'</h3>';
      }
    }

    public function paginateFor($current_page,$usr)
    {
      try {
        $query = $this->cModel->prepare("SELECT * FROM ".$this->table_name." WHERE ".$this->table_name.".for=".$usr." ORDER BY ".$this->pKey." ASC LIMIT ?,?");
        $start = $this->pagination->getStart();
        $query->bindParam(1, $start, PDO::PARAM_INT);
        $pageSize = $this->pagination->getPageSize();
        $query->bindParam(2, $pageSize, PDO::PARAM_INT);
        if ($query->execute()) {
          $this->tuples = $query->fetchAll(PDO::FETCH_ASSOC);
          /*pagination parameters*/
          $this->pagination->setAllRows(count($this->tuples));
          $this->pagination->setStart($current_page);
        }
        return $this->tuples;
      } catch (Exception $e) {
        echo '<h3 style="color: blue; font-family: Arial"> Error en: <span style="color: red;">'.__METHOD__.
          '</span><br> Tipo: '.$e->getMessage().'</h3>';
      }
    }

    public function paginateBy($current_page,$usr)
    {
      try {
        $this->pagination->setStart($current_page);
        $query = $this->cModel->prepare("SELECT * FROM ".$this->table_name." WHERE ".$this->table_name.".by=".$usr."  ORDER BY ".$this->pKey." ASC LIMIT ?,?");
        $start = $this->pagination->getStart();
        $query->bindParam(1, $start, PDO::PARAM_INT);
        $pageSize = $this->pagination->getPageSize();
        $query->bindParam(2, $pageSize, PDO::PARAM_INT);
        if ($query->execute()) {
          $this->tuples = $query->fetchAll(PDO::FETCH_ASSOC);
          /*pagination parameters*/
          $this->pagination->setAllRows(count($this->tuples));
          $this->pagination->setStart($current_page);
        }
        return $this->tuples;
      } catch (Exception $e) {
        echo '<h3 style="color: blue; font-family: Arial"> Error en: <span style="color: red;">'.__METHOD__.
          '</span><br> Tipo: '.$e->getMessage().'</h3>';
      }
    }

    public function findUser($id)
    {
      try {
        $stringQuery = 
                       "SELECT *, sco_dependencies.name_dependency ".
                       "FROM sco_users ".
                       "INNER JOIN sco_dependencies ".
                       "WHERE sco_users.dependency = sco_dependencies.id_dependency ".
                       "AND sco_users.id_user=".$id;
        $query = $this->cModel->prepare($stringQuery);
        if ($query->execute()) {
          $this->tuples = $query->fetchAll(PDO::FETCH_ASSOC);
        }
      } catch (Exception $e) {
        echo '<h3 style="color: blue; font-family: Arial"> Error en: <span style="color: red;">'.__METHOD__.
          '</span><br> Tipo: '.$e->getMessage().'</h3>';
      }
      return $this->tuples;
    }

    public function getPagination()
    {
      return $this->pagination;
    }

    public function getAllRows()
    {
      $rows = 0;
      try {
        $query = $this->cModel->prepare("SELECT count(*) as c FROM ".$this->table_name);
        if ($query->execute()) {
          $this->tuples = $query->fetchAll(PDO::FETCH_ASSOC);
          $rows = $this->tuples[0]["c"];
        }
        return $rows;
      } catch (Exception $e) {
        echo '<h3 style="color: blue; font-family: Arial"> Error en: <span style="color: red;">'.__METHOD__.
          '</span><br> Tipo: '.$e->getMessage().'</h3>';
      }
    }

    //////////// DML METHODS
    public function insert($params) {
      try {
        $stringQuery = "INSERT INTO ".$this->table_name." VALUES (:p1,:p2,:p3,:p4,:p5,:p6,:p7,:p8)";
        $query = $this->cModel->prepare($stringQuery);
        $query->execute($params);
        return true;
      } catch (Exception $e) {
        echo '<h3 style="color: blue; font-family: Arial"> Error en: <span style="color: red;">'.__METHOD__.
          '</span><br> Tipo: '.$e->getMessage().'</h3>';
        return false;
      }
    }
    public function update($params)
    {
      $success = false;
      try {
        $stringQuery = "UPDATE ".$this->table_name." set ,,,,, WHERE ".$this->pKey."=:p1";
        $query = $this->cModel->prepare($stringQuery);
        $query->execute($params);
        $success = true;
      } catch (Exception $e) {
        echo '<h3 style="color: blue; font-family: Arial"> Error en: <span style="color: red;">'.__METHOD__.
          '</span><br> Tipo: '.$e->getMessage().'</h3>';
      }
      return $success;
    }

    public function delete($id)
    {
      $success = false;
      try {
        $sqlQuery  =  "DELETE FROM ".$this->table_name." WHERE id_admin=?";
        $statement = $this->cModel->prepare($sqlQuery);
        $statement->bindParam(1, $id, PDO::PARAM_INT);
        $statement->execute();
        if ($this->getAllRows() <= 0) {
          $this->truncate();//PARA REINICIAR EL VALOR DEL AUTO_INCREMENT
        }
        $success = true;
      } catch (Exception $e) {
        echo '<h3 style="color: blue; font-family: Arial"> Error en: <span style="color: red;">'.__METHOD__.
          '</span><br> Tipo: '.$e->getMessage().'</h3>';
      }
      return $success;
    }

    public function truncate()
    {
      try {
        $this->cModel->query("TRUNCATE TABLE ".$this->table_name);
        return true;
      } catch (Exception $e) {
        echo '<h3 style="color: blue; font-family: Arial"> Error en: <span style="color: red;">'.__METHOD__.
          '</span><br> Tipo: '.$e->getMessage().'</h3>';
        return false;
      }
    }

  }
  //CLASS_END

 ?>
