<?php
require_once __DIR__ . "/../model/FitneszOra.php";
require_once __DIR__ . "/../model/FitneszFelhasznalo.php";
require_once __DIR__ . "/../model/Felhasznalo.php";
require_once __DIR__ . "/../model/Admin.php";

abstract class ABKezelo
{

    public static function Regisztracio(): void
    {

        try {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (array_key_exists("nev", $_POST) &&  array_key_exists("jelszo", $_POST) && array_key_exists("email", $_POST)) {
                    $nev = $_POST["nev"];
                    $jelszo = $_POST["jelszo"];
                    $email = $_POST["email"];

                    $titkositottJelszo = password_hash($jelszo, PASSWORD_DEFAULT);

                    $felhasznalo = new FitneszFelhasznalo($nev, $email, $titkositottJelszo);
                    $jogosultsag =  $felhasznalo->GetJogosultsag();
                    $con  = new mysqli("127.0.0.1", "root", "", "fitfoglalo");
                    $stmt = $con->prepare("INSERT INTO `Felhasznalo`(`felhasznaloNev`, `email`, `jelszo`,`jogosultsag`) VALUES (?, ?, ?, ?)");
                    $stmt->bind_param("ssss", $nev, $email, $titkositottJelszo, $jogosultsag);



                    if ($stmt->execute()) {
                        echo "Sikeres regisztráció";
                    } else {
                        echo "Hiba történt " . $stmt->error;
                    }

                    $stmt->close();
                    $con->close();
                }
            }
        } catch (Exception $e) {
            echo ("Hiba " . $e);
        }
    }

    public static function UjAdminFiokHozzaAdas(array $adminAdatok): void
    {
        try {
            if (array_key_exists("felhasznaloNev", $adminAdatok) && array_key_exists("email", $adminAdatok) && array_key_exists("jelszo", $adminAdatok)) {
                $fnev  =   $adminAdatok["felhasznaloNev"];
                $email =  $adminAdatok["email"];
                $jelszo =   $adminAdatok["jelszo"];

                $titkositottJelszo = password_hash($jelszo, PASSWORD_DEFAULT);

                $admin = new Admin($fnev, $email, $titkositottJelszo);
                $jogosultsag =   $admin->GetJogosultsag();

                $con  = new mysqli("127.0.0.1", "root", "", "fitfoglalo");
                $stmt = $con->prepare("INSERT INTO `Admin` (`felhasznaloNev`, `email`, `jelszo`,`jogosultsag`) VALUES (?,?,?,?)");
                $stmt->bind_param("ssss", $fnev, $email, $titkositottJelszo, $jogosultsag);


                $stmt->execute();
            }

            $stmt->close();
            $con->close();
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
        }
    }

    public static function FelhasznaloAdatokLekerdezes(): array
    {
        try {
            $con = new mysqli("127.0.0.1", "root", "", "fitfoglalo");

            $stmt = $con->prepare("SELECT * FROM Felhasznalo");

            $stmt->execute();
            $stmt->bind_result($id, $felhasznaloNev, $email, $titkositottJelszo, $jogosultsag);

            $adatokTomb = array();

            while ($stmt->fetch()) {
                $adatokTomb[] = [
                    "id" => $id,
                    "felhasznaloNev" => $felhasznaloNev,
                    "email" => $email,
                    "titkositottJelszo" => $titkositottJelszo,
                    "jogosultsag" => $jogosultsag
                ];
            }

            return $adatokTomb;
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
        }
    }


    public  static  function Belépés(): void
    {
        try {
            if (array_key_exists("username", $_POST) && array_key_exists("pw", $_POST)) {
                $fnev = $_POST["username"];
                $jelszo = $_POST["pw"];

                $con = new mysqli("127.0.0.1", "root", "", "fitfoglalo");

                $stmt = $con->prepare("SELECT `ID` , `jelszo`, `jogosultsag` FROM Felhasznalo WHERE `felhasznaloNev` = ?");
                $stmt->bind_param("s", $fnev);
                $stmt->execute();
                $stmt->bind_result($id, $titkositottJelszo, $jogosultsag);

                if ($stmt->fetch()) {
                    if ($jogosultsag === "standard") {
                        if (password_verify($jelszo, $titkositottJelszo)) {
                            session_start();
                            $_SESSION['user_id'] = $id;
                            header("Location:http://127.0.0.1/FitneszteremFoglalasiRendszer/core/controller/ViewControllerFelhasznalo.php?actionFelhasznalo=fooldalFelhasznalo");
                            exit();
                        } else {
                            echo json_encode(['message' =>  'Hibás felhasználónév vagy jelszó'], JSON_UNESCAPED_UNICODE);
                        }
                    }
                    $stmt->close();
                } else {


                    $stmt = $con->prepare("SELECT  `ID` , `jelszo` FROM `Admin` WHERE `felhasznaloNev` = ?");
                    $stmt->bind_param("s", $fnev);
                    $stmt->execute();
                    $stmt->bind_result($id, $adminJelszo);

                    while ($stmt->fetch()) {

                        if ($jelszo === "Admin1234567") {
                            session_start();
                            $_SESSION['admin_id'] = $id;

                            $id1 = $_SESSION['admin_id'];
                            $titkositottJelszo = password_hash($jelszo, PASSWORD_DEFAULT);

                            $stmt->prepare("UPDATE  `Admin` SET `jelszo` = ? WHERE ID=?");
                            $stmt->bind_param("si", $titkositottJelszo, $id1);
                            $stmt->execute();
                            if (password_verify($jelszo, $titkositottJelszo)) {

                                header("Location: http://127.0.0.1/FitneszteremFoglalasiRendszer/core/controller/ViewControllerAdmin.php?actionAdmin=fooldalAdmin");

                                exit();
                            } else {

                                echo json_encode(['message' =>  'Hibás felhasználónév vagy jelszó'], JSON_UNESCAPED_UNICODE);
                            }

                            header("Location: http://127.0.0.1/FitneszteremFoglalasiRendszer/core/controller/ViewControllerAdmin.php?actionAdmin=fooldalAdmin");

                            exit();
                        }

                        if (password_verify($jelszo, $adminJelszo)) {

                            session_start();
                            $_SESSION['admin_id'] = $id;
                            header("Location: http://127.0.0.1/FitneszteremFoglalasiRendszer/core/controller/ViewControllerAdmin.php?actionAdmin=fooldalAdmin");

                            exit();
                        } else {

                            echo json_encode(['message' =>  'Hibás felhasználónév vagy jelszó'], JSON_UNESCAPED_UNICODE);
                        }

                        header("Location: http://127.0.0.1/FitneszteremFoglalasiRendszer/core/controller/ViewControllerAdmin.php?actionAdmin=fooldalAdmin");

                        exit();
                    }

                    $stmt->close();
                    $con->close();
                }
            }
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
        }
    }


    public static function FitneszOraFelvitel(array $fitneszOra): void
    {
        try {

            $aktualisNap =   $fitneszOra["nap"];
            $oraKezdes =  intval($fitneszOra["oraKezdes"]);
            $oraVege = intval($fitneszOra["oraVege"]);
            $oraTipus  =  $fitneszOra["oraTipus"];

            $fiteszOra = new FitneszOra($aktualisNap, $oraKezdes, $oraVege, $oraTipus);
            $aktNap =    $fiteszOra->GetAktualisNap();
            $oraKezd = intval($fiteszOra->GetOraKezdete());
            $oraVeg = intval($fiteszOra->GetOraVege());
            $oraTip = $fiteszOra->GetOraTipusok();


            $con = new mysqli("127.0.0.1", "root", "", "fitfoglalo");
            $stmt = $con->prepare("INSERT INTO `FitneszOra` (`aktualisNap`, `oraKezdete`, `oraVege`, `oraTipus`) VALUES (?, ?, ?, ?)");



            $stmt->bind_param("siis", $aktNap, $oraKezd, $oraVeg, $oraTip);

            $stmt->execute();

            $stmt->close();
            $con->close();
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
        }
    }


    public static function FitneszOraLekerdezes(): array
    {
        try {
            $con = new mysqli("127.0.0.1", "root", "", "fitfoglalo");
            $stmt = $con->prepare(
                "SELECT `ID`, `aktualisNap`, `oraKezdete`, `oraVege`, `oraTipus`
                FROM `fitneszora`
                 ORDER BY
                `oraKezdete` ASC,
                `oraVege` ASC"
            );
            $stmt->execute();

            $stmt->bind_result($id, $aktualisNap, $oraKezdes, $oraVege, $oraTipus);

            $oraTomb = [];


            while ($stmt->fetch()) {
                $oraTomb[] = [
                    'id' => $id,
                    'aktualisNap' => $aktualisNap,
                    'oraKezdete' => $oraKezdes,
                    'oraVege' => $oraVege,
                    'oraTipus' => $oraTipus,
                ];
            }

            return $oraTomb;
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
        }
    }

    public static function FitneszOraFrissites(int $id, array $fitneszOra): void
    {
        try {
            $con = new mysqli("127.0.0.1", "root", "", "fitfoglalo");
            $sql = "UPDATE FitneszOra SET aktualisNap = ?, oraKezdete = ?, oraVege = ?, oraTipus = ? WHERE ID = ?";
            $stmt = $con->prepare($sql);
            $stmt->bind_param(
                "siisi",
                $fitneszOra['aktualisNap'],
                $fitneszOra['oraKezdete'],
                $fitneszOra['oraVege'],
                $fitneszOra['oraTipus'],
                $id
            );
            $stmt->execute();
            $stmt->close();
            $con->close();
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
        }
    }


    public static function FitneszOraTorles(int $fitneszOraID): void
    {
        try {
            $con = new mysqli("127.0.0.1", "root", "", "fitfoglalo");

            $sql = "DELETE FROM foglalas WHERE fitneszOraID = ?";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("i", $fitneszOraID);
            $stmt->execute();
            $stmt->close();


            $sql = "DELETE FROM FitneszOra WHERE ID = ?";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("i", $fitneszOraID);
            $stmt->execute();
            $stmt->close();
            $con->close();
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
        }
    }



    public static function MentFoglalas(Foglalas $foglalas): void
    {
        $con = new mysqli("127.0.0.1", "root", "", "fitfoglalo");


        $felhasznaloID = $foglalas->getFelhasznaloID();
        $oraID = $foglalas->getOraID();
        $foglalasDatum = $foglalas->getFoglalasDatum();
        $foglaltOraDatum = $foglalas->getFoglaltOraDatum();

        $alapKapacitas = 20;

        $sql = "SELECT COUNT(*) AS foglalasSzam FROM Foglalas WHERE fitneszOraID = ? AND foglaltOraDatum = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("is", $oraID, $foglaltOraDatum);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();

        if ($row['foglalasSzam'] > 0) {

            $kapacitas = $alapKapacitas - $row['foglalasSzam'] - 1;
            $feliratkozottak = $row['foglalasSzam'] + 1;
        } else {
            $kapacitas = $alapKapacitas - 1;
            $feliratkozottak = 1;
        }


        $sql = "INSERT INTO Foglalas (foglalasDatum, foglaltOraDatum, felhasznaloID, fitneszOraID, kapacitas, feliratkozottak) 
                      VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ssiiii", $foglalasDatum, $foglaltOraDatum, $felhasznaloID, $oraID, $kapacitas, $feliratkozottak);
        $stmt->execute();
        $stmt->close();

        $con->close();
    }






    public static function KapacitasLekerdezes(int $fitneszOraID, string $datum): int
    {
        try {
            $con = new mysqli("127.0.0.1", "root", "", "fitfoglalo");

            $sql = "SELECT kapacitas, feliratkozottak FROM Foglalas WHERE fitneszOraID = ? AND foglaltOraDatum = ?";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("is", $fitneszOraID, $datum);
            $stmt->execute();
            $result = $stmt->get_result();

            $alapKapacitas = 20;
            $osszFeliratkozott = 0;

            while ($row = $result->fetch_assoc()) {
                $osszFeliratkozott = (int)$row['feliratkozottak'];
            }

            $aktKapacitas = $alapKapacitas - $osszFeliratkozott;

            $stmt->close();
            $con->close();

            return $aktKapacitas;
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
        }
    }






    public static function FoglalasLekerdezes(): array
    {
        $foglalasTomb = [];

        try {
            session_start();

            if (!isset($_SESSION['user_id'])) {
                throw new Exception("Felhasználói ID nem található.");
            }

            $felhasznaloID = $_SESSION['user_id'];

            $con = new mysqli("127.0.0.1", "root", "", "fitfoglalo");


            $sql = "SELECT Foglalas.ID AS foglalasID, 
                       FitneszOra.ID AS fitneszOraID, 
                       FitneszOra.aktualisNap, 
                       FitneszOra.oraKezdete, 
                       FitneszOra.oraVege, 
                       Foglalas.foglalasDatum, 
                       Foglalas.foglaltOraDatum,
                       FitneszOra.oraTipus 
                FROM Foglalas 
                JOIN FitneszOra ON Foglalas.fitneszOraID = FitneszOra.ID 
                WHERE Foglalas.felhasznaloID = ?";

            $stmt = $con->prepare($sql);
            $stmt->bind_param("i", $felhasznaloID);


            $stmt->execute();
            $result = $stmt->get_result();

            while ($row = $result->fetch_assoc()) {
                $foglalasTomb[] = $row;
            }

            $stmt->close();
            $con->close();
        } catch (Exception $e) {
            echo json_encode(["status" => "error", "message" => "Database error: " . $e->getMessage()]);
            exit;
        }

        return $foglalasTomb;
    }


    public static function FoglalasAdatokLekerdezesAdmin(): array
    {
        $foglalasTomb = [];

        try {
            $con = new mysqli("127.0.0.1", "root", "", "fitfoglalo");

            $sql = "SELECT 
            Foglalas.ID AS foglalasID, 
            FitneszOra.ID AS fitneszOraID, 
            Felhasznalo.ID AS felhasznaloID,
            Foglalas.*, 
            FitneszOra.*, 
            Felhasznalo.*
        FROM Foglalas 
        JOIN FitneszOra ON Foglalas.fitneszOraID = FitneszOra.ID 
        JOIN Felhasznalo ON Foglalas.felhasznaloID = Felhasznalo.ID";

            $stmt = $con->prepare($sql);


            $stmt->execute();
            $result = $stmt->get_result();

            while ($row = $result->fetch_assoc()) {
                $foglalasTomb[] = $row;
            }

            $stmt->close();
            $con->close();
        } catch (Exception $e) {
            echo json_encode(["status" => "error", "message" => "Database error: " . $e->getMessage()]);
            exit;
        }

        return $foglalasTomb;
    }

    public static function FoglalasTorles(int $foglalasID, int $felhasznaloID): void
    {
        try {
            $con = new mysqli("127.0.0.1", "root", "", "fitfoglalo");
            $sql = "DELETE FROM `Foglalas` WHERE `ID` = ? AND `felhasznaloID` = ?";
            $stmt =  $con->prepare($sql);
            $stmt->bind_param("ii", $foglalasID, $felhasznaloID);
            $stmt->execute();

            $stmt->close();
            $con->close();
        } catch (Exception $e) {
            echo json_encode(["status" => "error", "message" => "Database error: " . $e->getMessage()]);
        }
    }
    public static function AdminAdatokLekerdezes(): array
    {
        $adminAdatok = [];
        try {
            $con  = new mysqli("127.0.0.1", "root", "", "fitfoglalo");
            $sql = "SELECT * FROM `Admin`";
            $stmt =   $con->prepare($sql);
            $stmt->execute();
            $stmt->bind_result($id, $felhasznaloNev, $email, $jelszo, $jogosultsag);

            while ($stmt->fetch()) {
                $adminAdatok[] = [
                    "id" => $id,
                    "felhasznaloNev" => $felhasznaloNev,
                    "email" => $email,
                    "jelszo" => $jelszo,
                    "jogosultsag" => $jogosultsag
                ];
            }

            return $adminAdatok;
            $stmt->close();
            $con->close();
        } catch (Exception $e) {
            echo json_encode(["status" => "error", "message" => "Database error: " . $e->getMessage()]);
        }
    }

    public static function JelszoValtoztatasAdmin(int $id, string $jelszo): void
    {
        try {
            $con  = new mysqli("127.0.0.1", "root", "", "fitfoglalo");
            $sql = "UPDATE `admin` SET jelszo = ?  WHERE ID = ?";
            $stmt =  $con->prepare($sql);
            $titkositottJelszo = password_hash($jelszo, PASSWORD_DEFAULT);
            $stmt->bind_param("si", $titkositottJelszo, $id);
            $stmt->execute();

            $stmt->close();
            $con->close();
        } catch (Exception $e) {
            echo json_encode(["status" => "error", "message" => "Database error: " . $e->getMessage()]);
        }
    }

    public static function JelszoValtoztatasFelhasznalo(int $id, string $jelszo): void
    {
        try {
            $con  = new mysqli("127.0.0.1", "root", "", "fitfoglalo");
            $sql = "UPDATE `Felhasznalo` SET jelszo = ?  WHERE ID = ?";
            $stmt =  $con->prepare($sql);
            $titkositottJelszo = password_hash($jelszo, PASSWORD_DEFAULT);
            $stmt->bind_param("si", $titkositottJelszo, $id);
            $stmt->execute();

            $stmt->close();
            $con->close();
        } catch (Exception $e) {
            echo json_encode(["status" => "error", "message" => "Database error: " . $e->getMessage()]);
        }
    }
}
