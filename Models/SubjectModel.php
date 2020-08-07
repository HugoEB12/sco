<?php
  require_once('ConnectionModel.php');
  require_once('PaginationModel.php');
  use PaginationModel as Pagination;

  //CLASS_START
  class SubjectModel extends ConnectionModel{

    private $cModel;
    private $tuples;
    private $table_name;
    private $pKey;
    private $pagination;
    /**/
    private $lastInsertId;

    /*CONSTRUCTOR*/
    public function __construct($pagination,$view)
    {
      parent::__construct();
      if (parent::tryConnection() == false) {
        $this->redirectTo("../Templates/Error/page-500.php");
      }
      $this->cModel = parent::getConnection();
      $this->tuples = array();
      $this->table_name = "sco_subjects";
      $this->pKey = "id_subject";
      if ($pagination) {
        $this->pagination = new Pagination($view,$this->getAllRows(),10);
      }
    }

    public function redirectTo($page)
    {
      echo "<script>setTimeout(\"location.href = '".$page."'\");</script>";
    }

    public function findById($id)//FIND SUBJECT BY ID WITH ALL RELATIONS
    {
      try {
        $stringQuery =
          "SELECT DISTINCT sco_subjects.*, ".
            "GROUP_CONCAT(sco_evidences.path,'#',sco_evidences.name,'#', sco_evidences.description,'#', sco_evidences.uploaded,'#', sco_evidences.created SEPARATOR '$') ".
            "AS evidences ".
          "FROM sco_subjects ".
          "INNER JOIN sco_subject_evidence as se ".
            "ON se.id_subject = sco_subjects.id_subject ".
          "INNER JOIN sco_evidences ".
            "ON se.id_evidence = sco_evidences.id_evidence ".
          "WHERE sco_subjects.id_subject=".$id;
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

    public function findSenderReceiver($id,$type)
    {
      try {
        $stringQuery = "SELECT * FROM sco_sender_receiver WHERE id=".$id." AND type='".$type."'";
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

    public function findTurns($id)
    {
      try{
        $stringQuery =
        "SELECT *
          FROM sco_turns as t
          WHERE t.subject=".$id;
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
        $stringQuery = "SELECT * FROM ".$this->table_name." ORDER BY ".$this->pKey." ASC LIMIT ?,?";
        $query = $this->cModel->prepare($stringQuery);
        $start = $this->pagination->getStart();
        $query->bindParam(1, $start, PDO::PARAM_INT);
        $pageSize = $this->pagination->getPageSize();
        $query->bindParam(2, $pageSize, PDO::PARAM_INT);
        if ($query->execute()) {
          $this->tuples = $query->fetchAll(PDO::FETCH_ASSOC);
          $this->pagination->setStart($current_page);
        }
        return $this->tuples;
      } catch (Exception $e) {
        echo '<h3 style="color: blue; font-family: Arial"> Error en: <span style="color: red;">'.__METHOD__.
          '</span><br> Tipo: '.$e->getMessage().'</h3>';
      }
    }
/**/
    public function search($whereString,$current_page,$user)
    {
      try{
        $stringQuery = "SELECT * FROM ".$this->table_name." {$whereString} AND ".$this->table_name.".by=".$user." ORDER BY ".$this->pKey." ASC LIMIT ?,?";
        $query = $this->cModel->prepare($stringQuery);
        $start = $this->pagination->getStart();
        $query->bindParam(1, $start, PDO::PARAM_INT);
        $pageSize = $this->pagination->getPageSize();
        $query->bindParam(2, $pageSize, PDO::PARAM_INT);
        if ($query->execute()) {
          $this->tuples = $query->fetchAll(PDO::FETCH_ASSOC);
          $this->pagination->setStart($current_page);
        }
        return $this->tuples;
      } catch (Exception $e) {
        echo '<h3 style="color: blue; font-family: Arial"> Error en: <span style="color: red;">'.__METHOD__.
          '</span><br> Tipo: '.$e->getMessage().'</h3>';
      }
    }

    public function paginateByUser($current_page,$user)
    {
      try {
        $stringQuery = "SELECT * FROM ".$this->table_name." WHERE ".$this->table_name.".by=".$user." ORDER BY ".$this->pKey." ASC LIMIT ?,?";
        $query = $this->cModel->prepare($stringQuery);
        $start = $this->pagination->getStart();
        $query->bindParam(1, $start, PDO::PARAM_INT);
        $pageSize = $this->pagination->getPageSize();
        $query->bindParam(2, $pageSize, PDO::PARAM_INT);
        if ($query->execute()) {
          $this->tuples = $query->fetchAll(PDO::FETCH_ASSOC);
          $this->pagination->setStart($current_page);
        }
        return $this->tuples;
      } catch (Exception $e) {
        echo '<h3 style="color: blue; font-family: Arial"> Error en: <span style="color: red;">'.__METHOD__.
          '</span><br> Tipo: '.$e->getMessage().'</h3>';
      }
    }

/**/

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

    public function insertSenderReceiver($params)
    {
      $id = "";
      try {
        $this->cModel->beginTransaction();
        $query = $this->cModel->prepare("INSERT INTO sco_sender_receiver VALUES(:p1,:p2,:p3,:p4,:p5,:p6,:p7)");
        if ($query->execute($params)) {
          $id = $this->cModel->lastInsertId();
        } else {
          $this->cModel->rollBack();
        }
        $this->cModel->commit();
      } catch (Exception $e) {
        echo '<h3 style="color: blue; font-family: Arial"> Error en: <span style="color: red;">'.__METHOD__.
          '</span><br> Tipo: '.$e->getMessage().'</h3>';
      }
      return $id;
    }

    //////////// DML METHODS---->$user,$params,$fileParams,$turn
    public function insert($paramsSubject,$paramsEvidence,$paramsTurns) {
      $success = true;
      try {
        $this->cModel->beginTransaction();
        /*INSERT SUBJECT*/
        $query = $this->cModel->prepare("INSERT INTO ".$this->table_name." VALUES (:p1,:p2,:p3,:p4,:p5,:p6,:p7,:p8,:p9,:p10,:p11,:p12,:p13,:p14,:p15,:p16,:p17)");
        if (!$query->execute($paramsSubject)){
          $this->cModel->rollBack();
          $success = false;
        }
        $subject = $this->lastInsertId = $this->cModel->lastInsertId();//LAST RECORD INSERTED
        /*INSERT EVIDENCE*/
        $query = $this->cModel->prepare("INSERT INTO sco_evidences VALUES (:p1,:p2,:p3,:p4,:p5,:p6,:p7,:p8)");
        if (!$query->execute($paramsEvidence)){
          $this->cModel->rollBack();
          $success = false;
        }
        $evidence = $this->cModel->lastInsertId();//LAST RECORD INSERTED
        /*RELATION MANY TO MANY*/
        $query = $this->cModel->prepare("INSERT INTO sco_subject_evidence VALUES (:p1,:p2)");
        if (!$query->execute(array(":p1" => $subject, ":p2" => $evidence))){
          $this->cModel->rollBack();
          $success = false;
        }
        /*INSERT TURNS */
        for ($i = 0; $i < count($paramsTurns); $i++) {
          $query = $this->cModel->prepare("INSERT INTO sco_turns VALUES (:p1,:p2,:p3,:p4,:p5)");
          $turn = $paramsTurns[$i];
          $turn[":p2"] = $subject;
          if (!$query->execute($turn)){
            $this->cModel->rollBack();
            $success = false;
          }
        }
        /**/
        if ($success) {
          $this->cModel->commit();
        }
        /**/
      } catch (Exception $e) {
        echo '<h3 style="color: blue; font-family: Arial"> Error en: <span style="color: red;">'.__METHOD__.
          '</span><br> Tipo: '.$e->getMessage().'</h3>';
        $success = false;
      }
      return $success;
    }

    public function getLasInsertId()
    {
      return $this->lastInsertId;
    }

    public function insertTurn($params)
    {
      $success = true;
      try {
        $this->cModel->beginTransaction();
        /**/
        for ($i = 0; $i < count($params); $i++) {
          $query = $this->cModel->prepare("INSERT INTO sco_turns VALUES (:p1,:p2,:p3,:p4,:p5)");
          if (!$query->execute($params[$i])){
            $this->cModel->rollBack();
            $success = false;
          }
        }
        /**/
        if ($success) {
          $this->lastInsertId = $params[0][":p2"];
          $this->cModel->commit();
        }
        /**/
      } catch (Exception $e) {
        echo '<h3 style="color: blue; font-family: Arial"> Error en: <span style="color: red;">'.__METHOD__.
          '</span><br> Tipo: '.$e->getMessage().'</h3>';
        $success = false;
      }
      return $success;
    }

    public function insertEvidence($params,$subject)
    {
      $success = true;
      try {
        $this->cModel->beginTransaction();
        /**/
        $query = $this->cModel->prepare("INSERT INTO sco_evidences VALUES (:p1,:p2,:p3,:p4,:p5,:p6,:p7,:p8)");
        if (!$query->execute($params)){
          $this->cModel->rollBack();
          $success = false;
        }
        $evidence = $this->cModel->lastInsertId();//LAST RECORD INSERTED
        /*RELATION MANY TO MANY*/
        $query = $this->cModel->prepare("INSERT INTO sco_subject_evidence VALUES (:p1,:p2)");
        if (!$query->execute(array(":p1" => $subject, ":p2" => $evidence))){
          $this->cModel->rollBack();
          $success = false;
        }
        /**/
        if ($success) {
          $this->cModel->commit();
        }
        /**/
      } catch (Exception $e) {
        echo '<h3 style="color: blue; font-family: Arial"> Error en: <span style="color: red;">'.__METHOD__.
          '</span><br> Tipo: '.$e->getMessage().'</h3>';
        $success = false;
      }
      return $success;
    }

//SELECT COUNT(*) FROM `sco_turns` WHERE sco_turns.for=2 AND sco_turns.subject=12
    public function update($params)
    {
      $success = false;
      try {
        $stringQuery = "UPDATE ".$this->table_name." set name=:p2, lname=:p3, email=:p4, alias=:p5, password=:p6, job=:p7, dependency=:p8, finish=:p9, created=:p10, modified=:p11 WHERE ".$this->pKey."=:p1";
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
        $sqlQuery  =  "DELETE FROM ".$this->table_name." WHERE ".$this->pKey."=?";
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

    /*AJAX METHODS*/
    /*
    public function getSuggestions($key,$table,$field)
    {
      $tuples = array();
      try {
        $query = $this->cModel->prepare('SELECT * FROM '.$table.' WHERE '.$field.' LIKE "%'.strip_tags($key).'%"');
        if ($query->execute()) {
          $tuples = $query->fetchAll(PDO::FETCH_ASSOC);
        }
        return $tuples;
      } catch (Exception $e) {
        echo '<h3 style="color: blue; font-family: Arial"> Error en: <span style="color: red;">'.__METHOD__.
          '</span><br> Tipo: '.$e->getMessage().'</h3>';
      }
    }
    /*MEHTOD FOR CONTROLLER*/
    /*
    public function getReceiversByAjax($key)
    {
      $tuples = $this->model->getSuggestions($key,"sco_receivers","name");
      if (count($tuples) > 0) {
        $res .= '<div class="list_receivers">';
        foreach ($tuples as $row) {
          $res .=
          '<a class="link link-outline-default suggest-element receiver" id="receiver'.$row['id'].'" data="'.$row['name'].'" job="'.$row["job"].'" dependency="'.$row["dependency"].'">'
              .$row['name'].
            '</a>';
        }
        $res .= '</div>';
      } else {
        $res .= '<span>No hay resultados que coincidan</span>';
      }
      echo $res;
    }
    */
    /**/

    /*AJAX METHODS*/
    public function getSuggestions($key,$type)
    {
      $tuples = array();
      try {
        $stringQuery =
          "SELECT * FROM sco_sender_receiver ".
          "WHERE name LIKE '%".strip_tags($key)."%' ".
          "AND type='".strip_tags($type)."'"
        ;
        /**/
        $query = $this->cModel->query($stringQuery);
        /**/
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
          $tuples[] = array(
            "value"=>$row['id'],
            "label"=>$row['name'],
            "job"  =>$row['job'],
            "dependency"=>$row["dependency"]
          );
        }
        /**/
        return json_encode($tuples);
      } catch (Exception $e) {
        echo '<h3 style="color: blue; font-family: Arial"> Error en: <span style="color: red;">'.__METHOD__.
          '</span><br> Tipo: '.$e->getMessage().'</h3>';
      }
    }

    public function getSuggestionsUsers($key,$dep,$usr)
    {
      $tuples = array();
      try {
        $stringQuery =
        "SELECT sco_users.id_user,sco_users.name,sco_users.lname,sco_users.job,sco_users.dependency,sco_dependencies.name_dependency ".
        "FROM sco_users INNER JOIN sco_dependencies ".
        "WHERE MATCH (name,lname) AGAINST('".$key."') AND ".
        "sco_users.dependency=sco_dependencies.id_dependency ".
        "AND sco_dependencies.type_dependency >= ".$dep." AND sco_dependencies.type_dependency <= 4 ".
        "AND sco_users.id_user != ".$usr
        ;
        /**/
        $query = $this->cModel->prepare($stringQuery);
        $query->bindParam(1, $usr, PDO::PARAM_INT);
        if ($query->execute()) {
          while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $tuples[] = array(
              "value"     =>$row['id_user'],
              "label"     =>$row['name']." ".$row['lname'],
              "job"       =>$row['job'],
              "dependency"=>$row["name_dependency"]
            );
          }
        }

        /**/
        return json_encode($tuples);
      } catch (Exception $e) {
        echo '<h3 style="color: blue; font-family: Arial"> Error en: <span style="color: red;">'.__METHOD__.
          '</span><br> Tipo: '.$e->getMessage().'</h3>';
      }
    }

    public function finishSubject($response,$id)
    {
      $success = false;
      try {
        $stringQuery = "UPDATE ".$this->table_name." set final_response=:response, finish=1 WHERE ".$this->pKey."=:id";
        $query = $this->cModel->prepare($stringQuery);
        $query->bindParam(':response', $response, PDO::PARAM_STR, 80);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute($params);
        $success = true;
      } catch (Exception $e) {
        echo '<h3 style="color: blue; font-family: Arial"> Error en: <span style="color: red;">'.__METHOD__.
          '</span><br> Tipo: '.$e->getMessage().'</h3>';
      }
      return $success;
    }

  }
  //CLASS_END

 ?>
