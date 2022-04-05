<?php 
require_once "../modelos/Ciclo.php";

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
		$rspta=$ciclo1->listar();
		$data=Array();

		while ($reg=$rspta->fetch_object()) {
			$data[]=array(
            "0"=>($reg->condicion)?'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->id.')"><i class="fa fa-pencil"></i></button>'.' '.'<button class="btn btn-danger btn-xs" onclick="desactivar('.$reg->id.')"><i class="fa fa-close"></i></button>':'<button class="btn btn-warning btn-xs" onclick="mostrar('.$reg->id.')"><i class="fa fa-pencil"></i></button>'.' '.'<button class="btn btn-primary btn-xs" onclick="activar('.$reg->id.')"><i class="fa fa-check"></i></button>',
            "1"=>$reg->ciclo,
            "2"=>$reg->año,
            "3"=>($reg->condicion)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>'
              );
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