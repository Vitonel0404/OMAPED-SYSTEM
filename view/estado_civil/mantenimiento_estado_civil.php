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
                <h1 class="m-0"><b>MANTENIMIENTO DE ESTADO CIVIL</b></h1>
            </div><!-- /.col -->

        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><b>LISTADO DE ESTADO CIVIL</b></h3>
            <button type="button" class="btn btn-danger btn-sm float-right " data-toggle="modal" data-target="#modal-registro-estado-civil"><i class="nav-icon fa fa-address-book" aria-hidden="true"></i> Nuevo Registro</button>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 table-responsive">
                    <table id="tbl-estado-civil" class="display" width="100%" style="text-align: center;">
                        
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>DENOMINACIÓN</th>
                                <th>ABREVIATURA</th>
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
<div class="modal fade" id="modal-registro-estado-civil" data-backdrop="static" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" >
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Registrar Estado Civil</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="" id="form-registrar-estado-civil">
                    <div class="row">
                        <div class="col-4">
                            <label for="">Denominación</label>
                            <input type="text" name="denominacion" id="id_denominacion_registrar" class="form-control" onkeypress="return soloLetras(event);">
                            <div id="valid_denominacion_registrar">
                            </div>
                            </br>
                        </div>
                        <div class="col-4">
                            <label for="">Abreviatura</label>
                            <input type="text" name="abreviatura" id="id_abreviatura_registrar" class="form-control" onkeypress="return soloLetras(event);" maxlength="1">
                            <div id="valid_abreviatura_registrar">
                            </div>
                            </br>
                        </div>
                        
                    </div>
                </form>
                
              
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="registrarEstadoCivil()" >REGISTRAR</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
</div>


<div class="modal fade" id="modal-modificar-estado-civil"  style="display: none;" aria-hidden="true">
        <div class="modal-dialog" >
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Modificar Estado Civil</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="" id="form-modificar-estado-civil">
                    <div class="row">
                        <div class="col-4">
                            <label for="">Denominación</label>
                            <input type="text" name="denominacion" id="id_denominacion_modificar" class="form-control" onkeypress="return soloLetras(event);">
                            <div id="valid_denominacion_modificar">
                            </div>
                            </br>
                        </div>
                        <div class="col-4">
                            <label for="">Abreviatura</label>
                            <input type="text" name="abreviatura" id="id_abreviatura_modificar" class="form-control" onkeypress="return soloLetras(event);" maxlength="1">
                            <div id="valid_abreviatura_modificar">
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
                <button type="button" class="btn btn-primary" onclick="modificarEstadoCivil()" >MODIFICAR</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
</div>
<script src="../js/estado_civil.js?rev=<?php echo time()?>"></script>