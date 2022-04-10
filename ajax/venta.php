<?php 
require_once "../modelos/Venta.php";
if (strlen(session_id())<1) 
	session_start();

$venta = new Venta();

$idventa=isset($_POST["idventa"])? limpiarCadena($_POST["idventa"]):"";
$curso=isset($_POST["curso"])? limpiarCadena($_POST["curso"]):"";
$tutor=isset($_POST["tutor"])? limpiarCadena($_POST["tutor"]):"";
$ides=$_SESSION["idalumno"];
$fecha_hora=isset($_POST["fecha_hora"])? limpiarCadena($_POST["fecha_hora"]):"";






switch ($_GET["op"]) {
	case 'guardaryeditar':
	if (empty($idventa)) {
		$rspta=$venta->insertar($ides, $curso, $tutor, $fecha_hora); 
		echo $rspta ? "Datos registrados correctamente" : "No se pudo registrar los datos";
	}else{
        
	}
		break;
	

	case 'anular':
		$rspta=$venta->anular($idventa);
		echo $rspta ? "Ingreso anulado correctamente" : "No se pudo anular el ingreso";
		break;
	
	case 'mostrar':
		$rspta=$venta->mostrar($idventa);
		echo json_encode($rspta);
		break;
    case 'listar':
            $idt=$_SESSION["idalumno"];
		$rspta=$venta->listar($idt);
		$data=Array();
		while ($reg=$rspta->fetch_object()) {
                $data[]=array(
           "0"=>$reg->Tutor,
            "1"=>$reg->curso,
            "2"=>$reg->fecha
            
           );
		}
		$results=array(
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
             "aaData"=>$data); 
		echo json_encode($results);
		break;
   case 'listardatos':
          $idq=$_SESSION["idalumno"];
		
       $rspta=$venta->listardatos($idq);
		$data=Array();

		while ($reg=$rspta->fetch_object()) {
			$data[]=array(
            "0"=>$reg->codigo,
            "1"=>$reg->nombre,
            "2"=>$reg->apellido,
            "3"=>$reg->rendimiento,
            "4"=>$reg->escuela,
            "5"=>$reg->ciclo
         
              );
		}
		$results=array(
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
             "aaData"=>$data); 
		echo json_encode($results);
		break;

case 'selecttutor':
require_once "../modelos/Persona.php";
			$persona = new Persona();

			$rspta = $persona->listartutor();

			while ($reg = $rspta->fetch_object()) {
				echo '<option value='.$reg->id.'>'.$reg->nombre.''.$reg->apellido.'</option>';
			}
			break;
case 'selectcurso':
    $idc=$_SESSION["idescuela"];
require_once "../modelos/Persona.php";
			$persona = new Persona();

			$rspta = $persona->listacurso($idc);

			while ($reg = $rspta->fetch_object()) {
				echo '<option value='.$reg->id.'>'.$reg->nombre.'</option>';
			}
			break;

case 'listarArticulos':
			require_once "../modelos/Articulo.php";
			$articulo=new Articulo();

				$rspta=$articulo->listarActivosVenta();
		$data=Array();

		while ($reg=$rspta->fetch_object()) {
			$data[]=array(
            "0"=>'<button class="btn btn-warning" onclick="agregarDetalle('.$reg->idarticulo.',\''.$reg->nombre.'\','.$reg->precio_venta.')"><span class="fa fa-plus"></span></button>',
            "1"=>$reg->nombre,
            "2"=>$reg->categoria,
            "3"=>$reg->codigo,
            "4"=>$reg->stock,
            "5"=>$reg->precio_venta,
            "6"=>"<img src='../files/articulos/".$reg->imagen."' height='50px' width='50px'>"
          
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