<?php


class FitneszOra
{

    private ?int $ID;
    private int $oraKezdete;
    private int $oraVege;
    private int $kapacitas;
    private int $feliratkozottak;
    private string $oratipusok;
    private string $aktuaisNap;


    public function __construct($aktuaisNap, int $oraKezdete, int $oraVege, string $oratipusok)
    {
        $this->aktuaisNap = $aktuaisNap;
        $this->SetOraKezdete($oraKezdete);
        $this->SetOraVege($oraVege);
        $this->oratipusok = $oratipusok;

     
    }


    public function GetID(): int
    {
        return $this->ID;
    }


    public function GetOraKezdete(): int
    {
        return $this->oraKezdete;
    }

    public function GetOraVege(): int
    {
        return  $this->oraVege;
    }


    public function GetFeliratkozottak(): int
    {
        return $this->feliratkozottak;
    }

    public function GetOraTipusok(): string
    {
        return $this->oratipusok;
    }
    public function GetAktualisNap(): string
    {
        return $this->aktuaisNap;
    }

    public function SetID($ID): void
    {
        $this->ID = $ID;
    }
    public function SetOraKezdete($oraKezdete): void
    {
        $this->oraKezdete = $oraKezdete;
    }
    public function SetOraVege($oraVege): void
    {
        $this->oraVege = $oraVege;
    }

    public function SetAktualisNap($aktuaisNap): void
    {
        $this->aktuaisNap = $aktuaisNap;
    }

}
