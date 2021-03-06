<?php 
//incluir la conexion de base de datos
require "../config/Conexion.php";
class Usuario{


	//implementamos nuestro constructor
public function __construct(){

}

//metodo insertar regiustro
public function insertar($nombre,$tipo_documento,$num_documento,$direccion,$telefono,$email,$cargo,$login,$clave,$imagen,$permisos){
	$sql="INSERT INTO usuario (nombre,tipo_documento,num_documento,direccion,telefono,email,cargo,login,clave,imagen,condicion) VALUES ('$nombre','$tipo_documento','$num_documento','$direccion','$telefono','$email','$cargo','$login','$clave','$imagen','1')";
	//return ejecutarConsulta($sql);
	 $idusuarionew=ejecutarConsulta_retornarID($sql);
	 $num_elementos=0;
	 $sw=true;
	 while ($num_elementos < count($permisos)) {

	 	$sql_detalle="INSERT INTO usuario_permiso (idusuario,idpermiso) VALUES('$idusuarionew','$permisos[$num_elementos]')";

	 	ejecutarConsulta($sql_detalle) or $sw=false;

	 	$num_elementos=$num_elementos+1;
	 }
	 return $sw;
}

public function editar($idusuario,$nombre,$tipo_documento,$num_documento,$direccion,$telefono,$email,$cargo,$login,$clave,$imagen,$permisos){
	$sql="UPDATE usuario SET nombre='$nombre',tipo_documento='$tipo_documento',num_documento='$num_documento',direccion='$direccion',telefono='$telefono',email='$email',cargo='$cargo',login='$login',clave='$clave',imagen='$imagen' 
	WHERE idusuario='$idusuario'";
	 ejecutarConsulta($sql);

	 //eliminar permisos asignados
	 $sqldel="DELETE FROM usuario_permiso WHERE idusuario='$idusuario'";
	 ejecutarConsulta($sqldel);

	 	 $num_elementos=0;
	 $sw=true;
	 while ($num_elementos < count($permisos)) {

	 	$sql_detalle="INSERT INTO usuario_permiso (idusuario,idpermiso) VALUES('$idusuario','$permisos[$num_elementos]')";

	 	ejecutarConsulta($sql_detalle) or $sw=false;

	 	$num_elementos=$num_elementos+1;
	 }
	 return $sw;
}
public function desactivar($idusuario){
	$sql="UPDATE usuario SET condicion='0' WHERE idusuario='$idusuario'";
	return ejecutarConsulta($sql);
}
public function activar($idusuario){
	$sql="UPDATE usuario SET condicion='1' WHERE idusuario='$idusuario'";
	return ejecutarConsulta($sql);
}

//metodo para mostrar registros
public function mostrar($idusuario){
	$sql="SELECT * FROM usuario WHERE idusuario='$idusuario'";
	return ejecutarConsultaSimpleFila($sql);
}

//listar registros
public function listar($idt){
	$sql="select  alumno.codigo ,concat_ws('  ',alumno.nombre,alumno.apellido)as alumno ,curso.nombre as curso,escuela.nombre as escuela,tutoria.fecha from tutoria
inner join alumno on  tutoria.alummno=alumno.id
inner join curso on  tutoria.curso=curso.id 
inner join  escuela on curso.escuela=escuela.id
where tutoria.usuario='$idt'";
	return ejecutarConsulta($sql);
}

//metodo para listar permmisos marcados de un usuario especifico
public function listarmarcados($login,$clave){
	
$sql11="SELECT id,nombre,apellido,email,nivel from usuario where login='$login' and clave='$clave' AND condicion='1'";
	 return ejecutarConsulta($sql11);
}
public function listarcurso($is){
	$sql="select curso.nombre as curso from tutoria inner  join  curso  on tutoria.curso=curso.id where tutoria.usuario='$is' group by curso.nombre";
	return ejecutarConsulta($sql);
}

//funcion que verifica el acceso al sistema

public function verificar($login,$clave){
    
$sql1="SELECT  a.id,a.codigo , a.nombre,a.apellido,a.rendimiento,e.nombre  as escuela,ca.ciclo ,a.escuela as idescuela from alumno a
inner join escuela e  on a.escuela=e.id inner join cicloac ca on a.ciclo=ca.id 
where  a.usuario='$login'and a.clave='$clave' and a.condicion='1'";
    return ejecutarConsulta($sql1);}
  public function verificarr($login,$clave){

$sql="SELECT id,nombre,apellido,email,nivel from usuario where login='$login' and clave='$clave' AND condicion='1'";
	 return ejecutarConsulta($sql);
}  
}




 ?>
