<?php
abstract class Felhasznalo {
    protected ?int $id;
    protected string $felhasznaloNev;
    protected string $email;
    protected string $jelszo;
    protected string $jogosultsag;

    public function __construct(string $felhasznaloNev, string $email, string $jelszo, string $jogosultsag) {
        $this->felhasznaloNev = $felhasznaloNev;
        $this->email = $email;
        $this->jelszo = $jelszo;
        $this->jogosultsag = $jogosultsag;
    }

    public function GetID(): ?int {
        return $this->id;
    }

    public function SetID(?int $id): void {
        $this->id = $id;
    }

    public function GetFelhasznaloNev(): string {
        return $this->felhasznaloNev;
    }

    public function SetFelhasznaloNev(string $felhasznaloNev): void {
        $this->felhasznaloNev = $felhasznaloNev;
    }

    public function GetEmail(): string {
        return $this->email;
    }

    public function SetEmail(string $email): void {
        $this->email = $email;
    }

    public function GetJelszo(): string {
        return $this->jelszo;
    }

    public function SetJelszo(string $jelszo): void {
        $this->jelszo = $jelszo;
    }

    public function GetJogosultsag(): string {
        return $this->jogosultsag;
    }

    public function SetJogosultsag(string $jogosultsag): void {
        $this->jogosultsag = $jogosultsag;
    }
}
?>
