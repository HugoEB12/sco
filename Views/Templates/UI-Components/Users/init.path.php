<?php
  date_default_timezone_set('America/Mexico_City');
  //define('currentScript',basename(__FILE__, '.php'));
  define('currentScript',basename($_SERVER["SCRIPT_FILENAME"], '.php'));
  /**/
  $active1 = $active2 = $active3 = $active4 = $active5 = $active6 = "";
  $link1 = $link2 = $link3 = $link4 = $link5 = $link6 = "";
  /**/
  $currentSatus = "";
  /**/
  $controllerPath = "";;
  /**/
  switch (currentScript) {
    case 'index'://1
      $active1 = "link-active";
      $active2 = "";
      $active3 = "";
      $active4 = "";
      $active5 = "";
      $active6 = "";
      //
      $link1 = $_SERVER["PHP_SELF"];
      $link2 = "record.php";
      $link3 = "search.php";
      $link4 = "turns.php";
      $link5 = "privacy-policy.php";
      $link6 = "help.php";
      //
      break;
    case 'record'://2
      $active1 = "";
      $active2 = "link-active";
      $active3 = "";
      $active4 = "";
      $active5 = "";
      $active6 = "";
      //
      $link1 = "index.php";
      $link2 = $_SERVER["PHP_SELF"];
      $link3 = "search.php";
      $link4 = "turns.php";
      $link5 = "privacy-policy.php";
      $link6 = "help.php";
      //
      $currentSatus = "> <span class=\"badge\">Registro</span>";
      //
      $controllerPath = "SubjectController.php";
      break;
    case 'search'://4
      $active1 = "";
      $active2 = "";
      $active3 = "link-active";
      $active4 = "";
      $active5 = "";
      $active6 = "";
      //
      $link1 = "index.php";
      $link2 = "record.php";
      $link3 = $_SERVER["PHP_SELF"];
      $link4 = "turns.php";
      $link5 = "privacy-policy.php";
      $link6 = "help.php";
      //
      $currentSatus = "> <span class=\"badge\">Búsqueda</span>";
      //
      $controllerPath = "SubjectController.php";
      break;
    case 'view'://4
      $active1 = "";
      $active2 = "";
      $active3 = "link-active";
      $active4 = "";
      $active5 = "";
      $active6 = "";
      //
      $link1 = "index.php";
      $link2 = "record.php";
      $link3 = "search.php";
      $link4 = "turns.php";
      $link5 = "privacy-policy.php";
      $link6 = "help.php";
      //
      $currentSatus = "> <span class=\"badge\">Vista Detallada</span>";
      //
      $controllerPath = "SubjectController.php";
      break;
    case 'turns'://5
      $active1 = "";
      $active2 = "";
      $active3 = "";
      $active4 = "link-active";
      $active5 = "";
      $active6 = "";
      //
      $link1 = "index.php";
      $link2 = "record.php";
      $link3 = "search.php";
      $link4 = $_SERVER["PHP_SELF"];
      $link5 = "privacy-policy.php";
      $link6 = "help.php";
      //
      $currentSatus = "> <span class=\"badge\">Asuntos</span>";
      //
      $controllerPath = "TurnController.php";
      break;
    /**/
    case 'edit':
      $active1 = "";
      $active2 = "";
      $active3 = "link-active";
      $active4 = "";
      $active5 = "";
      $active6 = "";
      //
      $link1 = "index.php";
      $link2 = "record.php";
      $link3 = "search.php";
      $link4 = "turns.php";
      $link5 = "privacy-policy.php";
      $link6 = "help.php";
      //
      $currentSatus = "> <span class=\"badge\">Edición</span>";
      //
      $controllerPath = "SubjectController.php";
      break;
    case 'new.evidence':
      $active1 = "";
      $active2 = "";
      $active3 = "link-active";
      $active4 = "";
      $active5 = "";
      $active6 = "";
      //
      $link1 = "index.php";
      $link2 = "record.php";
      $link3 = "search.php";
      $link4 = "turns.php";
      $link5 = "privacy-policy.php";
      $link6 = "help.php";
      //
      $currentSatus = "> <span class=\"badge\">Nueva Evidencia</span>";
      //
      $controllerPath = "SubjectController.php";
      break;
    case 'new.turn':
      $active1 = "";
      $active2 = "";
      $active3 = "link-active";
      $active4 = "";
      $active5 = "";
      $active6 = "";
      //
      $link1 = "index.php";
      $link2 = "record.php";
      $link3 = "search.php";
      $link4 = "turns.php";
      $link5 = "privacy-policy.php";
      $link6 = "help.php";
      //
      $currentSatus = "> <span class=\"badge\">Nuevo Turno</span>";
      //
      $controllerPath = "SubjectController.php";
      break;
    case 'final.response':
      //
      $link1 = "index.php";
      $link2 = "record.php";
      $link3 = "search.php";
      $link4 = "turns.php";
      $link5 = "privacy-policy.php";
      $link6 = "help.php";
      //
      $currentSatus = "> <span class=\"badge\">Finalizar Asunto</span>";
      //
      $controllerPath = "SubjectController.php";
      break;
    case 'profile':
      //
      $link1 = "index.php";
      $link2 = "record.php";
      $link3 = "search.php";
      $link4 = "turns.php";
      $link5 = "privacy-policy.php";
      $link6 = "help.php";
      //
      $currentSatus = "> <span class=\"badge\">Perfil de Usuario</span>";
      //
      $controllerPath = "UserController.php";
      break;
    case 'pdf.turn.preview':
      //
      $link1 = "index.php";
      $link2 = "record.php";
      $link3 = "search.php";
      $link4 = "turns.php";
      $link5 = "privacy-policy.php";
      $link6 = "help.php";
      //
      $currentSatus = "> <span class=\"badge\">PDF Vista Previa</span>";
      //
      $controllerPath = "SubjectController.php";
      break;
    case 'privacy-policy':
      $active1 = "";
      $active2 = "";
      $active3 = "";
      $active4 = "";
      $active5 = "link-active";
      $active6 = "";
      //
      $link1 = "index.php";
      $link2 = "record.php";
      $link3 = "search.php";
      $link4 = "turns.php";
      $link5 = "privacy-policy.php";
      $link6 = "help.php";
      //
      $currentSatus = "> <span class=\"badge\">Política de Privacidad</span>";
      break;
    case 'help':
      $active1 = "";
      $active2 = "";
      $active3 = "";
      $active4 = "";
      $active5 = "";
      $active6 = "link-active";
      //
      $link1 = "index.php";
      $link2 = "record.php";
      $link3 = "search.php";
      $link4 = "turns.php";
      $link5 = "privacy-policy.php";
      $link6 = "help.php";
      //
      $currentSatus = "> <span class=\"badge\">Política de Privacidad</span>";
      break;
  }
  $currentPath = "../";
  error_reporting(E_ALL);
  session_start();
  define('ui_component',$currentPath."/Templates/UI-Components/Users/");
  define('Assets',$currentPath."../Assets");
  include_once ui_component.'verify_session.php';
  if ($controllerPath != "") {
    define('controller',$currentPath."../Controllers/".$controllerPath);
    define('formAction',$currentPath."../Controllers/".$controllerPath);
    require_once controller;
  }
?>
