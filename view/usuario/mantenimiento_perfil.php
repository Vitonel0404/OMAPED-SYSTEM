<?php
session_start();

?>
<script src="../js/usuario.js?rev=<?php echo time() ///para recgar el js 
                                    ?>"></script>
<style>
    .select2-container .select2-selection--single {
        height: 38px !important;
    }

    .select2-selection__arrow {
        height: 38px !important;
    }
</style>
<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><b>BIENVENIDO A SU PERFIL <?php echo $_SESSION['S_USUARIO']; ?></b></h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">

            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle" src="../img/defaultM.png" alt="User profile picture">
                    </div>
                    <h3 class="profile-username text-center"><?php echo $_SESSION['S_USUARIO']; ?></h3>
                    <p class=" text-center"><b><?php echo $_SESSION['S_DNI']; ?></b></p>
                    <ul class="list-group list-group-unbordered mb-3 ">
                        <li class="list-group-item list-group-item-light">
                            <b>DNI</b> <a class="float-right"><?php echo $_SESSION['S_DNI']; ?></a>
                        </li>
                        <li class="list-group-item list-group-item-light">
                            <b>NIVEL</b> <a class="float-right"><?php echo $_SESSION['S_ROL']; ?></a>
                        </li>
                    </ul>
                    <!--<a href="#" class="btn btn-primary btn-block"><b>MODIFICAR</b></a>-->
                </div>

            </div>


        </div>

        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h5 class="car-title">INFORMACION PERSONAL</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <label for="">DNI:</label>
                            <input type="text" hidden>
                            <input type="text" value="<?php echo $_SESSION['S_DNI']; ?>" readonly class="form-control">
                        </div>
                        <div class="col-6">
                            <label for="">NOMBRE:</label>
                            <input type="text" value="<?php echo $_SESSION['S_SNOMBRE']; ?>" readonly class="form-control">

                        </div>
                        <div class="col-6">
                            <label for="">APELLIDO PATERNO:</label>
                            <input type="text" value="<?php echo $_SESSION['S_APEPAT'] ?>" readonly class="form-control">

                        </div>

                        <div class="col-6">
                            <label for="">APELLIDO MATERNO:</label>
                            <input type="text" value="<?php echo $_SESSION['S_APEMAT']; ?>" readonly class="form-control">
                        </div>
                        <div class="col-6">
                            <label for="">ROL:</label>
                            <input type="text" value="<?php echo $_SESSION['S_ROL']; ?>" readonly class="form-control">
                        </div>
                        <div class="col-3">
                            <label for="">CONTRASEÑA:</label>
                            <input type="password" value="<?php echo $_SESSION['S_PASS']; ?>" readonly class="form-control">
                        </div>

                        <div class="col-3">
                            <label for="">&nbsp;</label>
                            <button class='btn btn-primary' style="width:100%" onclick="abrir_modal_edipersonal()"><i class='fa fa-edit'></i>
                                EDIT
                            </button>
                        </div>

                    </div>

                </div>
            </div>

        </div>

        <div class="modal fade" id="modal_editar_contraPersonal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <input type="text" value="<?php echo $_SESSION['S_IDUSUARIO']; ?>" id="id_usuap_edit" hidden>
                                <input type="text" value="<?php echo $_SESSION['S_DNI']; ?>" readonly id="id_dni_validar" hidden>
                                <label for="">INGRESE CONTRASEÑA ACTUAL</label>
                                <input type="password" id="txt_contra_actual" class="form-control">
                            </div>
                            <div class="col-12">
                                <label for="">CONTRASEÑA NUEVA </label>
                                <input type="password" id="txt_contra_nueva_edit" class="form-control">
                            </div>
                            <div class="col-12">

                                <label for="">REPETIR CONTRASEÑA </label>
                                <input type="password" id="txt_contra_repetir_edit" class="form-control">
                            </div>


                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="modificar_contra_usuariopersonal()">MODIFICAR</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();

    });
</script>