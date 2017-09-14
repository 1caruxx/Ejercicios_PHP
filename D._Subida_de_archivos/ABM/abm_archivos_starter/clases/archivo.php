<?php
class Archivo{

	public static function Subir()
	{
		$retorno["Exito"] = TRUE;

		//INDICO CUAL SERA EL DESTINO DEL ARCHIVO SUBIDO
		$destino = "./archivos/".date("Ymd_Gis");
		
		//VERIFICO EL TAMAÑO MAXIMO QUE PERMITO SUBIR
		if($_FILES["archivo"]["size"] > 5000000000000) {

			$retorno["Exito"] = FALSE;
			$retorno["Mensaje"] = "El peso de la imagen excedio el limite.";
			return $retorno;
		}

		//OBTIENE EL TAMAÑO DE UNA IMAGEN, SI EL ARCHIVO NO ES UNA
		//IMAGEN, RETORNA FALSE

		$esImagen = getimagesize($_FILES["archivo"]["tmp_name"];

		if($esImagen === FALSE) {//NO ES UNA IMAGEN
			$retorno["Exito"] = FALSE;
			$retorno["Mensaje"] = "S&oacute;lo son permitidas IMAGENES.";
			return $retorno;
		}
		else {// ES UNA IMAGEN

			//SOLO PERMITO CIERTAS EXTENSIONES
			$extension = pathinfo(($destino, PATHINFO_EXTENSION);

			if($extension!=".jpg" && $extension!=".jpeg" && $extension!=".png") {

				$retorno["Exito"] = FALSE;
				$retorno["Mensaje"] = "La extension {$extension} no es valida.";
				return $retorno;
			}
		}
		
		//MUEVO EL ARCHIVO AL REPOSITORIO FINAL

		move_uploaded_file($_FILES["archivo"]["tmp_name"] , $destino);
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