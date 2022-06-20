
<style>
    .select2-container .select2-selection--single {
        height: 38px !important;
    }

    .select2-selection__arrow {
        height: 38px !important;
    }
</style>

<!-- Content Header (Page header) -->

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><b>MANTENIMIENTO DE USUARIO</b></h1>
            </div><!-- /.col -->

        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><b>LISTADO DE USUARIO</b></h3>
            <button class="btn btn-danger btn-sm float-right " onclick="abrirModalRegistroUsuario()"><i class="nav-icon fa fa-address-book" aria-hidden="true"></i> Nuevo Registro</button>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 table -responsive">
                    <table id="tabla_usuario_simple" class="display" width="100%" style="text-align: center;">
                        
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>DNI</th>
                                <th>APELLIDO PATERNO</th>
                                <th>APELLIDO MATERNO</th>
                                <th>NOMBRE</th>
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
<! INICIO MODAL -->
    <div class="modal fade" id="modal_registro_usu" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registro Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-4">
                            <label for="">DNI</label>
                            <input type="text" id="txt_dni" placeholder="Ingresar DNI" class="form-control" onkeypress="return soloNumeros(event);" maxlength="8">
                            <div id="valid_dni">
                            </div>
                            </br>
                        </div>
                        <div class="col-4">
                            <label for="">NOMBRE</label>
                            <input type="text" id="txt_nombre" placeholder="Ingresar Nombres" class="form-control" onkeypress=" return soloLetras(event);">
                            <div id="valid_nombre">
                                </br>
                            </div>
                        </div>
                        <div class="col-4">
                            <label for="">APELLIDO PATERNO</label>
                            <input type="text" id="txt_aPaterno" placeholder="Ingresar Apellido Paterno" class="form-control" onkeypress=" return soloLetras(event);">
                            <div id="valid_apepat">
                                </br>
                            </div>
                        </div>

                        <div class="col-4">
                            <label for="">APELLIDO MATERNO</label>
                            <input type="text" id="txt_aMaterno" placeholder="Ingresar Apellido Materno" class="form-control" onkeypress=" return soloLetras(event);">
                            <div id="valid_apemat">
                                </br>
                            </div>
                        </div>
                        <div class="col-4">
                            <label for="">CONTRASEÑA </label>
                            <input type="password" id="txt_contraseña" placeholder="Ingresar Contraseña" class="form-control">
                            <div id="valid_contrasena">
                                </br>
                            </div>
                        </div>
                        <div class="col-4">
                            <label for="">NIVEL</label>
                            <select class="js-example-basic-single " id="select_nivel" style="width:100%">
                                <option value="">SELECCIONE UN NIVEL</option>
                                <option value="ADMIN">ADMIN</option>
                                <option value="OPERADOR">OPERADOR</option>
                                <option value="VISITANTE">VISITANTE</option>
                            </select>
                            <div id="valid_nivel">
                            </div>

                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="registrar_usuario()">REGISTRAR</button>
                </div>
            </div>
        </div>
    </div>
    <! FINAL MODAL -->
        <! INICIO MODAL -->
            <div class="modal fade" id="modal_editar_usuario" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Editar Usuarios</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-4">
                                    <label for="">DNI</label>
                                    <input type="text" id="txt_idUsu_editar" hidden>
                                    <input type="text" id="txt_dni_editar" placeholder="Ingresar DNI" class="form-control" onkeypress="return soloNumeros(event);" maxlength="8">
                                    <div id="valid_dni_editar">
                                    </div>
                                    </br>
                                </div>
                                <div class="col-4">
                                    <label for="">NOMBRE</label>
                                    <input type="text" id="txt_nombre_editar" placeholder="Ingresar Nombres" class="form-control" onkeypress=" return soloLetras(event);">
                                    <div id="valid_nombre_editar">
                                    </div>
                                    </br>
                                </div>
                                <div class="col-4">
                                    <label for="">APELLIDO PATERNO</label>
                                    <input type="text" id="txt_aPaterno_editar" placeholder="Ingresar Apellido Paterno" class="form-control" onkeypress=" return soloLetras(event);">
                                    <div id="valid_apepat_editar">
                                    </div>
                                    </br>
                                </div>

                                <div class="col-4">
                                    <label for="">APELLIDO MATERNO</label>
                                    <input type="text" id="txt_aMaterno_editar" placeholder="Ingresar Apellido Materno" class="form-control" onkeypress=" return soloLetras(event);">
                                    <div id="valid_apemat_editar">
                                    </div>
                                    </br>
                                </div>
                                <div class="col-4">
                                    <label for="">NIVEL</label>
                                    <select class="js-example-basic-single " id="select_nivel_editar" style="width:100%">
                                        <option value="ADMIN">ADMIN</option>
                                        <option value="OPERADOR">OPERADOR</option>
                                        <option value="VISITANTE">VISITANTE</option>
                                    </select>
                                    <div id="valid_nivel_editar">
                                    </div>
                                    </br>
                                </div>

                                <div class="col-6">
                                    <label for="">CONTRASEÑA </label>
                                    <input type="password" id="txt_contra_editar" placeholder="Ingresar Contraseña" disabled class="form-control">

                                    <div id="valid_contra_editar">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label for="">&nbsp;</label>
                                    <button class='btn btn-primary' style="width:100%" onclick="abrirmodal_modificarcontra()"><i class='fa fa-edit'></i>
                                        EDIT PASSWORD
                                    </button>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="modificar_usuario()">MODIFICAR</button>
                        </div>
                    </div>
                </div>
            </div>
            <! FINAL MODAL -->
                <! INICIO MODAL -->
                    <! FINAL MODAL -->
                        <div class="modal fade" id="modal_editar_contra" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Editar Contraseña del usuario
                                            <label for="" id="lbl_usuario_contra"></label>
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <input type="text" id="idUsuarioContra" hidden>

                                                <label for="">CONTRASEÑA NUEVA </label>
                                                <input type="password" id="txt_contra_nueva" class="form-control">
                                            </div>
                                            <div class="col-12">

                                                <label for="">REPETIR CONTRASEÑA </label>
                                                <input type="password" id="txt_contra_repetir" class="form-control">
                                            </div>


                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" onclick="modificar_contra_usuario()">MODIFICAR</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script src="../js/usuario.js?rev=<?php echo time() ///para recgar el js 
                                    ?>"></script>
                        <script>
                            
                            //cargar_select_rol();
                            //INICIALIZO MI SELECT2-->
                            /*$(document).ready(function() {
                                $('.js-example-basic-single').select2();

                            });*/
                            /*document.getElementById("txt_foto_editar").addEventListener("change", () => {
                                var fileName = document.getElementById("txt_foto_editar").value;
                                var idxDot = fileName.lastIndexOf(".") + 1;
                                var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
                                if (extFile == "jpg" || extFile == "jpeg" || extFile == "png") {
                                    //TO DO
                                } else {
                                    Swal.fire("MENSAJE DE ADVERTENCIA", "SOLO SE ACEPTAN IMAGENES-USTED SUBIO UN ARCHIVO CON EXTESION " + extFile,
                                        "warning ");
                                    document.getElementById("txt_foto_editar").value = "";
                                }
                            });
                            document.getElementById("txt_foto").addEventListener("change", () => {
                                var fileName = document.getElementById("txt_foto").value;
                                var idxDot = fileName.lastIndex0f(".") + 1;
                                var extFile = fileName.substr(idxDot, fileName.length).tolowerCase();
                                if (extFile == "jpg" || extFile == "jpeg" || extFile == "png") {
                                    //TO DO
                                } else {
                                    Swal.fire("MENSAJE DE ADVERTENCIA", "SOLO SE ACEPTAN IMAGENES-USTED SUBIO UN ARCHIVO CON EXTESION " + extFile,
                                        "warning ");
                                    document.getElementById("txt_foto").value = "";
                                }
                            });*/
                        </script>