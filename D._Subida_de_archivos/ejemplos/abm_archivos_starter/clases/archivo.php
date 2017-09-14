<?php
class Archivo{

	public static function Subir()
	{
		$retorno["Exito"] = TRUE;

		//INDICO CUAL SERA EL DESTINO DEL ARCHIVO SUBIDO

		//VERIFICO EL TAMAÑO MAXIMO QUE PERMITO SUBIR

		//OBTIENE EL TAMAÑO DE UNA IMAGEN, SI EL ARCHIVO NO ES UNA
		//IMAGEN, RETORNA FALSE

		if($esImagen === FALSE) {//NO ES UNA IMAGEN
			$retorno["Exito"] = FALSE;
			$retorno["Mensaje"] = "S&oacute;lo son permitidas IMAGENES.";
			return $retorno;
		}
		else {// ES UNA IMAGEN

			//SOLO PERMITO CIERTAS EXTENSIONES
		}
		
		//MUEVO EL ARCHIVO AL REPOSITORIO FINAL
	}

	public static function Borrar($path)
	{
		return unlink($path);
	}

	public static function Mover($pathOrigen, $pathDestino)
	{
		return copy($pathOrigen, $pathDestino);
	}
}
?>