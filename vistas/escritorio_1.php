<?php
//activamos almacenamiento en el buffer
ob_start();
session_start();
if (!isset($_SESSION['nombre1'])) {
  header("Location: login1.html");
}else{


require 'header_1.php';

?>
   <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="row">
        <div class="col-md-12">
      <div class="box">
<div class="box-header with-border">
  <h1 class="box-title">ALUMNOS</h1>
  <div class="box-tools pull-right">
    
  </div>
</div>
<!--box-header-->
<!--centro-->

<div class="panel-body table-responsive" id="listadoregistros">
  <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
    <thead>
      <th>CODIGO</th>
      <th>ALUMNO</th>
      <th>CURSO</th>
      <th>ESCUELA</th>
      <th>FECHA DE REGISTRO</th>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
     <th>CODIGO</th>
      <th>ALUMNO</th>
      <th>CURSO</th>
      <th>ESCUELA</th>
      <th>FECHA DE REGISTRO</th>
    </tfoot>   
  </table>
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
  <script src="scripts/usuario.js"></script>
 <script src="../public/js/Chart.bundle.min.js"></script>
 <script src="../public/js/Chart.min.js"></script>
 
 <?php 
}

ob_end_flush();
  ?>

