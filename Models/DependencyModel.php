<?php   
  require_once('ConnectionModel.php');
  require_once('PaginationModel.php');
  use PaginationModel as Pagination;

  //CLASS_START
  class DependencyModel extends ConnectionModel{

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
      $this->table_name = "sco_dependencies";
      $this->pKey = "id_dependency";
      if ($pagination) {
        $this->pagination = new Pagination($view,$this->getAllRows(),40);
      }
    }

    private function redirectTo($page)
    {
      echo "<script>setTimeout(\"location.href = '".$page."'\");</script>";
    }

    public function findById($id)
    {
      try {
        $stringQuery = "SELECT ".$this->table_name.".*, sco_type_dependency.name_type ".
                       "FROM ".$this->table_name." ".
                       "INNER JOIN sco_type_dependency ".
                       "WHERE ".$this->table_name.".type_dependency = sco_type_dependency.id_type ".
                       "AND ".$this->table_name.".".$this->pKey."=".$id;
        $query = $this->cModel->prepare($stringQuery);
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

    public function paginate($current_page)
    {
      try {
        $this->pagination->setStart($current_page);
        $stringQuery = "SELECT ".$this->table_name.".*, sco_type_dependency.name_type ".
                       "FROM ".$this->table_name." ".
                       "INNER JOIN sco_type_dependency ".
                       "WHERE ".$this->table_name.".type_dependency = sco_type_dependency.id_type ".
                       "ORDER BY ".$this->pKey." ASC LIMIT ?,?";
        $query = $this->cModel->prepare($stringQuery);
        $start = $this->pagination->getStart();
        $query->bindParam(1, $start, PDO::PARAM_INT);
        $pageSize = $this->pagination->getPageSize();
        $query->bindParam(2, $pageSize, PDO::PARAM_INT);
        if ($query->execute()) {
          $this->tuples = $query->fetchAll(PDO::FETCH_ASSOC);
        }
        return $this->tuples;
      } catch (Exception $e) {
        echo '<h3 style="color: blue; font-family: Arial"> Error en: <span style="color: red;">'.__METHOD__.
          '</span><br> Tipo: '.$e->getMessage().'</h3>';
      }
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

    public function findAllTypes()
    {
      try {
        $query = $this->cModel->prepare("SELECT * FROM sco_type_dependency");
        if ($query->execute()) {
          $this->tuples = $query->fetchAll(PDO::FETCH_ASSOC);
        }
        return $this->tuples;
      } catch (Exception $e) {
        echo '<h3 style="color: blue; font-family: Arial"> Error en: <span style="color: red;">'.__METHOD__.
          '</span><br> Tipo: '.$e->getMessage().'</h3>';
      }
    }

    //////////// DML METHODS
    public function insert($params) {
      try {
        $stringQuery = "INSERT INTO ".$this->table_name." VALUES (:p1,:p2,:p3,:p4,:p5,:p6, :p7)";
        $query = $this->cModel->prepare($stringQuery);
        $query->execute($params);
        return true;
      } catch (Exception $e) {
        //echo '<h3 style="color: blue; font-family: Arial"> Error en: <span style="color: red;">'.__METHOD__.'</span><br> Tipo: '.$e->getMessage().'</h3>';
        return false;
      }
    }
    public function update($params)
    {
      $success = false;
      try {
        $stringQuery = "UPDATE ".$this->table_name." set name_dependency=:p2, principal_dependency=:p3, description_dependency=:p4, type_dependency=:p5, created=:p6, modified=:p7 WHERE ".$this->pKey."=:p1";
        $query = $this->cModel->prepare($stringQuery);
        $query->execute($params);
        $success = true;
      } catch (Exception $e) {
        //echo '<h3 style="color: blue; font-family: Arial"> Error en: <span style="color: red;">'.__METHOD__.'</span><br> Tipo: '.$e->getMessage().'</h3>';
      }
      return $success;
    }

    public function delete($id)
    {
      $success = false;
      try {
        $sqlQuery  =  "DELETE FROM ".$this->table_name." WHERE ".$this->pKey."=?";
        $statement = $this->cModel->prepare($sqlQuery);
        $statement->bindParam(1, $id, PDO::PARAM_INT);
        $statement->execute();
        if ($this->getAllRows() <= 0) {
          $this->truncate();//PARA REINICIAR EL VALOR DEL AUTO_INCREMENT
        }
        $success = true;
      } catch (Exception $e) {
        //echo '<h3 style="color: blue; font-family: Arial"> Error en: <span style="color: red;">'.__METHOD__.'</span><br> Tipo: '.$e->getMessage().'</h3>';
      }
      return $success;
    }

    public function truncate()
    {
      try {
        $this->cModel->query("TRUNCATE TABLE ".$this->table_name);
        return true;
      } catch (Exception $e) {
        //echo '<h3 style="color: blue; font-family: Arial"> Error en: <span style="color: red;">'.__METHOD__.'</span><br> Tipo: '.$e->getMessage().'</h3>';
        return false;
      }
    }

  }
  //CLASS_END

 ?>
