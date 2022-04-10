<?php 
require_once "../modelos/Ciclo.php";
//require_once "../ajax/usuario.php";
$ciclo1=new Ciclo();

$idciclo=isset($_POST["idciclo"])? limpiarCadena($_POST["idciclo"]):"";
$ciclo=isset($_POST["ciclo"])? limpiarCadena($_POST["ciclo"]):"";
$año=isset($_POST["año"])? limpiarCadena($_POST["año"]):"";

switch ($_GET["op"]) {
	case 'guardaryeditar':
	if (empty($idciclo)) {
		$rspta=$ciclo1->insertar($ciclo, $año);
		echo $rspta ? "Datos registrados correctamente" : "No se pudo registrar los datos";
	}else{
         $rspta=$ciclo1->editar($idciclo,$ciclo,$año);
		echo $rspta ? "Datos actualizados correctamente" : "No se pudo actualizar los datos";
	}
		break;
	

	case 'desactivar':
		$rspta=$ciclo1->desactivar($idciclo);
		echo $rspta ? "Datos desactivados correctamente" : "No se pudo desactivar los datos";
		break;
	case 'activar':
		$rspta=$ciclo1->activar($idciclo);
		echo $rspta ? "Datos activados correctamente" : "No se pudo activar los datos";
		break;
	
	case 'mostrar':
		$rspta=$ciclo1->mostrar($idciclo);
		echo json_encode($rspta);
		break;

    case 'listar':
 $is=$_SESSION['tutorids'];
		$rspta=$ciclo1->listar($is);
		$data=Array();

		while ($reg=$rspta->fetch_object()) {
			$data[]=array(
            "0"=>$reg->curso );
		}
		$results=array(
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
             "aaData"=>$data); 
		echo json_encode($results);
		break;
}
 ?>