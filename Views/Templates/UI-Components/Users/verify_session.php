<?php

  $sessionPath = "../";

  if (!isset($_SESSION["id_user"])) {
  	echo "<script>location.replace(\"../Sessions/login.php\")</script>";

  } else {
    $inactividad = 600; // 600s = 10 minutos
    // Comprobar si $_SESSION["timeout"] está establecida
    if(isset($_SESSION["timeout_user"])){
      // Calcular el tiempo de vida de la sesión (TTL = Time To Live)
      $sessionTTL = time() - $_SESSION["timeout_user"];
      if($sessionTTL > $inactividad){
        session_start();
  			session_destroy();
  			session_commit();
        echo "<script>alert('¡Se ha cerrado la sesión por inactividad!');</script>";
        echo "<script>location.replace(\"../Sessions/login.php\")</script>";
      }
    }
    $_SESSION['timeout_user'] = time();
  }


?>
