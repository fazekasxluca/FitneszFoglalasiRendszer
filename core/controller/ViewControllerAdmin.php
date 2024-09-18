<?php

session_start();

function FooldalAdminView()
{
    $filePath = __DIR__ . "/../view/admin/FooldalAdmin.php";
    if (file_exists($filePath)) {
        include_once($filePath);
    } else {
        echo "File not found: " . $filePath;
    }
}

function FitneszoraKezelesView()
{
    $filePath = __DIR__ . "/../view/admin/fitneszOraKezeles.php";
    if (file_exists($filePath)) {
        include_once($filePath);
    } else {
        echo "File not found: " . $filePath;
    }
}

function BelepesAdminView()
{
    $filePath = __DIR__ . "/../view/Belepes.php";
    if (file_exists($filePath)) {
        include_once($filePath);
    } else {
        echo "File not found: " . $filePath;
    }
}

function FoglalasAdminView()
{
    $filePath = __DIR__ . "/../view/admin/foglalasMegtekintes.php";
    if (file_exists($filePath)) {
        include_once($filePath);
    } else {
        echo "File not found: " . $filePath;
    }
}


function AdminFiokView()
{
    $filePath = __DIR__ . "/../view/admin/adminFiokKezeles.php";
    if (file_exists($filePath)) {
        include_once($filePath);
    } else {
        echo "File not found: " . $filePath;
    }
}

function AbKezelo()
{
    $filePath = __DIR__ . "/../model/ABKezelo.php";
    if (file_exists($filePath)) {
        include_once($filePath);
    } else {
        echo "File not found: " . $filePath;
    }
}


function MainAdmin() {


      if (!isset($_SESSION['admin_id'])) {
        if (!isset($_GET["actionAdmin"]) || $_GET["actionAdmin"] !== 'belepes') {
            return BelepesAdminView();
        } else {
            return BelepesAdminView();
        }
    }

    if (isset($_GET["actionAdmin"])) {
        $action = $_GET["actionAdmin"];
        switch ($action) {
            case 'fitneszOraKezeles':
                return FitneszoraKezelesView();
            case 'fooldalAdmin':
                return FooldalAdminView();
            case 'foglalasok':
                return FoglalasAdminView();
                case 'adminFiokokKezeles':
                    return AdminFiokView();
            default:
 
                return BelepesAdminView();
        }
    } else {
        return BelepesAdminView();
    }
  }
AbKezelo();
return MainAdmin();
