<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


//klasa dekorowana
class Koszyk {
	public function cena() {
		return 1;//0
	}
}

class Produkty {
	protected $koszyk;

	function __construct($koszyk) {
		$this->koszyk = $koszyk;
	}	
}


//dekorator
class Aparat extends Produkty
{
	public function cena() {
		return $this->koszyk->cena() + 1000;
	}
}

//dekorator
class Torba extends Produkty
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
