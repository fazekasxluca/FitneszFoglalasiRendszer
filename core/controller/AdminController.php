<?php


function ABBetoltes()
{
    $filePath = __DIR__ . "/../model/ABKezelo.php";
    if (file_exists($filePath)) {
        include_once($filePath);
    } else {
        echo "File not found: " . $filePath;
    }
}

ABBetoltes();

abstract class AdminController
{
    public static function HandleRequest()
    {
        $method = $_GET['method'] ?? null;
        $allowedMethods = ['getFitneszOra', 'setFitneszOra', 'modFitneszOra', 'delFitneszOra'];

        if ($method && in_array($method, $allowedMethods)) {
            try {
                switch ($method) {
                    case 'getFitneszOra':
                        $data = ABKezelo::FitneszOraLekerdezes();
                        echo json_encode(['status' => 'success', "data" => $data], JSON_UNESCAPED_UNICODE);
                        break;

                    case 'setFitneszOra':
                        $input = file_get_contents('php://input');
                        $params = json_decode($input, true);
                        self::FitneszOraFelvitel($params);
                        $frissitettÓra =  ABKezelo::FitneszOraLekerdezes();
                        header("Content-Type: application/json");
                        echo json_encode(['status' => 'success', 'data' => $frissitettÓra], JSON_UNESCAPED_UNICODE);
                        break;

                    case 'modFitneszOra':
                        $input = file_get_contents('php://input');
                        $params = json_decode($input, true);
                        $result = self::fitneszOraModositas($params);
                        header("Content-Type: application/json");
                        echo json_encode(["status" => "success", "data" => $result],JSON_UNESCAPED_UNICODE);
                        break;

                    case 'delFitneszOra':
                        $input = file_get_contents('php://input');
                        $params = json_decode($input, true);
                        $result = self::fitneszOraTorles($params);
                        header('Content-Type: application/json');
                        echo json_encode(["status" => "success", 'data' => $result]);

                        break;

                    default:
                        echo json_encode(['status' => 'error', 'message' => 'Invalid method']);
                        break;
                }
            } catch (Exception $e) {
                echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
            }
        }
    }

    public static function FoglalasHandleRequest()
    {
        try {
            $method = $_GET['foglalas'] ?? null;
            if ($method === "getFoglalas") {
                $data = ABKezelo::FoglalasAdatokLekerdezesAdmin();
                echo json_encode(["status" => "success", "data" => $data], JSON_UNESCAPED_UNICODE);
            } else {
                if ($method === "modKapacitas") {
                    $json = file_get_contents("php://input");
                    $params = json_decode($json, true);
                    $data = self::VisszaallitKapacitasAdmin($params);
                    header('Content-Type: application/json');
                    echo json_encode(["status" => "success", "data" => $data]);
                }
            }
        } catch (Exception $e) {
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
    }

 

    public static function AdminHandleRequest()
    {

        $outlog = $_GET["outlog"] ?? null;
        if (isset($outlog)  &&  $outlog === "kijelentkezes") {
            self::Kijelentkezes();
        }

        $admin = $_GET["admin"] ?? null;
        if (isset($admin) &&  $admin  === "setAdmin") {
            $json = file_get_contents('php://input');
            $params = json_decode($json, true);
            $data =  self::UjAdminFelvitel($params);
            header("Content-Type: application/json");
            echo json_encode(["status" => "succes", "data" => $data]);
        }
        if (isset($admin) && $admin === "modJelszo") {
            $json = file_get_contents('php://input');
            $params = json_decode($json, true);
            $data =  self::JelszoModositasAdmin($params);
            header("Content-Type: application/json");
            echo json_encode(["status" => "succes", "data" => $data]);
        }
    }

    public static function JelszoModositasAdmin(array $kertAdatok): int
    {
        session_start();
      
        $adminID = isset($_SESSION['admin_id']) ? $_SESSION['admin_id'] : null;
    
        try {
            if (array_key_exists("jelszoRegi", $kertAdatok) && array_key_exists("ujJelszo2", $kertAdatok)) {
                $jelszoRegi = $kertAdatok["jelszoRegi"];
                $uJJelszo2 = $kertAdatok["ujJelszo2"];
    
                $adminAdatok = ABKezelo::AdminAdatokLekerdezes();
    
                foreach ($adminAdatok as $keresett) {
                    if($adminID === $keresett["id"] && $jelszoRegi === "admin1234567")
                    {
                     $tikositottJelszo =   password_hash($uJJelszo2,PASSWORD_DEFAULT);
                        ABKezelo::JelszoValtoztatasAdmin($adminID, $tikositottJelszo);
                    }
                    if ($adminID === $keresett["id"] && password_verify($jelszoRegi, $keresett["jelszo"])) {
                      
                      
                        ABKezelo::JelszoValtoztatasAdmin($adminID, $uJJelszo2);
                    }
                }
            }
    
         
            return $adminID;
        } catch (Exception $e) {
             json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
    }
    
    public static function UjAdminFelvitel(array $kertAdatok): array
    {
        try {

            $adminAdatok = [];
            if (array_key_exists("adminfNev", $kertAdatok) &&  array_key_exists("adminEmail", $kertAdatok) && array_key_exists("adminJelszo", $kertAdatok)) {
                $adminfNev = $kertAdatok["adminfNev"];
                $adminEmail = $kertAdatok["adminEmail"];
                $adminJelszo = $kertAdatok["adminJelszo"];

                $adminAdatok = [

                    "felhasznaloNev" => $adminfNev,
                    "email" => $adminEmail,
                    "jelszo" => $adminJelszo
                ];
            }
            ABKezelo::UjAdminFiokHozzaAdas($adminAdatok);

            return $adminAdatok;
        } catch (Exception $e) {
            echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
    }

    public static function FitneszOraFelvitel(array $kertAdatok): void
    {
        try {

            $vartKulcsok = array("oraTipus", "oraKezdes", "oraVege", "nap");
            $kulcsok = array_keys($kertAdatok);
            $felvittAdatok = array();


            foreach ($vartKulcsok as $kulcsok) {
                if (!in_array($kulcsok, $vartKulcsok)) {
                    break;
                } else {
                    $felvittAdatok[$kulcsok] = $kertAdatok[$kulcsok];
                    if (isset($felvittAdatok["oraTipus"], $felvittAdatok["oraKezdes"], $felvittAdatok["oraVege"], $felvittAdatok["nap"])) {

                        ABKezelo::FitneszOraFelvitel($felvittAdatok);
                    }
                }
            }
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
        }
    }
    public static function fitneszOraModositas(array $kertAdatok): array
    {
        try {
            if (isset($kertAdatok["oraTipus"], $kertAdatok["oraKezdes"], $kertAdatok["oraVege"], $kertAdatok["nap"])) {

                $lekerdezettOraSorok = ABKezelo::FitneszOraLekerdezes();
                $modositandoId = null;

                foreach ($lekerdezettOraSorok as $lekerdezettSor) {
                    if (
                        isset($lekerdezettSor["aktualisNap"]) && $lekerdezettSor["aktualisNap"] == $kertAdatok["nap"] &&
                        isset($lekerdezettSor["oraKezdete"]) && intval($lekerdezettSor["oraKezdete"]) == $kertAdatok["oraKezdes"] &&
                        isset($lekerdezettSor["oraVege"]) && intval($lekerdezettSor["oraVege"]) == $kertAdatok["oraVege"] &&
                        isset($lekerdezettSor["oraTipus"]) && $lekerdezettSor["oraTipus"] == $kertAdatok["oraTipus"]
                    ) {
                        $ujAdatok = [
                            "aktualisNap" => $kertAdatok["napMod"],
                            "oraKezdete" => $kertAdatok["oraKezdesMod"],
                            "oraVege" => $kertAdatok["oraVegeMod"],
                            "oraTipus" => $kertAdatok["oraTipusMod"]
                        ];

                        $modositandoId = intval($lekerdezettSor["id"]);

                        if ($modositandoId !== null) {


                            ABKezelo::FitneszOraFrissites($modositandoId, $ujAdatok);


                            return $ujAdatok;
                        } else {
                            echo json_encode(['status' => 'error', 'message' => "Nem található valid ID"]);
                        }
                    }
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Hiányzó adatok']);
            }
        } catch (Exception $e) {

            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }




    public static function fitneszOraTorles(array $kertAdatok): int
    {
        try {
            $lekerdezettOraSorok = ABKezelo::FitneszOraLekerdezes();
            $torolniKivantId = null;
            foreach ($lekerdezettOraSorok as $lekerdezettSor) {


                if (
                    isset($lekerdezettSor["aktualisNap"]) && $lekerdezettSor["aktualisNap"] == $kertAdatok["nap"] &&
                    isset($lekerdezettSor["oraKezdete"]) && intval($lekerdezettSor["oraKezdete"]) == $kertAdatok["oraKezdes"] &&
                    isset($lekerdezettSor["oraVege"]) && intval($lekerdezettSor["oraVege"]) == $kertAdatok["oraVege"] &&
                    isset($lekerdezettSor["oraTipus"]) && $lekerdezettSor["oraTipus"] == $kertAdatok["oraTipus"]
                ) {

                    $torolniKivantId = intval($lekerdezettSor["id"]);
                    break;
                }
            }
            if ($torolniKivantId !== null) {
                ABKezelo::FitneszOraTorles($torolniKivantId);


                return $torolniKivantId;
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Nem található ID']);
            }
        } catch (Exception $e) {

            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public static function VisszaallitKapacitasAdmin(array $kertAdat): array
    {

        try {

            if (array_key_exists("oraAzonosito", $kertAdat) && array_key_exists("felhasznaloID", $kertAdat) && array_key_exists("foglalasID", $kertAdat)) {
                $oraAzonosito = $kertAdat["oraAzonosito"];
                $id = $kertAdat["felhasznaloID"];
                $foglalasID = $kertAdat["foglalasID"];
               

                    ABKezelo::FoglalasTorles($foglalasID, $id);

              
            }

            return [$oraAzonosito, $id, $foglalasID];
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => 'Hiba történt: ' . $e->getMessage()]);
        }
    }


    public static function Kijelentkezes(): void
    {
        session_start();
        if (isset($_SESSION['admin_id'])) {
            session_unset();
            session_destroy();
        }
    }
}
