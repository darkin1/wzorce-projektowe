<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

interface Zamowienie {
	public function cena();
}

class Koszyk {
	public function cena() {
		return 0;
	}
}

class Produkty implements Zamowienie {
	protected $koszyk;

	function __construct($koszyk) {
		$this->koszyk = $koszyk;
	}	

	public function cena() {
		return $this->koszyk->cena();
	}
}

class Aparat extends Produkty
{
	public function cena() {
		return $this->koszyk->cena() + 1000;
	}
}

class Torba extends Produkty
{
	public function cena() {
		return $this->koszyk->cena() + 100;
	}
}

class Obiektyw extends Produkty
{
	public function cena() {
		return $this->koszyk->cena() + 50;
	}
}


$koszyk = new Koszyk();
$koszyk = new Aparat($koszyk);
$koszyk = new Torba($koszyk);
$koszyk = new Obiektyw($koszyk);

var_dump($koszyk->cena());
?>
