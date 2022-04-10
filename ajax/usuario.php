<?php 
session_start();
require_once "../modelos/Usuario.php";

$usuario=new Usuario();

$idusuario=isset($_POST["idusuario"])? limpiarCadena($_POST["idusuario"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$tipo_documento=isset($_POST["tipo_documento"])? limpiarCadena($_POST["tipo_documento"]):"";
$num_documento=isset($_POST["num_documento"])? limpiarCadena($_POST["num_documento"]):"";
$direccion=isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
$telefono=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
$email=isset($_POST["email"])? limpiarCadena($_POST["email"]):"";
$cargo=isset($_POST["cargo"])? limpiarCadena($_POST["cargo"]):"";
$login=isset($_POST["login"])? limpiarCadena($_POST["login"]):"";
$clave=isset($_POST["clave"])? limpiarCadena($_POST["clave"]):"";
$imagen=isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";
switch ($_GET["op"]) {
	case 'guardaryeditar':

	if (!file_exists($_FILES['imagen']['tmp_name'])|| !is_uploaded_file($_FILES['imagen']['tmp_name'])) {
		$imagen=$_POST["imagenactual"];
	}else{
		$ext=explode(".", $_FILES["imagen"]["name"]);
		if ($_FILES['imagen']['type']=="image/jpg" || $_FILES['imagen']['type']=="image/jpeg" || $_FILES['imagen']['type']=="image/png") {
			$imagen=round(microtime(true)).'.'. end($ext);
			move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/usuarios/".$imagen);
		}
	}

	//Hash SHA256 para la contraseña
	$clavehash=hash("SHA256", $clave);
	if (empty($idusuario)) {
		$rspta=$usuario->insertar($nombre,$tipo_documento,$num_documento,$direccion,$telefono,$email,$cargo,$login,$clavehash,$imagen,$_POST['permiso']);
		echo $rspta ? "Datos registrados correctamente" : "No se pudo registrar todos los datos del usuario";
	}else{
		$rspta=$usuario->editar($idusuario,$nombre,$tipo_documento,$num_documento,$direccion,$telefono,$email,$cargo,$login,$clavehash,$imagen,$_POST['permiso']);
		echo $rspta ? "Datos actualizados correctamente" : "No se pudo actualizar los datos";
	}
	break;
	

	case 'desactivar':
	$rspta=$usuario->desactivar($idusuario);
	echo $rspta ? "Datos desactivados correctamente" : "No se pudo desactivar los datos";
	break;

	case 'activar':
	$rspta=$usuario->activar($idusuario);
	echo $rspta ? "Datos activados correctamente" : "No se pudo activar los datos";
	break;
	
	case 'mostrar':
	//validar si el usuario tiene acceso al sistema
	$logina1=$_POST['logina'];
	$clavea1=$_POST['clavea'];

//	//Hash SHA256 en la contraseña
//	$clavehash=hash("SHA256", $clavea);
	
	$rspta1=$usuario->listarmarcados($logina1, $clavea1);

	$fetch1=$rspta1->fetch_object();
	if (isset($fetch1)) {
	$_SESSION1['idtutor'] = $fetch1->id;
        $_SESSION1['idtutor'] = $fetch1->id;
        $_SESSION1['nombre'] = $fetch1->nombre;
        $_SESSION1['apellido'] = $fetch1->apellido;
        $_SESSION1['email'] = $fetch1->email;
        $_SESSION1['nivel'] = $fetch1->nivel;
   
		$_SESSION1['escritorio']=1;
		$_SESSION1['almacen']=1;
		$_SESSION1['compras']=1;
		$_SESSION1['ventas']=1;
		$_SESSION1['acceso']=1;
		$_SESSION1['consultac']=1;
		$_SESSION1['consultav']=1;
                
echo json_encode($fetch1);
	}
	break;
	break;

	case 'listar':
             $isd=$_SESSION['tutorid'];
	$rspta=$usuario->listar($isd);
	$data=Array();

	while ($reg=$rspta->fetch_object()) {
		$data[]=array(
			"0"=>$reg->codigo,
                         "1"=>$reg->alumno,
			"2"=>$reg->curso,
			"3"=>$reg->escuela,
			"4"=>$reg->fecha,
			);
	}

	$results=array(
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
             "aaData"=>$data); 
	echo json_encode($results);
	break;

	case 'permisos':
			//obtenemos toodos los permisos de la tabla permisos
	require_once "../modelos/Permiso.php";
	$permiso=new Permiso();
	$rspta=$permiso->listar();
//obtener permisos asigandos
	$id=$_GET['id'];
	$marcados=$usuario->listarmarcados($id);
	$valores=array();

//almacenar permisos asigandos
	while ($per=$marcados->fetch_object()) {
		array_push($valores, $per->id);
	}
			//mostramos la lista de permisos
	while ($reg=$rspta->fetch_object()) {
		$sw=in_array($reg->id,$valores)?'checked':'';
		echo '<li><input type="checkbox" '.$sw.' name="permiso[]" value="'.$reg->id.'">'.$reg->nombre.'</li>';
	}
	break;

	
  case 'verificar':
     
	//validar si el usuario tiene acceso al sistema
	$logina=$_POST['logina'];
	$clavea=$_POST['clavea'];

//	//Hash SHA256 en la contraseña
//	$clavehash=hash("SHA256", $clavea);
	
	$rspta=$usuario->verificar($logina, $clavea);

	$fetch=$rspta->fetch_object();
	if (isset($fetch)) {
	$_SESSION['idalumno'] = $fetch->id;
             $_SESSION['idescuela'] = $fetch->idescuela;
            $_SESSION['codigo'] = $fetch->codigo;
            $_SESSION['nombre'] = $fetch->nombre;
            $_SESSION['apellido'] = $fetch->apellido;
            $_SESSION['rendimiento'] = $fetch->rendimiento;
            $_SESSION['escuela'] = $fetch->escuela;
            $_SESSION['ciclo'] = $fetch->ciclo;

		//obtenemos los permisos
		$marcados=$usuario->listarmarcados($fetch->id);

		//declaramos el array para almacenar todos los permisos
		
echo json_encode($fetch);
	}

	break;
        case 'verificarr':
	$logina1=$_POST['logina'];
	$clavea1=$_POST['clavea'];

//	//Hash SHA256 en la contraseña
//	$clavehash=hash("SHA256", $clavea);
	
	$rspta1=$usuario->verificarr($logina1, $clavea1);

	$fetch1=$rspta1->fetch_object();
	if (isset($fetch1)) {
	
        $_SESSION['tutorid']=$fetch1->id;
        $_SESSION['nombre1']=$fetch1->nombre;
       $_SESSION['apellido1']=$fetch1->apellido;
        $_SESSION['email1']=$fetch1->email;
        $_SESSION['nivel1']=$fetch1->nivel;
      
		
 echo json_encode($fetch1);
	}

	break;
 case 'listarcurso':
 $iss=$_SESSION['tutorid'];
		$rspta=$usuario->listarcurso($iss);
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
	case 'salir':
	   //limpiamos la variables de la secion
	session_unset();

	  //destruimos la sesion
	session_destroy();
		  //redireccionamos al login
	header("Location: ../index.php");
	break;
  case 'salir1':
	   //limpiamos la variables de la secion
	session_unset();

	  //destruimos la sesion
	session_destroy();
		  //redireccionamos al login
	header("Location: ../index.php");
	break;

	


	
}
?>

