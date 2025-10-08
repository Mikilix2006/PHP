<?php
class Persona {
	private $DNI;
	private $nombre;
	private $apellido;
	function __construct($DNI, $nombre, $apellido) {
		$this->DNI = $DNI;
		$this->nombre = $nombre;
		$this->apellido = $apellido;        
	}
	public function getNombre() {
		return $this->nombre;
	}
	public function getApellido() {
		return $this->apellido;
	}
	public function getDNI() {
		return $this->DNI;
	}
	
	public function setNombre($nombre) {
		$this->nombre = $nombre;
	}
	public function setApellido($apellido) {
		$this->apellido = $apellido;
	}
	public function setDNI($DNI) {
		$this->DNI = $DNI;
	}
	
	public function __toString() {
		return "Persona: ".$this->nombre." ".$this->apellido." ".$this->DNI;
	}
}
class Cliente extends Persona{
	private $saldo = 0;
	
	function __construct($DNI, $nombre, $apellido, $saldo){	
		 parent::__construct($DNI, $nombre, $apellido);
		 $this->$saldo = $saldo;
	}
	public function getSaldo(){
		return $this->saldo;
	}
	public function setSaldo($saldo){
		$this->saldo = $saldo;
	}
	public function __toString(){
		return  "Cliente: ".$this->getNombre()." ".$this->getApellido()." ".$this->getDNI()." ".$this->saldo."€";
	}      
}

// crear una persona
$per = new Persona("1111111A", "Ana", "Puertas");
// mostrarla, usa el método __toString()
echo $per . "<br>";
// cambiar el apellido
$per->setApellido("Montes");
// volver a mostrar
echo $per . "<br>";
// crea un cliente
$cli = new Cliente("22222245A", "Pedro", "Sales", 100);
// lo muestra
echo $cli . "<br>";

$longitud_nombre = strlen($cli->getNombre());
$sub = substr($cli->getNombre(), 1, 3);
echo $longitud_nombre;
echo '<br>';
echo $sub;
echo '<br>';

?>
