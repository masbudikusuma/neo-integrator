<?php


if (isset($_GET['module'])){$act  = $_GET['module'];} else {$act=1;}
switch ($act) {
    case "logprogress":
      include "layout/js/logprogress.php";
      break;

    case "tarikdata":
      include "layout/js/tarikdata.php";
      break;
    
    case "inject":
      include "layout/js/inject.php";
      break;

    case "dict":
      include "ws/getDict.php";
      break;
    default:
      // "echo "act is not list, cek exec.php";"
  }

?>
