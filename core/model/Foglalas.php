<?php

class Foglalas
{
    private ?int $id;
    private int $felhasznloID;
    private int $oraID;
    private string $foglalasDatum;
    private string $foglaltOraDatum;



    public function __construct(int $felhasznloID, int $oraID,string $foglaltOraDatum)
    {

        $this->felhasznloID = $felhasznloID;
        $this->oraID = $oraID;
        $this->foglalasDatum =  date('Y-m-d');
        $this->foglaltOraDatum = $foglaltOraDatum;
   


    }

    public function GetID(): int
    {
        return $this->id;
    }

    public function GetFelhasznaloID():int
    {
        return $this->felhasznloID;
    }

    public function GetOraID():int
    {
        return $this->oraID;
    }

    public function GetFoglalasDatum():string
    {
     return $this->foglalasDatum;
    }

  

    public function GetFoglaltOraDatum():string
    {
        return $this->foglaltOraDatum;
    }
    


    public function SetID($id): void
    {
        if($id === null)
        {
            $this->id = $id;
        }
    }

    public function SetFelhasznaloID($felhasznloID):void
    {
        $this->felhasznloID =$felhasznloID;
    }

    public function SetOraID($oraID):void
    {
         $this->oraID = $oraID;
    }

    public function SetFoglalasDatum($foglalasDatum):void
    {
      $this->foglalasDatum = $foglalasDatum;
    }

 

    public function SetFoglaltOraDatum($foglaltOraDatum)
    {
        $this->foglaltOraDatum = $foglaltOraDatum;
    }
}
