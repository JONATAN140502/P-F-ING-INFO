<?php 
//incluir la conexion de base de datos
require "../config/Conexion.php";
class Venta{


	//implementamos nuestro constructor
public function __construct(){

}

//metodo insertar registro
public function insertar($ides,$curso,$tutor,$fecha_hora){
	$sql="INSERT INTO tutoria(usuario,alummno,curso,fecha) VALUES ('$tutor','$ides','$curso','$fecha_hora')";
	//return ejecutarConsulta($sql);
//	 ejecutarConsulta($sql);
	
	 return ejecutarConsulta($sql);;
}



//listar registros
public function listar($id){
$sql="SELECT CONCAT_WS('  ',usuario.nombre,usuario.apellido )as Tutor ,curso.nombre as curso ,tutoria.fecha from tutoria
 inner join usuario on tutoria.usuario=usuario.id
inner join curso on tutoria.curso=curso.id where alummno='$id'";
	return ejecutarConsulta($sql);
}
public function listardatos($id1){
$sql="SELECT a.codigo,a.nombre,apellido,rendimiento,e.nombre as escuela ,a.condicion,c.ciclo as ciclo from alumno a inner join
escuela e on  a.escuela=e.id inner join cicloac c on a.ciclo=c.id where a.id='$id1'";
	return ejecutarConsulta($sql);
}

public function ventacabecera($idventa){
	$sql= "SELECT v.idventa, v.idcliente, p.nombre AS cliente, p.direccion, p.tipo_documento, p.num_documento, p.email, p.telefono, v.idusuario, u.nombre AS usuario, v.tipo_comprobante, v.serie_comprobante, v.num_comprobante, DATE(v.fecha_hora) AS fecha, v.impuesto, v.total_venta FROM venta v INNER JOIN persona p ON v.idcliente=p.idpersona INNER JOIN usuario u ON v.idusuario=u.idusuario WHERE v.idventa='$idventa'";
	return ejecutarConsulta($sql);
}

public function ventadetalles($idventa){
	$sql="SELECT a.nombre AS articulo, a.codigo, d.cantidad, d.precio_venta, d.descuento, (d.cantidad*d.precio_venta-d.descuento) AS subtotal FROM detalle_venta d INNER JOIN articulo a ON d.idarticulo=a.idarticulo WHERE d.idventa='$idventa'";
         return ejecutarConsulta($sql);
}


}

 ?>
