<?php 
//incluir la conexion de base de datos
require "../config/Conexion.php";
class Ciclo{


	//implementamos nuestro constructor
public function __construct(){

}

//metodo insertar regiustro
public function insertar($ciclo,$año){
	$sql="INSERT INTO cicloac (ciclo,año,condicion) VALUES ('$ciclo','$año','1')";
	return ejecutarConsulta($sql);
}

public function editar($idciclo,$ciclo,$año){
	$sql="UPDATE cicloac SET ciclo='$ciclo',año='$año' 
	WHERE id='$idciclo'";
	return ejecutarConsulta($sql);
}
public function desactivar($idciclo){
	$sql="UPDATE cicloac SET condicion='0' WHERE id='$idciclo'";
	return ejecutarConsulta($sql);
}
public function activar($idciclo){
	$sql="UPDATE cicloac SET condicion='1' WHERE id='$idciclo'";
	return ejecutarConsulta($sql);
}

//metodo para mostrar registros
public function mostrar($idciclo){
	$sql="SELECT * FROM cicloac WHERE id='$idciclo'";
	return ejecutarConsultaSimpleFila($sql);
}

//listar registros
public function listar(){
	$sql="SELECT * FROM cicloac";
	return ejecutarConsulta($sql);
}
//listar y mostrar en selct
public function select(){
	$sql="SELECT * FROM cicloac WHERE condicion=1";
	return ejecutarConsulta($sql);
}
}

 ?>
