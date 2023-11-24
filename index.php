<?php

class Student {
    public $ime;
    public $prezime;
    public $brojIndeksa;
    public function __construct($ime, $prezime, $brojIndeksa) {
        $this->ime = $ime;
        $this->prezime = $prezime;
        $this->brojIndeksa = $brojIndeksa;
    }
}

class Predmet {
    public $naziv;
    public $profesor;
    public function __construct($naziv, $profesor) {
        $this->naziv = $naziv;
        $this->profesor = $profesor;
    }
}

class Ocenjivanje {
    public $ocena;
    public $datum;
    public $student;
    public $predmet;
    public function __construct($ocena, $datum, $student, $predmet) {
        $this->ocena = $ocena;
        $this->datum = $datum;
        $this->student = $student;
        $this->predmet = $predmet;
    }
}

class EvidencijaStudenata {
    private static $instance;
    private $studenti = array();
    private function __construct() {}
    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new EvidencijaStudenata();
        }
        return self::$instance;
    }
    public function dodajStudenta($student) {
        $this->studenti[] = $student;
    }
    public function getStudenti() {
        return $this->studenti;
    }
}

interface Ispit {
    public function detaljiIspita();
}

class FabrikaIspita {
    public function napraviIspit($tip) {
        switch ($tip) {
            case 'pismeni':
                return new PismeniIspit();
            case 'usmeni':
                return new UsmeniIspit();
            default:
                return null;
        }
    }
}

class PismeniIspit implements Ispit {
    public function detaljiIspita() {
        return "Pismeni ispit - Trajanje: 2 sata";
    }
}

class UsmeniIspit implements Ispit {
    public function detaljiIspita() {
        return "Ocena:";
    }
}

$student1 = new Student("Marko", "Marković", "123");
$student2 = new Student("Ana", "Anić", "456");

$predmet1 = new Predmet("Matematika", "Profesor Petrović");
$predmet2 = new Predmet("Fizika", "Profesor Jovanović");

$ocenjivanje1 = new Ocenjivanje(9, "2023-11-22", $student1, $predmet1);
$ocenjivanje2 = new Ocenjivanje(8, "2023-11-23", $student2, $predmet2);

$evidencija = EvidencijaStudenata::getInstance();
$evidencija->dodajStudenta($student1);
$evidencija->dodajStudenta($student2);

$fabrika = new FabrikaIspita();
$pismeniIspit = $fabrika->napraviIspit('pismeni');
$usmeniIspit = $fabrika->napraviIspit('usmeni');

echo $pismeniIspit->detaljiIspita() . "\n";
echo $usmeniIspit->detaljiIspita() . "\n";

$sviStudenti = $evidencija->getStudenti();
foreach ($sviStudenti as $student) {
    echo $student->ime . " " . $student->prezime . " - Broj indeksa: " . $student->brojIndeksa . "\n";
}








