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
                <h1 class="m-0"><b>MANTENIMIENTO DE PERSONA</b></h1>
            </div><!-- /.col -->

        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><b>LISTADO DE PERSONAS</b></h3>
            <button type="button" class="btn btn-danger btn-sm float-right " data-toggle="modal" data-target="#modal-registro-persona"><i class="nav-icon fa fa-address-book" aria-hidden="true"></i> Nuevo Registro</button>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 table-responsive">
                    <table id="tbl-persona" class="display" width="100%" style="text-align: center;">
                        
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>DNI</th>
                                <th>NOMBRE</th>
                                <th>A. PAT</th>
                                <th>A. MAT</th>
                                <th>FECHA NAC</th>
                                <th>SEXO</th>
                                <th>TELÉFONO</th>
                                <th>CORREO</th>
                                <th>N° CERTEF</th>
                                <th>T. PERSONA</th>
                                <th>ESTADO</th>
                                <th>DEPENDIENTE</th>
                                <th>ESTADO CIVIL</th>
                                <th>GRADO INST</th>
                                <th>LOCALIDAD</th>
                                <th>ACCION</th>
                            </tr>
                        </thead>

                    </table>
                </div>


            </div>
        </div>

    </div>
</div>
<div class="modal fade" id="modal-registro-persona" data-backdrop="static" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-xl" >
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Registrar Persona</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="" id="form-registrar-persona">
                    <div class="row">

                        <div class="col-3">
                            <label for="">DNI</label>
                            <input type="text" name="dni" id="id_dni_registrar" class="form-control" onkeypress="return soloNumeros(event);">
                            <div id="valid_dni_registrar">
                            </div>
                            </br>
                        </div> 
                        <div class="col-3">
                            <label for="">Nombre</label>
                            <input type="text" name="nombre" id="id_nombre_registrar" class="form-control" onkeypress="return soloLetras(event);">
                            <div id="valid_nombre_registrar">
                            </div>
                            </br>
                        </div> 
                        <div class="col-3">
                            <label for="">Apellido Paterno</label>
                            <input type="text" name="apepat" id="id_apepat_registrar" class="form-control" onkeypress="return soloLetras(event);">
                            <div id="valid_apepat_registrar">
                            </div>
                            </br>
                        </div>
                        <div class="col-3">
                            <label for="">Apellido Materno</label>
                            <input type="text" name="apemat" id="id_apemat_registrar" class="form-control" onkeypress="return soloLetras(event);">
                            <div id="valid_apemat_registrar">
                            </div>
                            </br>
                        </div>
                        <div class="col-3">
                            <label for="">Fecha de Nac</label>
                            <input type="date" name="fechanac" id="id_fechanac_registrar" class="form-control">
                            <div id="valid_fechanac_registrar">
                            </div>
                            </br>
                        </div>
                        <div class="col-3">
                            <label for="">Sexo</label>
                            <select class="js-example-basic-single " name="sexo" id="id_sexo_registrar" style="width:100%">
                                <option value="M">MASCULINO</option>
                                <option value="F">FEMENINO</option>
                            </select>
                            <div id="valid_sexo_registrar">
                            </div>
                            </br>
                        </div>
                        
                        <div class="col-3">
                            <label for="">Telefono</label>
                            <input type="text" name="telefono" id="id_telefono_registrar" class="form-control" onkeypress="return soloNumeros(event);">
                            <div id="valid_telefono_registrar">
                            </div>
                            </br>
                        </div>

                        <div class="col-3">
                            <label for="">Correo</label>
                            <input type="text" name="correo" id="id_correo_registrar" class="form-control">
                            <div id="valid_correo_registrar">
                            </div>
                            </br>
                        </div>
                        <div class="col-2">
                            <label for="">N° certificado Disc</label>
                            <input type="text" name="numcertdisc" id="id_numcertdisc_registrar" class="form-control" onkeypress="return soloNumeros(event);">
                            <div id="valid_numcertdisc_registrar">
                            </div>
                            </br>
                        </div>

                        <div class="col-3">
                            <label for="">Tipo Persona</label>
                            <select class="js-example-basic-single " name="tipo" id="id_tipo_registrar" style="width:100%">
                                <option value="M">DISCAPACITADO(A)</option>
                                <option value="F">REPRESENTANTE</option>
                            </select>
                            <div id="valid_tipo_registrar">
                            </div>
                            </br>
                        </div>

                        <div class="col-2">
                            <label for="">Estado</label>
                            <select class="js-example-basic-single " name="estado" id="id_estado_registrar" style="width:100%">
                                <option value="A">ACTIVO</option>
                                <option value="I">INACTIVO</option>
                            </select>
                            <div id="valid_estado_registrar">
                            </div>
                            </br>
                        </div>

                        <div class="col-2">
                            <label for="">Dependiente</label>
                            <input type="text" name="dependiente" id="id_dependiente_registrar" class="form-control" onkeypress="return soloNumeros(event);">
                            <div id="valid_dependiente_registrar">
                            </div>
                            </br>
                        </div>

                        <div class="col-3">
                            <label for="">Estado Civil</label>
                            <select class="js-example-basic-single " name="estado_civil" id="id_estado_civil_registrar" style="width:100%">
                                
                            </select>
                            <div id="valid_estado_civil_registrar">
                            </div>
                            </br>
                        </div>
                        <div class="col-3">
                            <label for="">Grado Instrucción</label>
                            <select class="js-example-basic-single " name="grado_instruccion" id="id_grado_instruccion_registrar" style="width:100%">
                                
                            </select>
                            <div id="valid_grado_instruccion_registrar">
                            </div>
                            </br>
                        </div>

                        <div class="col-4">
                            <label for="">Provincia</label>
                            <select class="js-example-basic-single " name="provincia" id="id_provincia_registrar" style="width:100%">
                                
                            </select>
                            <div id="valid_provincia_registrar">
                            </div>
                            </br>
                        </div>

                        <div class="col-4">
                            <label for="">Distrito</label>
                            <select class="js-example-basic-single " name="distrito" id="id_distrito_registrar" style="width:100%">
                                
                            </select>
                            <div id="valid_distrito_registrar">
                            </div>
                            </br>
                        </div>

                    </div>
                </form>
                
              
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="registrarPersona()" >REGISTRAR</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
</div>


<div class="modal fade" id="modal-modificar-persona"  style="display: none;" aria-hidden="true">
        <div class="modal-dialog" >
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Modificar Persona</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="" id="form-modificar-persona">
                    <div class="row">

                        <div class="col-3">
                            <label for="">DNI</label>
                            <input type="text" name="dni" id="id_dni_modificar" class="form-control" onkeypress="return soloNumeros(event);">
                            <div id="valid_dni_modificar">
                            </div>
                            </br>
                        </div> 
                        <div class="col-3">
                            <label for="">Nombre</label>
                            <input type="text" name="nombre" id="id_nombre_modificar" class="form-control" onkeypress="return soloLetras(event);">
                            <div id="valid_nombre_modificar">
                            </div>
                            </br>
                        </div> 
                        <div class="col-3">
                            <label for="">Apellido Paterno</label>
                            <input type="text" name="apepat" id="id_apepat_modificar" class="form-control" onkeypress="return soloLetras(event);">
                            <div id="valid_apepat_modificar">
                            </div>
                            </br>
                        </div>
                        <div class="col-3">
                            <label for="">Apellido Materno</label>
                            <input type="text" name="apemat" id="id_apemat_modificar" class="form-control" onkeypress="return soloLetras(event);">
                            <div id="valid_apemat_modificar">
                            </div>
                            </br>
                        </div>
                        <div class="col-3">
                            <label for="">Fecha de Nac</label>
                            <input type="date" name="fechanac" id="id_fechanac_modificar" class="form-control">
                            <div id="valid_fechanac_modificar">
                            </div>
                            </br>
                        </div>
                        <div class="col-3">
                            <label for="">Sexo</label>
                            <select class="js-example-basic-single " name="sexo" id="id_sexo_modificar" style="width:100%">
                                <option value="M">MASCULINO</option>
                                <option value="F">FEMENINO</option>
                            </select>
                            <div id="valid_sexo_modificar">
                            </div>
                            </br>
                        </div>
                        
                        <div class="col-3">
                            <label for="">Telefono</label>
                            <input type="text" name="telefono" id="id_telefono_modificar" class="form-control" onkeypress="return soloNumeros(event);">
                            <div id="valid_telefono_modificar">
                            </div>
                            </br>
                        </div>

                        <div class="col-3">
                            <label for="">Correo</label>
                            <input type="text" name="correo" id="id_correo_modificar" class="form-control">
                            <div id="valid_correo_modificar">
                            </div>
                            </br>
                        </div>
                        <div class="col-2">
                            <label for="">N° certificado Disc</label>
                            <input type="text" name="numcertdisc" id="id_numcertdisc_modificar" class="form-control" onkeypress="return soloNumeros(event);">
                            <div id="valid_numcertdisc_modificar">
                            </div>
                            </br>
                        </div>

                        <div class="col-3">
                            <label for="">Tipo Persona</label>
                            <select class="js-example-basic-single " name="tipo" id="id_tipo_modificar" style="width:100%">
                                <option value="M">DISCAPACITADO(A)</option>
                                <option value="F">REPRESENTANTE</option>
                            </select>
                            <div id="valid_tipo_modificar">
                            </div>
                            </br>
                        </div>

                        <div class="col-2">
                            <label for="">Estado</label>
                            <select class="js-example-basic-single " name="estado" id="id_estado_modificar" style="width:100%">
                                <option value="A">ACTIVO</option>
                                <option value="I">INACTIVO</option>
                            </select>
                            <div id="valid_estado_modificar">
                            </div>
                            </br>
                        </div>

                        <div class="col-2">
                            <label for="">Dependiente</label>
                            <input type="text" name="dependiente" id="id_dependiente_modificar" class="form-control" onkeypress="return soloNumeros(event);">
                            <div id="valid_dependiente_modificar">
                            </div>
                            </br>
                        </div>

                        <div class="col-3">
                            <label for="">Estado Civil</label>
                            <select class="js-example-basic-single " name="estado_civil" id="id_estado_civil_modificar" style="width:100%">
                                
                            </select>
                            <div id="valid_estado_civil_modificar">
                            </div>
                            </br>
                        </div>
                        <div class="col-3">
                            <label for="">Grado Instrucción</label>
                            <select class="js-example-basic-single " name="grado_instruccion" id="id_grado_instruccion_modificar" style="width:100%">
                                
                            </select>
                            <div id="valid_grado_instruccion_modificar">
                            </div>
                            </br>
                        </div>

                        <div class="col-4">
                            <label for="">Provincia</label>
                            <select class="js-example-basic-single " name="provincia" id="id_provincia_modificar" style="width:100%">
                                
                            </select>
                            <div id="valid_provincia_modificar">
                            </div>
                            </br>
                        </div>

                        <div class="col-4">
                            <label for="">Distrito</label>
                            <select class="js-example-basic-single " name="distrito" id="id_distrito_modificar" style="width:100%">
                                
                            </select>
                            <div id="valid_distrito_modificar">
                            </div>
                            </br>
                        </div>

                    </div>
                </form>
                
              
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="modificarPersona()" >MODIFICAR</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
</div>
<script src="../js/persona.js?rev=<?php echo time()?>"></script>
