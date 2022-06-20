<style>
    .select2-container .select2-selection--single {
        height: 38px !important;
    }

    .select2-selection__arrow {
        height: 38px !important;
    }
</style>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><b>MANTENIMIENTO DE GRADO DE INSTRUCCION</b></h1>
            </div><!-- /.col -->

        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><b>LISTADO DE GRADO DE INSTRUCCION</b></h3>
            <button type="button" class="btn btn-danger btn-sm float-right " data-toggle="modal" data-target="#modal-registro-grado-instruccion"><i class="nav-icon fa fa-address-book" aria-hidden="true"></i> Nuevo Registro</button>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 table-responsive">
                    <table id="tbl-grado-instruccion" class="display" width="100%" style="text-align: center;">
                        
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>DENOMINACIÓN</th>
                                <th>ESTADO</th>
                                <th>ACCION</th>
                            </tr>
                        </thead>

                    </table>
                </div>


            </div>
        </div>

    </div>
</div>
<div class="modal fade" id="modal-registro-grado-instruccion" data-backdrop="static" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" >
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Registrar Grado de Instrucción</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="" id="form-registrar-grado-instruccion">
                    <div class="row">
                        <div class="col-4">
                            <label for="">Denominación</label>
                            <input type="text" name="denominacion" id="id_denominacion_registrar" class="form-control" onkeypress="return soloLetras(event);">
                            <div id="valid_denominacion_registrar">
                            </div>
                            </br>
                        </div>        
                    </div>
                </form>
                
              
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="registrarGradoInstruccion()" >REGISTRAR</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
</div>


<div class="modal fade" id="modal-modificar-grado-instruccion"  style="display: none;" aria-hidden="true">
        <div class="modal-dialog" >
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Modificar Grado de Instrucción</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="" id="form-modificar-grado-instruccion">
                    <div class="row">
                        <div class="col-4">
                            <label for="">Denominación</label>
                            <input type="text" name="denominacion" id="id_denominacion_modificar" class="form-control" onkeypress="return soloLetras(event);">
                            <div id="valid_denominacion_modificar">
                            </div>
                            </br>
                        </div>
                        <div class="col-4">
                            <label for="">Estado</label>
                            <select class="js-example-basic-single " name="estado" id="id_estado_editar" style="width:100%">
                                <option value="A">ACTIVO</option>
                                <option value="I">INACTIVO</option>
                            </select>
                            <div id="valid_estado_editar">
                            </div>
                            </br>
                        </div>
                        
                    </div>
                </form>
                
              
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="modificarGradoInstruccion()" >MODIFICAR</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
</div>
<script src="../js/grado_instruccion.js?rev=<?php echo time()?>"></script>