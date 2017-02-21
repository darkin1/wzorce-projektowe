<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

interface Zamowienie {
	public function cena();
}

class Koszyk {
	public function cena() {
		return 1;
	}
}

class Produkty {
	protected $koszyk;

	function __construct($koszyk) {
		$this->koszyk = $koszyk;
	}	
}

class Aparat extends Produkty implements Zamowienie
{
	public function cena() {
		return $this->koszyk->cena() + 1000;
	}
}

class Torba extends Produkty implements Zamowienie
{
	public function cena() {
		return $this->koszyk->cena() + 100;
	}
}


$koszyk = new Koszyk();
$koszyk = new Aparat($koszyk);
$koszyk = new Torba($koszyk); 

var_dump($koszyk->cena());
?>
