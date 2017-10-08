<?php
class Producto
{
//--------------------------------------------------------------------------------//
//--ATRIBUTOS
	private $codBarra;
 	private $nombre;
	private $pathFoto;
//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--GETTERS Y SETTERS
	public function GetCodBarra()
	{
		return $this->codBarra;
	}
	public function GetNombre()
	{
		return $this->nombre;
	}
	public function GetPathFoto()
	{
		return $this->pathFoto;
	}

	public function SetCodBarra($valor)
	{
		$this->codBarra = $valor;
	}
	public function SetNombre($valor)
	{
		$this->nombre = $valor;
	}
	public function SetPathFoto($valor)
	{
		$this->pathFoto = $valor;
	}

//--------------------------------------------------------------------------------//
//--CONSTRUCTOR
	public function __construct($codBarra=NULL, $nombre=NULL, $pathFoto=NULL)
	{
		if($codBarra !== NULL && $nombre !== NULL && $pathFoto !== NULL){
			$this->codBarra = $codBarra;
			$this->nombre = $nombre;
			$this->pathFoto = $pathFoto;
		}
	}

//--------------------------------------------------------------------------------//
//--TOSTRING	
  	public function ToString()
	{
	  	return $this->codBarra." - ".$this->nombre." - ".$this->pathFoto."\r\n";
	}
//--------------------------------------------------------------------------------//

//--------------------------------------------------------------------------------//
//--METODOS DE CLASE
	public static function Guardar($obj)
	{
		$resultado = FALSE;
		
		//ABRO EL ARCHIVO
		$ar = fopen("archivos/productos.txt", "a");
		
		//ESCRIBO EN EL ARCHIVO
		$cant = fwrite($ar, $obj->ToString());
		
		if($cant > 0)
		{
			$resultado = TRUE;			
		}
		//CIERRO EL ARCHIVO
		fclose($ar);
		
		return $resultado;
	}
	public static function TraerTodosLosProductos()
	{

		$ListaDeProductosLeidos = array();

		//leo todos los productos del archivo
		$archivo=fopen("archivos/productos.txt", "r");
		
		while(!feof($archivo))
		{
			$archAux = fgets($archivo);
			$productos = explode(" - ", $archAux);
			//http://www.w3schools.com/php/func_string_explode.asp
			$productos[0] = trim($productos[0]);
			if($productos[0] != ""){
				$ListaDeProductosLeidos[] = new Producto($productos[0], $productos[1],$productos[2]);
			}
		}
		fclose($archivo);
		
		return $ListaDeProductosLeidos;
		
	}

	public static function TraerTodosLosProductosBD() {

		$datos = "mysql:host=localhost;dbname=productos";
		$user = "root";
		$pass = "";

		try {

			$conexcion = new PDO($datos , $user , $pass);

			$consulta = $conexcion->prepare("SELECT * FROM producto");
			$consulta->execute();
			$consulta->setFetchMode(PDO::FETCH_INTO, new Producto);
			$conexcion = null;

			return $consulta;
		}
		catch(PDOexception $excepcion) {

			echo $excepcion->getmessage();
		}
	}

	public static function GuardarEnBD($objeto) {

		$datos = "mysql:host=localhost;dbname=productos";
		$user = "root";
		$pass = "";

		try {

			$conexcion = new PDO($datos , $user , $pass);

			$consulta = $conexcion->prepare("INSERT INTO producto (codBarra , nombre , pathFoto) VALUES :codBarra , :nombre , :pathFoto");
			$consulta->execute(array(':codBarra'=>$objeto->codBarra , ':nombre'=>$objeto->nombre , ':pathFoto'=>$objeto->pathFoto));
			$conexcion = null;

			return true;
		}
		catch(PDOexception $excepcion) {

			echo $excepcion->getmessage();
		}
	}

	public static function BorrarDeBD($codBarra) {

		$datos = "mysql:host=localhost;dbname=productos";
		$user = "root";
		$pass = "";

		try {

			$conexcion = new PDO($datos , $user , $pass);

			$consulta = $conexcion->prepare("DELETE FROM producto WHERE codBarra=:codBarra");
			$consulta->execute(array(':codBarra'=>$codBarra));
			$conexcion = null;
			
			return true;
		}
		catch(PDOexception $excepcion) {

			echo $excepcion->getmessage();
		}
	}

	public static function ModifecarEnBD($objeto) {

		$datos = "mysql:host=localhost;dbname=productos";
		$user = "root";
		$pass = "";

		try {

			$conexcion = new PDO($datos , $user , $pass);

			$consulta = $conexcion->prepare("UPDATE producto SET codBarra=:codBarra , nombre=:nombre , pathFoto=:pathFoto WHERE codBarra={$objeto->codBarra}");
			$consulta->execute(array(':codBarra'=>$objeto->codBarra , ':nombre'=>$objeto->nombre , 'pathFoto'=>$objeto->pathFoto));
			$conexcion = null;

			return true;
		}
		catch(PDOexception $excepcion) {

			echo $excepcion->getmessage();
		}
	}
//--------------------------------------------------------------------------------//
}