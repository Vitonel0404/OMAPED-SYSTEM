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
                                <th>SEXO</th>
                                <th>TELÉFONO</th>
                                <th>T. PERSONA</th>
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
                <div>

                    <ul class="nav nav-tabs">
                        <li class="nav-item" >
                            <a href="#tutor" class="nav-link active" role="tab" data-toggle="tab">Tutor</a>
                        </li>
                        <li class="nav-item">
                            <a href="#beneficiario" class="nav-link" role="tab" data-toggle="tab">Beneficiario</a>
                        </li>
                    </ul>

                    <div class="tab-content">

                        <div role="tabpanel" class="tab-pane in active" id="tutor">
                            <br>
                            <form action="" id="form-registrar-persona-tutor">
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
                                        <label for="">Fecha de Nacimiento</label>
                                        <input type="date" name="fechanac" id="id_fechanac_registrar" class="form-control">
                                        <div id="valid_fechanac_registrar">
                                        </div>
                                        </br>
                                    </div>
                                    <div class="col-3">
                                        <label for="">Sexo</label>
                                        <select class="js-example-basic-single " name="sexo" id="id_sexo_registrar" style="width:100%">
                                            <option value=0>SELECCIONE</option>
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

                                    <div class="col-3">
                                        <label for="">Provincia</label>
                                        <select class="js-example-basic-single" name="provincia" id="id_provincia_registrar" onchange="listarDistritoXprovinciaTutor()" style="width:100%">
                                            
                                        </select>
                                        <div id="valid_provincia_registrar">
                                        </div>
                                        </br>
                                    </div>

                                    <div class="col-3">
                                        <label for="">Distrito</label>
                                        <select class="js-example-basic-single " name="distrito" id="id_distrito_registrar" style="width:100%">
                                            
                                        </select>
                                        <div id="valid_distrito_registrar">
                                        </div>
                                        </br>
                                    </div>

                                </div>
                            </form>
                            <hr>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" onclick="registrarRepresentante()" >REGISTRAR</button>
                            </div>
                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="beneficiario">
                            <br>
                            <div class="row">
                                <div class="col-4">
                                    <label for="id_dni_tutor">DNI Tutor</label>
                                    <div class="input-group input-group-md">
                                        <input type="text" class="form-control" id="id_dni_tutor">
                                        <span class="input-group-append">
                                            <button type="button" class="btn btn-info btn-flat" onclick="buscarTutor()" >Buscar</button>
                                        </span>
                                    </div>
                                </div>

                                <div class="col-8">
                                    <label for="id_nombre_tutor">Nombres del Tutor</label>
                                    <input class="form-control" type="text" name="" id="id_nombre_tutor" >
                                </div>
                            </div>

                            <hr>

                            <form action="" id="form-registrar-persona-beneficiario">
                                <div class="row">
                                    <div class="col-3">
                                        <label for="">DNI</label>
                                        <input type="text" name="dni_beneficiario" id="id_dni_registrar_beneficiario" class="form-control" onkeypress="return soloNumeros(event);">
                                        <div id="valid_dni_registrar_beneficiario">
                                        </div>
                                        </br>
                                    </div> 
                                    <div class="col-3">
                                        <label for="">Nombre</label>
                                        <input type="text" name="nombre_beneficiario" id="id_nombre_registrar_beneficiario" class="form-control" onkeypress="return soloLetras(event);">
                                        <div id="valid_nombre_registrar_beneficiario">
                                        </div>
                                        </br>
                                    </div> 
                                    <div class="col-3">
                                        <label for="">Apellido Paterno</label>
                                        <input type="text" name="apepat_beneficiario" id="id_apepat_registrar_beneficiario" class="form-control" onkeypress="return soloLetras(event);">
                                        <div id="valid_apepat_registrar_beneficiario">
                                        </div>
                                        </br>
                                    </div>
                                    <div class="col-3">
                                        <label for="">Apellido Materno</label>
                                        <input type="text" name="apemat_beneficiario" id="id_apemat_registrar_beneficiarios" class="form-control" onkeypress="return soloLetras(event);">
                                        <div id="valid_apemat_registrar_beneficiario">
                                        </div>
                                        </br>
                                    </div>
                                    <div class="col-3">
                                        <label for="">Fecha de Nacimiento</label>
                                        <input type="date" name="fechanac_beneficiario" id="id_fechanac_registrar_beneficiario" class="form-control">
                                        <div id="valid_fechanac_registrar_beneficiario">
                                        </div>
                                        </br>
                                    </div>
                                    <div class="col-3">
                                        <label for="">Sexo</label>
                                        <select class="js-example-basic-single " name="sexo_beneficiario" id="id_sexo_registrar_beneficiario" style="width:100%">
                                            <option value=0>SELECCIONE</option>
                                            <option value="M">MASCULINO</option>
                                            <option value="F">FEMENINO</option>
                                        </select>
                                        <div id="valid_sexo_registrar_beneficiario">
                                        </div>
                                        </br>
                                    </div>
                                    
                                    <div class="col-3">
                                        <label for="">Telefono</label>
                                        <input type="text" name="telefono_beneficiario" id="id_telefono_registrar_beneficiario" class="form-control" onkeypress="return soloNumeros(event);">
                                        <div id="valid_telefono_registrar_beneficiario">
                                        </div>
                                        </br>
                                    </div>

                                    <div class="col-3">
                                        <label for="">Correo</label>
                                        <input type="text" name="correo_beneficiario" id="id_correo_registrar_beneficiario" class="form-control">
                                        <div id="valid_correo_registrar_beneficiario">
                                        </div>
                                        </br>
                                    </div>
                                    <div class="col-2">
                                        <label for="">N° certificado Disc</label>
                                        <input type="text" name="numcertdisc_beneficiario" id="id_numcertdisc_registrar_beneficiario" class="form-control" onkeypress="return soloNumeros(event);">
                                        <div id="valid_numcertdisc_registrar_beneficiario">
                                        </div>
                                        </br>
                                    </div>

                                    <div class="col-2">
                                        <label for="">Estado Civil</label>
                                        <select class="js-example-basic-single " name="estado_civil_beneficiario" id="id_estado_civil_registrar_beneficiario" style="width:100%">
                                            
                                        </select>
                                        <div id="valid_estado_civil_registrar_beneficiario">
                                        </div>
                                        </br>
                                    </div>
                                    <div class="col-2">
                                        <label for="">Grado Instrucción</label>
                                        <select class="js-example-basic-single " name="grado_instruccion_beneficiario" id="id_grado_instruccion_registrar_beneficiario" style="width:100%">
                                            
                                        </select>
                                        <div id="valid_grado_instruccion_registrar_beneficiario">
                                        </div>
                                        </br>
                                    </div>

                                    <div class="col-3">
                                        <label for="">Provincia</label>
                                        <select class="js-example-basic-single " name="provincia_beneficiario" id="id_provincia_registrar_beneficiario" onchange="listarDistritoXprovinciaBeneficiario()" style="width:100%">
                                            
                                        </select>
                                        <div id="valid_provincia_registrar_beneficiario">
                                        </div>
                                        </br>
                                    </div>

                                    <div class="col-3">
                                        <label for="">Distrito</label>
                                        <select class="js-example-basic-single " name="distrito_beneficiario" id="id_distrito_registrar_beneficiario" style="width:100%">
                                            
                                        </select>
                                        <div id="valid_distrito_registrar_beneficiario">
                                        </div>
                                        </br>
                                    </div>

                                </div>
                            </form>
                            <hr>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" onclick="registrarBeneficiario()" >REGISTRAR</button>
                            </div>
                            
                        </div>

                    </div>

                </div>
                
                
              
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
</div>


<div class="modal fade" id="modal-modificar-representate"  style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-xl" >
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Modificar Representate</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
                <br>
                <form action="" id="form-modificar-representante">
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
                            <label for="">Fecha de Nacimiento</label>
                            <input type="date" name="fechanac" id="id_fechanac_modificar" class="form-control">
                            <div id="valid_fechanac_modificar">
                            </div>
                            </br>
                        </div>
                        <div class="col-3">
                            <label for="">Sexo</label>
                            <select class="js-example-basic-single " name="sexo" id="id_sexo_modificar" style="width:100%">
                                <option value=0>SELECCIONE</option>
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

                        <div class="col-3">
                            <label for="">Provincia</label>
                            <select class="js-example-basic-single" name="provincia" id="id_provincia_modificar" onchange="listarDistritoXprovinciaTutorModificar()" style="width:100%">
                                
                            </select>
                            <div id="valid_provincia_modificar">
                            </div>
                            </br>
                        </div>

                        <div class="col-3">
                            <label for="">Distrito</label>
                            <select class="js-example-basic-single " name="distrito" id="id_distrito_modificar" style="width:100%">
                                
                            </select>
                            <div id="valid_distrito_modificar">
                            </div>
                            </br>
                        </div>

                        <div class="col-3">
                            <label for="">Estado</label>
                            <select class="js-example-basic-single " name="estado" id="id_estado_modificar" style="width:100%">
                                <option value="A">ACTIVO</option>
                                <option value="I">INACTIVO</option>
                            </select>
                            <div id="valid_estado_modificar">
                            </div>
                            </br>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="modificarRepresentante()" >MODIFICAR</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-modificar-beneficiario"  style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-xl" >
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Modificar Beneficiario</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
                <br>
                <div class="row">
                    <div class="col-4">
                        <label for="id_dni_tutor_modificar">DNI Tutor</label>
                        <div class="input-group input-group-md">
                            <input type="text" class="form-control" id="id_dni_tutor_modificar">
                            <span class="input-group-append">
                                <button type="button" class="btn btn-info btn-flat" onclick="buscarTutorModificar()" >Buscar</button>
                            </span>
                        </div>
                    </div>

                    <div class="col-8">
                        <label for="id_nombre_tutor_modificar">Nombres del Tutor</label>
                        <input class="form-control" type="text" name="" id="id_nombre_tutor_modificar" >
                    </div>
                </div>

                <hr>
                <form action="" id="form-modificar-beneficiario">
                    <div class="row">
                        <div class="col-3">
                            <label for="">DNI</label>
                            <input type="text" name="dni" id="id_dni_modificar_beneficiario" class="form-control" onkeypress="return soloNumeros(event);">
                            <div id="valid_dni_modificar_beneficiario">
                            </div>
                            </br>
                        </div> 
                        <div class="col-3">
                            <label for="">Nombre</label>
                            <input type="text" name="nombre" id="id_nombre_modificar_beneficiario" class="form-control" onkeypress="return soloLetras(event);">
                            <div id="valid_nombre_modificar_beneficiario">
                            </div>
                            </br>
                        </div> 
                        <div class="col-3">
                            <label for="">Apellido Paterno</label>
                            <input type="text" name="apepat" id="id_apepat_modificar_beneficiario" class="form-control" onkeypress="return soloLetras(event);">
                            <div id="valid_apepat_modificar_beneficiario">
                            </div>
                            </br>
                        </div>
                        <div class="col-3">
                            <label for="">Apellido Materno</label>
                            <input type="text" name="apemat" id="id_apemat_modificar_beneficiario" class="form-control" onkeypress="return soloLetras(event);">
                            <div id="valid_apemat_modificar_beneficiario">
                            </div>
                            </br>
                        </div>
                        <div class="col-3">
                            <label for="">Fecha de Nacimiento</label>
                            <input type="date" name="fechanac" id="id_fechanac_modificar_beneficiario" class="form-control">
                            <div id="valid_fechanac_modificar_beneficiario">
                            </div>
                            </br>
                        </div>
                        <div class="col-3">
                            <label for="">Sexo</label>
                            <select class="js-example-basic-single " name="sexo" id="id_sexo_modificar_beneficiario" style="width:100%">
                                <option value=0>SELECCIONE</option>
                                <option value="M">MASCULINO</option>
                                <option value="F">FEMENINO</option>
                            </select>
                            <div id="valid_sexo_modificar_beneficiario">
                            </div>
                            </br>
                        </div>
                        
                        <div class="col-3">
                            <label for="">Telefono</label>
                            <input type="text" name="telefono" id="id_telefono_modificar_beneficiario" class="form-control" onkeypress="return soloNumeros(event);">
                            <div id="valid_telefono_modificar_beneficiario">
                            </div>
                            </br>
                        </div>

                        <div class="col-3">
                            <label for="">Correo</label>
                            <input type="text" name="correo" id="id_correo_modificar_beneficiario" class="form-control">
                            <div id="valid_correo_modificar_beneficiario">
                            </div>
                            </br>
                        </div>
                        <div class="col-2">
                            <label for="">N° certificado Disc</label>
                            <input type="text" name="numcertdisc" id="id_numcertdisc_modificar_beneficiario" class="form-control" onkeypress="return soloNumeros(event);">
                            <div id="valid_numcertdisc_modificar_beneficiario">
                            </div>
                            </br>
                        </div>

                        <div class="col-2">
                            <label for="">Estado Civil</label>
                            <select class="js-example-basic-single " name="estado_civil" id="id_estado_civil_modificar_beneficiario" style="width:100%">
                                
                            </select>
                            <div id="valid_estado_civil_modificar_beneficiario">
                            </div>
                            </br>
                        </div>
                        <div class="col-2">
                            <label for="">Grado Instrucción</label>
                            <select class="js-example-basic-single " name="grado_instruccion" id="id_grado_instruccion_modificar_beneficiario" style="width:100%">
                                
                            </select>
                            <div id="valid_grado_instruccion_modificar_beneficiario">
                            </div>
                            </br>
                        </div>

                        <div class="col-3">
                            <label for="">Provincia</label>
                            <select class="js-example-basic-single " name="provincia" id="id_provincia_modificar_beneficiario" onchange="listarDistritoXprovinciaBeneficiarioModificar()" style="width:100%">
                                
                            </select>
                            <div id="valid_provincia_modificar_beneficiario">
                            </div>
                            </br>
                        </div>

                        <div class="col-3">
                            <label for="">Distrito</label>
                            <select class="js-example-basic-single " name="distrito" id="id_distrito_modificar_beneficiario" style="width:100%">
                                
                            </select>
                            <div id="valid_distrito_modificar_beneficiario">
                            </div>
                            </br>
                        </div>
                        <div class="col-3">
                            <label for="">Estado</label>
                            <select class="js-example-basic-single " name="estado" id="id_estado_modificar_beneficiario" style="width:100%">
                                <option value="A">ACTIVO</option>
                                <option value="I">INACTIVO</option>
                            </select>
                            <div id="valid_estado_modificar_beneficiario">
                            </div>
                            </br>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="modificarBeneficiario()" >MODIFICAR</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="modal-detalle"  style="display: none;" aria-hidden="true">
        <div class="modal-dialog" >
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Más información</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <label for="fechanac" class="col-sm-4 col-form-label">Fecha de nacimiento</label>
                    <div class="col-sm-8">
                        <input type="text" readonly class="form-control-plaintext" id="fechanac" value="email@example.com">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="correo" class="col-sm-4 col-form-label">Correo</label>
                    <div class="col-sm-8">
                        <input type="text" readonly class="form-control-plaintext" id="correo" value="email@example.com">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="certificado" class="col-sm-4 col-form-label">N° Certificado</label>
                    <div class="col-sm-8">
                        <input type="text" readonly class="form-control-plaintext" id="certificado" value="email@example.com">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="representante" class="col-sm-4 col-form-label">Representante</label>
                    <div class="col-sm-8">
                        <input type="text" readonly class="form-control-plaintext" id="representante" value="email@example.com">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="estadocivil" class="col-sm-4 col-form-label">Estado Civil</label>
                    <div class="col-sm-8">
                        <input type="text" readonly class="form-control-plaintext" id="estadocivil" value="email@example.com">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="gradoinstruccion" class="col-sm-4 col-form-label">Grado de instrucción</label>
                    <div class="col-sm-8">
                        <input type="text" readonly class="form-control-plaintext" id="gradoinstruccion" value="email@example.com">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="localidad" class="col-sm-4 col-form-label">Localidad</label>
                    <div class="col-sm-8">
                        <input type="text" readonly class="form-control-plaintext" id="localidad" value="email@example.com">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
</div>
<script src="../js/persona.js?rev=<?php echo time()?>"></script>
