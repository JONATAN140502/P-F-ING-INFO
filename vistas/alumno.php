<?php
//activamos almacenamiento en el buffer
ob_start();
session_start();
if (!isset($_SESSION['nombre'])) {
  header("Location: login.html");
}else{


require 'header.php';
?>
   <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="row">
        <div class="col-md-12">
      <div class="box">
<!--<div class="box-header with-border">
  <h1 class="box-title">TUTORIA <button class="btn btn-success" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i>REGISTRAR</button></h1>
  <div class="box-tools pull-right">
    
  </div>
</div>-->
<!--box-header-->
<!--centro-->
<div class="panel-body table-responsive" id="listadoregistros1">
  <table id="tbllistado1" class="table table-striped table-bordered table-condensed table-hover">
    <thead>
      <th>CODIGO</th>
      <th>NOMBRE</th>
      <th>APELLIDO</th>
      <th>RENDIMIENTO</th>
      <th>ESCUELA</th>
      <th>CICLO</th>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
     <th>CODIGO</th>
      <th>NOMBRE</th>
      <th>APELLIDO</th>
      <th>RENDIMIENTO</th>
      <th>ESCUELA</th>
      <th>CICLO</th>
    </tfoot>   
  </table>
</div>
<div class="panel-body txt-center" style="height: 400px;" id="formularioregistros">
  <form action="" name="formulario" id="formulario" method="POST">
     <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">CURSO:</label>
      <select name="curso" id="curso" class="form-control selectpicker" data-Live-search="true" required></select>
    </div>
      <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">TUTOR:</label>
      <select name="tutor" id="tutor" class="form-control selectpicker" data-Live-search="true" required></select>
    </div>
     <div class="form-group col-lg-4 col-md-4 col-xs-12">
      <label for="">Fecha(*): </label>
      <input class="form-control" type="date" name="fecha_hora" id="fecha_hora" required>
    </div>
       <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i>  Guardar</button>
      <button class="btn btn-danger" onclick="cancelarform()" type="button" id="btnCancelar"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
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

  <!--Modal-->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 65% !important;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Seleccione un Articulo</h4>
        </div>
        <div class="modal-body">
          <table id="tblarticulos" class="table table-striped table-bordered table-condensed table-hover">
            <thead>
              <th>Opciones</th>
              <th>Nombre</th>
              <th>Categoria</th>
              <th>Código</th>
              <th>Stock</th>
              <th>Precio Venta</th>
              <th>Imagen</th>
            </thead>
            <tbody>
              
            </tbody>
            <tfoot>
              <th>Opciones</th>
              <th>Nombre</th>
              <th>Categoria</th>
              <th>Código</th>
              <th>Stock</th>
              <th>Precio Venta</th>
              <th>Imagen</th>
            </tfoot>
          </table>
        </div>
        <div class="modal-footer">
          <button class="btn btn-default" type="button" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
 
<?php 


require 'footer.php';
 ?>
    <script src="scripts/venta.js"></script>
 <script src="../public/js/Chart.bundle.min.js"></script>
 <script src="../public/js/Chart.min.js"></script>
 
 <?php 
}

ob_end_flush();
  ?>

