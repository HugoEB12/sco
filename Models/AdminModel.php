<?php   
  require_once('ConnectionModel.php');
  require_once('PaginationModel.php');
  use PaginationModel as Pagination;
  /*
    Class AdminModel extends from ConnectionModel that contains all methods and connection parameters.
  */
  //CLASS_START
  class AdminModel extends ConnectionModel{
    /*ATRIBUTES*/
    private $cModel;
    private $tuples;
    private $table_name;
    private $pKey;
    private $pagination;

    /*CONSTRUCTOR*/
    /*
      @params: $pagination -> boolean value to enable/disable the pagination model.
               $view       -> used to show all pages (from pagination model).
      @return: none.
    */
    public function __construct($pagination,$view)
    {
      parent::__construct();
      if (parent::tryConnection() == false) {
        $this->redirectTo("../Templates/Error/page-500.php");
      }
      $this->cModel = parent::getConnection();
      $this->tuples = array();
      $this->table_name = "sco_administrators";
      $this->pKey = "id_admin";
      if ($pagination) {
        $this->pagination = new Pagination($view,$this->getAllRows(),10);
      }
    }

    /*
      @params: $page -> route of specific view.
      @return: none.
    */
    private function redirectTo($page)
    {
      echo "<script>setTimeout(\"location.href = '".$page."'\");</script>";
    }

    /*
      @params: $id -> record in the table.
      @return: tuple with column values.
    */
    public function findById($id)
    {
      try {
        $query = $this->cModel->prepare("SELECT * FROM ".$this->table_name." WHERE ".$this->pKey."=".$id);
        if ($query->execute()) {
          $this->tuples = $query->fetchAll(PDO::FETCH_ASSOC);
        }
        return $this->tuples[0];
      } catch (Exception $e) {
        echo '<h3 style="color: blue; font-family: Arial"> Error en: <span style="color: red;">'.__METHOD__.'</span><br> Tipo: '.$e->getMessage().'</h3>';
      }
    }

    /*
      @params: none.
      @return: all tuples in the table.
    */
    public function findAll()
    {
      try {
        $query = $this->cModel->prepare("SELECT * FROM ".$this->table_name);
        if ($query->execute()) {
          $this->tuples = $query->fetchAll(PDO::FETCH_ASSOC);
        }
        return $this->tuples;
      } catch (Exception $e) {
        echo '<h3 style="color: blue; font-family: Arial"> Error en: <span style="color: red;">'.__METHOD__.'</span><br> Tipo: '.$e->getMessage().'</h3>';
      }
    }

    /*
      @params: $current_page -> number of the current page in the view (1, ... , N).
      @return: specific number of rows given by the page size in the constructor.
    */
    public function paginate($current_page)
    {
      try {
        $this->pagination->setStart($current_page);
        $query = $this->cModel->prepare("SELECT * FROM ".$this->table_name." ORDER BY ".$this->pKey." ASC LIMIT ?,?");
        $start = $this->pagination->getStart();
        $query->bindParam(1, $start, PDO::PARAM_INT);
        $pageSize = $this->pagination->getPageSize();
        $query->bindParam(2, $pageSize, PDO::PARAM_INT);
        if ($query->execute()) {
          $this->tuples = $query->fetchAll(PDO::FETCH_ASSOC);
        }
        return $this->tuples;
      } catch (Exception $e) {
        echo '<h3 style="color: blue; font-family: Arial"> Error en: <span style="color: red;">'.__METHOD__.'</span><br> Tipo: '.$e->getMessage().'</h3>';
      }
    }

    /*
      @params: none.
      @return: paginationModel.
    */
    public function getPagination()
    {
      return $this->pagination;
    }

    /*
      @params: none.
      @return: the number of rows in the table.
    */
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
        echo '<h3 style="color: blue; font-family: Arial"> Error en: <span style="color: red;">'.__METHOD__.'</span><br> Tipo: '.$e->getMessage().'</h3>';
      }
    }

    //////////// Data Manipulation Language (DML) METHODS
    /*
      @params: $params -> associative array with all values to insert in the table, all values was validated in the   
                          specific view and controller.
      @return: $success -> boolean value to know if all data was inserted successfully.
    */
    public function insert($params) {
      $success = false;
      try {
        $stringQuery = "INSERT INTO ".$this->table_name." VALUES (:p1,:p2,:p3,:p4,:p5,:p6,:p7,:p8,:p9,:p10)";
        $query = $this->cModel->prepare($stringQuery);
        $query->execute($params);
        $success = true;
      } catch (Exception $e) {
        echo '<h3 style="color: blue; font-family: Arial"> Error en: <span style="color: red;">'.__METHOD__.'</span><br> Tipo: '.$e->getMessage().'</h3>';
      }
      return $success;
    }

    /*
      @params: $params -> associative array with all values to update in the table, all values was validated in the   
                          specific view and controller.
      @return: $success -> boolean value to know if all data was updated successfully.
    */
    public function update($params)
    {
      $success = false;
      try {
        $stringQuery = "UPDATE ".$this->table_name." set name=:p2, lname=:p3, email=:p4, password=:p5, block=:p6, block_time=:p7, block_during=:p8, created=:p9, modified=:p10 WHERE ".$this->pKey."=:p1";
        $query = $this->cModel->prepare($stringQuery);
        $query->execute($params);
        $success = true;
      } catch (Exception $e) {
        echo '<h3 style="color: blue; font-family: Arial"> Error en: <span style="color: red;">'.__METHOD__.'</span><br> Tipo: '.$e->getMessage().'</h3>';
      }
      return $success;
    }

    /*
      @params: $id -> specific id for delete in the table.
      @return: $success -> boolean value to know if the row was deleted successfully.
    */
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
        echo '<h3 style="color: blue; font-family: Arial"> Error en: <span style="color: red;">'.__METHOD__.'</span><br> Tipo: '.$e->getMessage().'</h3>';
      }
      return $success;
    }

    /*
      @params: none.
      @return: boolean value to know if all rows was deleted successfully.
    */
    public function truncate()
    {
      try {
        $this->cModel->query("TRUNCATE TABLE ".$this->table_name);
        return true;
      } catch (Exception $e) {
        echo '<h3 style="color: blue; font-family: Arial"> Error en: <span style="color: red;">'.__METHOD__.'</span><br> Tipo: '.$e->getMessage().'</h3>';
        return false;
      }
    }

    /*AJAX REQUESTS*/
    /*
      @params: $key   -> string value of email to search in the table.
               $table -> string value with the name of the table.
      @return: boolean value to know if the given email is available.
    */
    public function getAvailableEmail($key,$table)
    {
      $tuples = array();
      try {
        $stringQuery = "SELECT * FROM ".strip_tags($table)." WHERE email='".strip_tags($key)."'";
        $query = $this->cModel->prepare($stringQuery);
        if ($query->execute()) {
          $tuples = $query->fetchAll(PDO::FETCH_ASSOC);
        }
      } catch (Exception $e) {
        echo '<h3 style="color: blue; font-family: Arial"> Error en: <span style="color: red;">'.__METHOD__.'</span><br> Tipo: '.$e->getMessage().'</h3>';
      }
      return (count($tuples) > 0)?true:false;
    }

  }
  //CLASS_END

 ?>
