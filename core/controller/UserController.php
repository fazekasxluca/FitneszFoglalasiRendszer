<?php
function ABKezeloPath()
{
    $filePath = __DIR__ . "/../model/ABKezelo.php";
    if (file_exists($filePath)) {
        include_once($filePath);
    } else {
        echo "File not found" . $filePath;
    }
}

function FitneszOra()
{
    $filePath = __DIR__ . "/../model/Fitneszora.php";
    if (file_exists($filePath)) {
        include_once($filePath);
    } else {
        echo "File not found" . $filePath;
    }
}


function Felhasznalo()
{
    $filePath = __DIR__ . "/../model/FitneszFelhasznalo.php";
    if (file_exists($filePath)) {
        include_once($filePath);
    } else {
        echo "File not found" . $filePath;
    }
}

function Foglalas()
{
    $filePath = __DIR__ . "/../model/Foglalas.php";
    if (file_exists($filePath)) {
        include_once($filePath);
    } else {
        echo "File not found" . $filePath;
    }
}
Foglalas();
FitneszOra();
Felhasznalo();
ABKezeloPath();

abstract  class UserController
{

    public static function OraRendHandleRequest()
    {
        $oraMethod = $_GET['oraMethod'] ?? null;
        $allowedMethods = ['getOraRend', 'getSzabadIdoPont', 'SetFoglalas', 'getOsszesFoglalas', 'delFoglalas'];


        if ($oraMethod && in_array($oraMethod, $allowedMethods)) {
            try {
                switch ($oraMethod) {
                    case  'getOraRend':
                        $data  =  ABKezelo::FitneszOraLekerdezes();
                        echo json_encode(['status' => 'success', "data" => $data], JSON_UNESCAPED_UNICODE);
                        break;
                    case 'getSzabadIdoPont':
                        $json = file_get_contents('php://input');
                        $params = json_decode($json, true);
                        $data = self::KeresettIdoPont($params);
                        header("Content-Type: application/json");
                        echo json_encode(["status" => "success", "data" => $data], JSON_UNESCAPED_UNICODE);
                        break;
                    case 'SetFoglalas':
                        $json = file_get_contents("php://input");
                        $params = json_decode($json, true);
                        $data = self::FoglalasFelvitel($params);
                        header("Content-Type: application/json");
                        echo json_encode(['status' => 'success', "data" => $data], JSON_UNESCAPED_UNICODE);
                        break;
                    case 'getOsszesFoglalas':
                        $data = ABKezelo::FoglalasLekerdezes();
                        echo json_encode(['status' => 'success', "data" => $data], JSON_UNESCAPED_UNICODE);
                        break;
                    case 'delFoglalas':
                        $json = file_get_contents("php://input");
                        $params = json_decode($json, true);
                        $data = self::FoglalasTorles($params);
                        header("Content-Type: application/json");
                        echo json_encode(["status" => "success", "data" => $data]);
                }
            } catch (Exception $e) {
                json_encode(["status" => "error", "message" => $e->getMessage()]);
            }
        }
    }

    public static function UserHandeRequset()
    {
        $outlog = $_GET["outlog"] ?? null;
        if ($outlog === "kijelentkezes") {
            self::Kijelentkezes();
        }

        $user = $_GET["felhasznalo"] ?? null;
        if (isset($user) && $user === "modJelszo") {
            $json = file_get_contents('php://input');
            $params = json_decode($json, true);
            $data =  self::JelszoModositasFelhasznalo($params);
            header("Content-Type: application/json");
            echo json_encode(["status" => "succes", "data" => $data]);
        }
    }


    public static function JelszoModositasFelhasznalo(array $kertAdatok): int
    {
        session_start();

        $userID = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

        try {
            if (array_key_exists("jelszoRegi", $kertAdatok) && array_key_exists("ujJelszo2", $kertAdatok)) {
                $jelszoRegi = $kertAdatok["jelszoRegi"];
                $uJJelszo2 = $kertAdatok["ujJelszo2"];

                $userAdatok = ABKezelo::FelhasznaloAdatokLekerdezes();

                foreach ($userAdatok as $keresett) {
                    if ($userID === $keresett["id"]) {

                        if (!password_verify($jelszoRegi, $keresett["titkositottJelszo"])) {
                            echo json_encode(["status" => "error", "message" => "Helytelen régi jelszó"],JSON_UNESCAPED_UNICODE);
                            exit();
                        } else {
                            ABKezelo::JelszoValtoztatasFelhasznalo($userID, $uJJelszo2);
                            echo json_encode(["status" => "success", "message" => "Sikeres jelszó változtatás"],JSON_UNESCAPED_UNICODE);
                        }
                    }
                }
            }


            return $userID;
        } catch (Exception $e) {
            json_encode(["status" => "error", "message" => $e->getMessage()]);
        }
    }

    public static function KeresettIdoPont(array $kertAdatok): array
    {
        $szabadIdopont = [];

        if (array_key_exists("oraDatum", $kertAdatok) && array_key_exists("userOra", $kertAdatok)) {
            $userOra = $kertAdatok["userOra"];
            $oraDatum = $kertAdatok["oraDatum"];

            $timeStamp = strtotime($oraDatum);
            $hetNapjaAngol = date("l", $timeStamp);

            $napokMagyarul = [
                'Monday' => 'Hétfő',
                'Tuesday' => 'Kedd',
                'Wednesday' => 'Szerda',
                'Thursday' => 'Csütörtök',
                'Friday' => 'Péntek',
                'Saturday' => 'Szombat',
                'Sunday' => 'Vasárnap'
            ];

            $hetNapja = $napokMagyarul[$hetNapjaAngol];

            $aktuOraesNap = [
                "aktualisNap" => $hetNapja,
                'oraTipus' => $userOra
            ];

            $aktOrak = ABKezelo::FitneszOraLekerdezes();
            foreach ($aktOrak as $keresettIdopont) {
                if (
                    $keresettIdopont["aktualisNap"] === $aktuOraesNap["aktualisNap"] &&
                    $keresettIdopont["oraTipus"] === $aktuOraesNap["oraTipus"]
                ) {

                    $fitneszOraID = $keresettIdopont["id"];
                    $kapacitas = ABKezelo::KapacitasLekerdezes($fitneszOraID, $oraDatum);

                    if ($kapacitas > 0) {
                        $szabadIdopont[] = [
                            "oraKezdete" => $keresettIdopont["oraKezdete"],
                            "oraVege" => $keresettIdopont["oraVege"],
                            "kapacitas" => $kapacitas
                        ];
                    } elseif ($kapacitas === 0) {

                        echo json_encode(["status" => "error", "message" => "Elfogytak a szabad időpontok"]);
                    }
                }
            }
        }

        return $szabadIdopont;
    }



    public static function FoglalasFelvitel(array $kertAdatok): int
    {
        session_start();

        if (!isset($_SESSION['user_id'])) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Nincs bejelentkezett felhasználó.'
            ]);
        }

        $felhasznaloID = $_SESSION['user_id'];

        if (
            array_key_exists("oraDatum", $kertAdatok) &&
            array_key_exists("userOra", $kertAdatok) &&
            array_key_exists("szabadIdoPont", $kertAdatok)
        ) {
            $oraDatum = $kertAdatok["oraDatum"];
            $userOra = $kertAdatok["userOra"];
            $szabadIdoPont = $kertAdatok["szabadIdoPont"];

            $timeStamp = strtotime($oraDatum);
            $napokAngol = date("l", $timeStamp);
            $napokMagyar = [
                'Monday' => 'Hétfő',
                'Tuesday' => 'Kedd',
                'Wednesday' => 'Szerda',
                'Thursday' => 'Csütörtök',
                'Friday' => 'Péntek',
                'Saturday' => 'Szombat',
                'Sunday' => 'Vasárnap'
            ];
            $hetNapja = $napokMagyar[$napokAngol];

            $idoPontTomb = explode(" - ", $szabadIdoPont);
            $oraKezdete = intval($idoPontTomb[0]);
            $oraVege = intval($idoPontTomb[1]);

            $fitneszOraTomb = ABKezelo::FitneszOraLekerdezes();

            $fitneszOraID = null;
            foreach ($fitneszOraTomb as $fitneszOra) {
                if (
                    $fitneszOra["oraKezdete"] === $oraKezdete &&
                    $fitneszOra["oraVege"] === $oraVege &&
                    $fitneszOra["aktualisNap"] === $hetNapja &&
                    $fitneszOra["oraTipus"] === $userOra
                ) {
                    $fitneszOraID = $fitneszOra["id"];
                    break;
                }
            }

            if (!$fitneszOraID) {
                echo json_encode(["status" => "error", "message" => "Nem létező ID"]);
            }

            $aktdatum = date("Y-m-d");

            if ($aktdatum  > date("Y-m-d", $timeStamp)) {

                echo json_encode(["status" => "error", "message" => "Korábbi dátumra nem lehetséges a foglalás"], JSON_UNESCAPED_UNICODE);
                exit();
            } else {
                $foglalas = new Foglalas($felhasznaloID, $fitneszOraID, $oraDatum);
                ABKezelo::MentFoglalas($foglalas);
            }


            return $fitneszOraID;
        } else {
            echo json_encode(["status" => "error", "message" => "Nincs szabad hely"]);
        }
    }


    public static function FoglalasTorles(array $kertAdatok): int
    {
        session_start();
        try {
            if (!isset($_SESSION['user_id'])) {
                echo json_encode(["status" => "error", "message" => "Felhasználói azonosító hiányzik."]);
            }

            $felhasznaloID = $_SESSION['user_id'];

            if (array_key_exists("foglalasAzonosito", $kertAdatok)) {
                $foglalasAzonosito = $kertAdatok["foglalasAzonosito"];

                if ($foglalasAzonosito && $felhasznaloID) {
                    ABKezelo::FoglalasTorles($foglalasAzonosito, $felhasznaloID);
                } else {
                    echo json_encode(["status" => "error", "message" => "Hibás vagy hiányzó foglalás azonosító."]);
                }
            }

            return $foglalasAzonosito;
        } catch (Exception $e) {
            echo json_encode(["status" => "error", "message" => "Hiba történt: " . $e->getMessage()]);
        }
    }



    public static function Kijelentkezes(): void
    {
        session_start();
        if (isset($_SESSION['user_id'])) {
            session_unset();
            session_destroy();
        }
    }
}
