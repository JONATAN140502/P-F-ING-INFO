<?php 
//incluir la conexion de base de datos
require "../config/Conexion.php";
class Escuela{


	//implementamos nuestro constructor
public function __construct(){

}

//metodo insertar regiustro
public function insertar($nombre){
	$sql="INSERT INTO escuela (nombre,condicion) VALUES ('$nombre','1')";
	return ejecutarConsulta($sql);
}

public function editar($idescuela,$nombre){
	$sql="UPDATE escuela SET nombre='$nombre'
	WHERE id='$idescuela'";
	return ejecutarConsulta($sql);
}
public function desactivar($idescuela){
	$sql="UPDATE escuela SET condicion='0' WHERE id='$idescuela'";
	return ejecutarConsulta($sql);
}
public function activar($idescuela){
	$sql="UPDATE escuela SET condicion='1' WHERE id='$idescuela'";
	return ejecutarConsulta($sql);
}

//metodo para mostrar registros
public function mostrar($idescuela){
	$sql="SELECT * FROM escuela WHERE id='$idescuela'";
	return ejecutarConsultaSimpleFila($sql);
}

//listar registros
public function listar(){
	$sql="SELECT * FROM escuela";
	return ejecutarConsulta($sql);
}
//listar y mostrar en selct
public function select(){
	$sql="SELECT * FROM escuela WHERE condicion=1";
	return ejecutarConsulta($sql);
}
}

 ?>
