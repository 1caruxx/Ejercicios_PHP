<?php
require_once ("clases/producto.php");
require_once ("clases/archivo.php");

$queHago = isset($_POST['queHago']) ? $_POST['queHago'] : NULL;

switch($queHago){

	case "mostrarGrilla":
	
		//$ArrayDeProductos = Producto::TraerTodosLosProductos();
		//$ArrayDeProductos = Producto::TraerDeBase();
		$ArrayDeProductos = Producto::TraerDeBasePDO();

		$grilla = '<table class="table">
					<thead style="background:rgb(14, 26, 112);color:#fff;">
						<tr>
							<th>  COD. BARRA </th>
							<th>  NOMBRE     </th>
							<th>  FOTO       </th>
							<th>  ACCION     </th>
						</tr>  
					</thead>';   	
//AGREGAR COLUMNA 'ACCION'
		foreach ($ArrayDeProductos as $prod){
		
			$grilla .= "<tr>
				<td>".$prod->codBarra."</td>
				<td>".$prod->nombre."</td>
				<td><img src='archivos/".$prod->pathFoto."' width='100px' height='100px'/></td>
				<td>
					<input type='button' value='MODIFICAR' onclick='Main.ModificarProducto(".$prod->codBarra.",\"".$prod->nombre."\")'/><br/>
					<input type='button' value='ELIMINAR' onclick='Main.EliminarProducto(".$prod->codBarra.")'/>
				</td>
			</tr>";
			/*$grilla .= "<tr>
							<td>".$prod->GetCodBarra()."</td>
							<td>".$prod->GetNombre()."</td>
							<td><img src='archivos/".$prod->GetPathFoto()."' width='100px' height='100px'/></td>
							<td>
								<input type='button' value='MODIFICAR' onclick='Main.ModificarProducto(".$prod->GetCodBarra().",\"".$prod->GetNombre()."\")'/><br/>
								<input type='button' value='ELIMINAR' onclick='Main.EliminarProducto(".$prod->GetCodBarra().")'/>
							</td>
						</tr>";*/
//AGREGAR UNA COLUMNA CON DOS 'BUTTONS' (ELIMINAR Y MODIFICAR)						
		}
		
		$grilla .= '</table>';		
		
		echo $grilla;
		
		break;
		
	case "agregar":
	case "modificar":

		if($_POST['codBarra'] && $_POST['nombre']) {

			$res = Archivo::Subir();
		}
		else {

			$res["Exito"] = false;
			$res["Mensaje"] = "No ha completado los campos codigo de barra o nombre";
		}
		
		if(!$res["Exito"]){
			echo $res["Mensaje"];
			break;
		}

		$codBarra = isset($_POST['codBarra']) ? $_POST['codBarra'] : NULL;
		$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : NULL;
		$archivo = $res["PathTemporal"];

		$p = new Producto($codBarra, $nombre, $archivo);
		
		/*if($queHago === "agregar"){
			if(!Producto::Guardar($p)){
				echo "Error al generar archivo";
				break;
			}
		}*/

	    if($queHago === "agregar"){
			if(!Producto::GuardarEnBasePDO($p)){
				echo "Error al generar archivo";
				break;
			}
		}

		/*if($queHago === "modificar"){
			if(!Producto::Modificar($p)){
				echo "Lamentablemente ocurrio un error y no se pudo escribir en el archivo.";
				break;
			}
		}*/

		if($queHago === "modificar"){
			if(!Producto::ModificarEnBasePDO($p)){
				echo "Lamentablemente ocurrio un error y no se pudo escribir en el archivo.";
				break;
			}
		}

		header("Location:./index.php");
		
		break;
	
	case "eliminar":
		$codBarra = isset($_POST['codBarra']) ? $_POST['codBarra'] : NULL;
	
		/*if(!Producto::Eliminar($codBarra)){
			$mensaje = "Lamentablemente ocurrio un error y no se pudo escribir en el archivo.";
		}*/
		if(!Producto::EliminarDeBasePDO($codBarra)){
			$mensaje = "Lamentablemente ocurrio un error y no se pudo escribir en el archivo.";
		}
		else{
			$mensaje = "El archivo fue escrito correctamente. PRODUCTO eliminado CORRECTAMENTE!!!";
		}
	
		echo $mensaje;
		
		break;
		
	default:
		echo ":(";
}
?>