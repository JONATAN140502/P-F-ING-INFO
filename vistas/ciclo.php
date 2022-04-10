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
  <h1 class="box-title">Curso a Dictar </h1>
  <div class="box-tools pull-right">
    
  </div>
</div>
<!--box-header-->
<!--centro-->
<div class="panel-body table-responsive" id="listadoregistros1">
  <table id="tbllistado1" class="table table-striped table-bordered table-condensed table-hover">
    <thead>
     
      <th>curso</th>
      
    </thead>
    <tbody>
    </tbody>
    <tfoot>
        <th>Curso</th>

    </tfoot>   
  </table>
</div>
<div class="panel-body" style="height: 400px;" id="formularioregistros">
  <form action="" name="formulario" id="formulario" method="POST">
    <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">CICLO ACADEMICO</label>
      <input class="form-control" type="hidden" name="idciclo" id="idciclo">
      <input class="form-control" type="text" name="ciclo" id="ciclo" maxlength="50" placeholder="CICLO" required>
    </div>
        <div class="form-group col-lg-6 col-md-6 col-xs-12">
      <label for="">AÑO</label>
      <input class="form-control" type="text" name="año" id="año" maxlength="256" placeholder="AÑO">
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
require 'footer.php';
 ?>
<script src="scripts/usuario.js"></script>
 <?php 
}

ob_end_flush();
  ?>

