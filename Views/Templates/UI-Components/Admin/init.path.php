<?php
/**/
  $dir = getcwd();
  if (strpos($dir, "\\")) {
    $folders = explode("\\",$dir);
  } else {
    $folders = explode("/",$dir);
  }
  $foldersLength = count($folders)-1;
/**/
  $active1 = $active2 = $active3 = $active4 = $active5 = $active7 =  $active8 = "";
  $link1 = $link2 = $link3 = $link4 = $link5 = $link7 = $link8 = "";
/**/
  $controllerPath = "";
/**/
  $currentFolder = $folders[$foldersLength];
/**/
  $currentSatus = "";
/**/
  $path = explode("/", $_SERVER["PHP_SELF"]);
  $baseScript = end($path);
/**/
  $currentPath = "../../";
  if ($currentFolder == "Admin"){
    $currentPath = "../";
  }
/**/
  switch ($currentFolder) {
    case 'Admin'://1
      $active1 = "link-active";
      $active2 = "";
      $active3 = "";
      $active4 = "";
      $active5 = "";
      $active7 = "";
      $active8 = "";
      //
      $link1 = ($baseScript == 'index.php')?$_SERVER["PHP_SELF"]:"index.php";
      $link2 = "Users/";
      $link3 = "Dependencies/";
      $link4 = "Employees/";
      $link5 = "Administrators/";
      $link7 = "Info/privacy-policy.php";
      $link8 = "Info/help.php";
      //
      break;
    case 'Users'://2
      $active1 = "";
      $active2 = "link-active";
      $active3 = "";
      $active4 = "";
      $active5 = "";
      $active7 = "";
      $active8 = "";
      //
      $link1 = "../";
      $link2 = ($baseScript == 'index.php')?$_SERVER["PHP_SELF"]:"index.php";
      $link3 = "../Dependencies";
      $link4 = "../Employees";
      $link5 = "../Administrators";
      $link7 = "../Info/privacy-policy.php";
      $link8 = "../Info/help.php";
      //
      $currentSatus = "> <span class=\"badge\">Usuarios del Sistema</span>";
      //
      $controllerPath = "UserController.php";
      break;
    case 'Dependencies'://3
      $active1 = "";
      $active2 = "";
      $active3 = "link-active";
      $active4 = "";
      $active5 = "";
      $active7 = "";
      $active8 = "";
      //
      $link1 = "../";
      $link2 = "../Users";
      $link3 = ($baseScript == 'index.php')?$_SERVER["PHP_SELF"]:"index.php";
      $link4 = "../Employees";
      $link5 = "../Administrators";
      $link7 = "../Info/privacy-policy.php";
      $link8 = "../Info/help.php";
      //
      $currentSatus = "> <span class=\"badge\">Dependencias</span>";
      //
      $controllerPath = "DependencyController.php";
      break;
    case 'Employees'://4
      $active1 = "";
      $active2 = "";
      $active3 = "";
      $active4 = "link-active";
      $active5 = "";
      $active7 = "";
      $active8 = "";
      //
      $link1 = "../";
      $link2 = "../Users";
      $link3 = "../Dependencies";
      $link4 = ($baseScript == 'index.php')?$_SERVER["PHP_SELF"]:"index.php";
      $link5 = "../Administrators";
      $link7 = "../Info/privacy-policy.php";
      $link8 = "../Info/help.php";
      //
      $currentSatus = "> <span class=\"badge\">Remitentes y Destinatarios.</span>";
      //
      $controllerPath = "SRController.php";
      break;
    case 'Administrators'://5
      $active1 = "";
      $active2 = "";
      $active3 = "";
      $active4 = "";
      $active5 = "link-active";
      $active7 = "";
      $active8 = "";
      //
      $link1 = "../";
      $link2 = "../Users";
      $link3 = "../Dependencies";
      $link4 = "../Employees";
      $link5 = ($baseScript == 'index.php')?$_SERVER["PHP_SELF"]:"index.php";
      $link7 = "../Info/privacy-policy.php";
      $link8 = "../Info/help.php";
      //
      $currentSatus = "> <span class=\"badge\">Administradores del Sistema</span>";
      //
      $controllerPath = "AdminController.php";
      break;
    case 'Info':
      switch ($baseScript) {
        case 'privacy-policy.php':
          $active1 = "";
          $active2 = "";
          $active3 = "";
          $active4 = "";
          $active5 = "";
          $active7 = "link-active";
          $active8 = "";
          //
          $link1 = "../";
          $link2 = "../Users";
          $link3 = "../Dependencies";
          $link4 = "../Employees";
          $link5 = "../Administrators";
          $link7 = $_SERVER["PHP_SELF"];
          $link8 = "help.php";
          //
          $currentSatus = "> <span class=\"badge\">Política de Privacidad</span>";
          break;
        case 'help.php':
          $active1 = "";
          $active2 = "";
          $active3 = "";
          $active4 = "";
          $active5 = "";
          $active7 = "";
          $active8 = "link-active";
          //
          $link1 = "../";
          $link2 = "../Users";
          $link3 = "../Dependencies";
          $link4 = "../Employees";
          $link5 = "../Administrators";
          $link7 = "privacy-policy.php";
          $link8 = $_SERVER["PHP_SELF"];
          //
          $currentSatus = "> <span class=\"badge\">Sección de Ayuda</span>";
          break;
      }
      break;
  }
  /**/
  session_start();
  error_reporting(E_ALL);
  define('ui_component',$currentPath."/Templates/UI-Components/Admin/");
  define('Assets',$currentPath."../Assets");
  define('currentScript',basename(__FILE__, '.php'));
  include_once ui_component.'verify_session.php';
  if ($controllerPath != "") {
    define('controller',$currentPath."../Controllers/".$controllerPath);
    define('formAction',$currentPath."../Controllers/".$controllerPath);
    require_once controller;
  }
  /**/

?>
