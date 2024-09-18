<?php
function FoodalFelhasznalo()
{
  $filePath = __DIR__ . "/../view/felhasznalo/FooldalFelhasznalo.php";

  if (file_exists($filePath)) {
    include_once($filePath);
  } else {
    echo "File not found " . $filePath;
  }
}

function FiokKezeles()
{
  $filePath = __DIR__ . "/../view/felhasznalo/felhasznaloFiokKezeles.php";

  if (file_exists($filePath)) {
    include_once($filePath);
  } else {
    echo "File not found " . $filePath;
  }
}
function FelhasznaloOrarendView()
{
  $filePath = __DIR__ . "/../view/felhasznalo/FooldalFelhasznalo.php";

  if (file_exists($filePath)) {
    include_once($filePath);
  } else {
    echo "File not found " . $filePath;
  }
}

function FelhasznaloFoglasView()
{
  $filePath = __DIR__ . "/../view/felhasznalo/FoglalasFelhasznalo.php";
  if (file_exists($filePath)) {
    include_once($filePath);
  } else {
    echo "File not found " . $filePath;
  }
}

function BelepesFelhasznaloView()
{
  $filePath  = __DIR__ . "/../view/Belepes.php";
  if (file_exists($filePath)) {
    include_once($filePath);
  } else {
    echo "File not found " . $filePath;
  }
}

function FelhasznaloKapcsolatView()
{
  $filePath  = __DIR__ . "/../view/felhasznalo/Kapcsolat.php";
  if (file_exists($filePath)) {
    include_once($filePath);
  } else {
    echo "File not found " . $filePath;
  }
}
function FelhasznaloArakView()
{
  $filePath  = __DIR__ . "/../view/felhasznalo/Arak.php";
  if (file_exists($filePath)) {
    include_once($filePath);
  } else {
    echo "File not found " . $filePath;
  }
}

function AbKezelo()
{
  $filePath  = __DIR__ . "/../model/ABKezelo.php";
  if (file_exists($filePath)) {
    include_once($filePath);
  } else {
    echo "File not found " . $filePath;
  }
}
session_start();

function MainFelhasznalo()
{
  if (!isset($_SESSION['user_id'])) {
    if (!isset($_GET["actionFelhasznalo"]) || $_GET["actionFelhasznalo"] !== 'belepes') {

      return BelepesFelhasznaloView();
    } else {
      return BelepesFelhasznaloView();
    }
  }

  if (isset($_GET["actionFelhasznalo"])) {
    $action = $_GET["actionFelhasznalo"];
    switch ($action) {
      case 'orarend':
        return FelhasznaloOrarendView();
      case 'fooldalFelhasznalo':
        return FoodalFelhasznalo();
      case 'foglalas':
        return FelhasznaloFoglasView();
      case "arak":
        return     FelhasznaloArakView();
      case "kapcsolat":
        return FelhasznaloKapcsolatView();
      case "fiokKezeles":
        return FiokKezeles();
      case "oraRend":
        return FelhasznaloOrarendView();
      default:
        return BelepesFelhasznaloView();
    }
  } else {

    return BelepesFelhasznaloView();
  }
}



AbKezelo();
return MainFelhasznalo();
