<?php 
require_once "../modelos/Alumno.php";

$alumno = new Alumno();


switch ($_GET["op"]) {
    case 'guardaryeditar':


        break;

	

    case 'listar':
          $idt=$_SESSION["idalumno"];
		$rspta=$alumno->listar($idt);
		$data=Array();

		while ($reg=$rspta->fetch_object()) {
			$data[]=array(
            "0"=>$reg->codigo,
            "1"=>$reg->nombre,
            "2"=>$reg->apellido,
            "3"=>$reg->rendimiento,
            "4"=>$reg->escuela,
            "5"=>$reg->ciclo,
            "6"=>($reg->condicion)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>'
              );
		}
		$results=array(
             "sEcho"=>1,//info para datatables
             "iTotalRecords"=>count($data),//enviamos el total de registros al datatable
             "iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
             "aaData"=>$data); 
		echo json_encode($results);
		break;

    case 'selectCiclo':
        require_once "../modelos/Ciclo.php";
        $ciclo1 = new Ciclo();

        $rspta1 = $ciclo1->select();

        while ($reg1 = $rspta1->fetch_object()) {
            echo '<option value=' . $reg1->id . '>' . $reg1->ciclo . '</option>';
        }
        break;
    case 'selectEscuela':
        require_once "../modelos/Escuela.php";
        $escuela1 = new Escuela();

        $rspta = $escuela1->select();

        while ($reg = $rspta->fetch_object()) {
            echo '<option value=' . $reg->id . '>' . $reg->nombre . '</option>';
        }
        break;
    case 'verificar':
        //validar si el usuario tiene acceso al sistema
        $logina = $_POST['logina'];
        $clavea = $_POST['clavea'];

//	//Hash SHA256 en la contraseña
//	$clavehash=hash("SHA256", $clavea);

        $rspta = $alumno->verificar($logina, $clavea);

        $fetch = $rspta->fetch_object();
        if (isset($fetch)) {
            # Declaramos la variables de sesion

            $_SESSION['id'] = $fetch->id;
            $_SESSION['codigo'] = $fetch->codigo;
            $_SESSION['nombre'] = $fetch->nombre;
            $_SESSION['apellido'] = $fetch->apellido;
            $_SESSION['rendimiento'] = $fetch->rendimiento;
            $_SESSION['escuela'] = $fetch->escuela;
            $_SESSION['ciclo'] = $fetch->ciclo;
            $valores=array();
            //determinamos lo accesos al usuario
		in_array(1, 1)?$_SESSION['escritorio']=1:$_SESSION['escritorio']=0;
		in_array(2, 2)?$_SESSION['almacen']=1:$_SESSION['almacen']=0;
		in_array(3, 3)?$_SESSION['compras']=1:$_SESSION['compras']=0;
		in_array(4, 4)?$_SESSION['ventas']=1:$_SESSION['ventas']=0;
		in_array(5, 5)?$_SESSION['acceso']=1:$_SESSION['acceso']=0;
		in_array(6, 6)?$_SESSION['consultac']=1:$_SESSION['consultac']=0;
		in_array(7, 7)?$_SESSION['consultav']=1:$_SESSION['consultav']=0;
        }
        echo json_encode($fetch);
        break;
}
?>