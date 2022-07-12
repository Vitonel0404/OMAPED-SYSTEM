
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
                <h1 class="m-0"><b>TRÁMITE</b></h1>
            </div><!-- /.col -->

        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><b>LISTADO DE TRÁMITES</b></h3>
            <button type="button" class="btn btn-danger btn-sm float-right " data-toggle="modal" data-target="#modal-registro-tramite"><i class="nav-icon fa fa-address-book" aria-hidden="true"></i> Nuevo Registro</button>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 table-responsive">
                    <table id="tbl-tramite" class="display" width="100%" style="text-align: center;">
                        
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>CÓDIGO</th>
                                <th>TIPO DE TRÁMITE</th>
                                <th>FECHA REGISTRO</th>
                                <th>PERSONA</th>
                                <th>ACCION</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>

                    </table>
                </div>


            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="modal-registro-tramite"  style="display: none;" aria-hidden="true">
        <div class="modal-dialog" >
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Registrar Trámite</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="" id="form-registrar-tramite">
                    <div class="row">
                        <div class="col-6">
                            <label for="">Tipo de trámite</label>
                            <select class="js-example-basic-single " name="tipo_tramite" id="tipo_tramite_regitrar" style="width:100%">
                               
                            </select>
                            <div id="valid_tipo_tramite_registrar">
                            </div>
                            </br>
                        </div>
                        <div class="col-6">
                            <label for="">DNI</label>
                            <div class="input-group input-group-md">
                                <input type="text" class="form-control" id="dni_registrar"  onkeypress="return soloNumeros(event);">
                                <span class="input-group-append">
                                    <button type="button" class="btn btn-info btn-flat" onclick="buscarBeneficiario()">Buscar</button>
                                </span>
                            </div>
                            <div id="valid_dni_registrar">
                            </div>
                            </br>
                        </div>
                        <div class="col-12">
                            <label for="">Persona</label>
                            <input type="text" class="form-control" readonly id="persona_registrar">
                            <div id="valid_persona_registrar">
                            </div>
                            </br>
                        </div>

                        
                    </div>
                </form>
                
              
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="registrarTramite()" >REGISTRAR</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="upload"  style="display: none;" aria-hidden="true">
    <div class="modal-dialog" >
        <div class="modal-content">
            <form id="form-file" action="" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Cargar archivo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                        <h6>Trámite: <span id="id_tramite"></span></h6>            
                        <p>Seleccionar trámite archivo PDF </p>
                        <input type="file" name="file" id="file">
                        <input type="text" name="id_tram" id="id_inp_tram" hidden>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" >Close</button>
                    <button type="button" class="btn btn-primary" onclick="enviar()">SUBIR</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
</div>
<script src="../js/tramite.js?rev=<?php echo time()?>"></script>
