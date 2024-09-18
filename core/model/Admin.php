<?php
require_once __DIR__ . "/../model/Felhasznalo.php";
class Admin extends Felhasznalo
{
    public function __construct(string $felhasznaloNev,string $email, string $jelszo)
    {
        parent::__construct($felhasznaloNev,$email,password_hash($jelszo,PASSWORD_DEFAULT),"admin");
    }
}

?>