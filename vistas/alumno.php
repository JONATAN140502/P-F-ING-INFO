<?php 
//activamos almacenamiento en el buffer
ob_start();
session_start();
if (!isset($_SESSION['nombre'])) {
  header("Location: login.html");
}else{

require 'header.php';
if ($_SESSION['almacen']==1) {
 ?>
    <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="row">
        <div class="col-md-12">
      <div class="box">
<div class="box-header with-border">
  <h1 class="box-title">Alumnos<button class="btn btn-success" onclick="mostrarform(true)" id="btnagregar"><i class="fa fa-plus-circle"></i>Agregar</button> <a target="_blank" href="../reportes/rptarticulos.php"><button class="btn btn-info">Reporte</button></a></h1>
  <div class="box-tools pull-right">
    
  </div>
</div>
<!--box-header-->
<!--centro-->
<div class="panel-body table-responsive" id="listadoregistros">
  <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
    <thead>
      <th>Opciones</th>
       <th>Codigo</th>
       <th>Nombres </th>
      <th>Apellidos</th>
      <th>Rendimiento</th>
      <th>Escuela</th>
      <th>Ciclo</th>
      <th>Estado</th>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
      <th>Opciones</th>
       <th>Codigo</th>
       <th>Nombres </th>
      <th>Apellidos</th>
      <th>Rendimiento</th>
      <th>Escuela</th>
      <th>Ciclo</th>
      <th>Estado</th>
    </tfoot>   
  </table>
</div>
<div class="panel-body" id="formularioregistros">
  <form action="" name="formulario" id="formulario" method="POST">
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">NOMBRE:</label>
      <input class="form-control" type="hidden" name="idalumno" id="idalumno">
      <input class="form-control" type="text" name="nombre" id="nombre" maxlength="100" placeholder="Nombres" required>
    </div>
        <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">AELLIDO:</label>
     
      <input class="form-control" type="text" name="apellido" id="apellido" maxlength="100" placeholder="Apellidos" required>
    </div>
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">ESCUELA:</label>
      <select name="idescuela" id="idescuela" class="form-control selectpicker" data-Live-search="true" required></select>
    </div>
      <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">CICLO ACADEMICO:</label>
      <select name="idciclo" id="idciclo" class="form-control selectpicker" data-Live-search="true" required></select>
    </div>
      <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">RENDIMIENTO ACADEMICO:</label>
      <select name="idrendimiento" id="idrendimiento" class="form-control selectpicker" data-Live-search="true" required>
          <option value="insatisfactorio">INSATISFACTORIO</option>
           <option value="satisfactorio">SATISFACTORIO</option>
           <option value="alto">ALTO</option>
      </select>
    </div>
      
        
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">CODIGO</label>
      <input class="form-control" type="text" name="codigo" id="codigo" placeholder="codigo del alumno" required>
      <button class="btn btn-success" type="button" onclick="generarbarcode()">Generar</button>
      <button class="btn btn-info" type="button" onclick="imprimir()">Imprimir</button>
      <div id="print">
        <svg id="barcode"></svg>
      </div>
    </div>
    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i>  Guardar</button>

      <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
    </div>
  </form>
</div>
<!--fin centro-->
      </div>
      </div>
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
<?php 
}else{
 require 'noacceso.php'; 
}
require 'footer.php'
 ?>
 <script src="../public/js/JsBarcode.all.min.js"></script>
 <script src="../public/js/jquery.PrintArea.js"></script>
 <script src="scripts/alumno.js"></script>

 <?php 
}

ob_end_flush();
  ?>