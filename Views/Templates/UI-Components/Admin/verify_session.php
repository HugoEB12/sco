<?php

  $sessionPath = "../../";
  if ($currentFolder == "Admin") {
    $sessionPath = "../";
  }

  if (!isset($_SESSION["id_admin"])) {
  	echo "<script>location.replace(\"".$sessionPath."Sessions/login.php\")</script>";
  } else {
    $inactividad = 600; // 600s = 10 minutos
    // Comprobar si $_SESSION["timeout"] está establecida
    if(isset($_SESSION["timeout_admin"])){
      // Calcular el tiempo de vida de la sesión (TTL = Time To Live)
      $sessionTTL = time() - $_SESSION["timeout_admin"];
      if($sessionTTL > $inactividad){
        session_start();
  			session_destroy();
  			session_commit();
        echo "<script>alert('¡Se ha cerrado la sesión por inactividad!');</script>";
        echo "<script>location.replace(\"".$sessionPath."Sessions/login.php\")</script>";
        //header("Refresh: 0, URL=../Sessions/login_admin.php");
      }
    }
    $_SESSION['timeout_admin'] = time();
}

?>
