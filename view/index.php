<?php

session_start();
if (!isset($_SESSION['S_IDUSUARIO'])) {
    header('Location:../index.php'); /// si mi inicion esta creada me manda a la pagina
}
$admi = "";
$visitante = "";
$operador = "";
?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OMAPED</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../template/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../template/dist/css/adminlte.min.css">
    <link rel="stylesheet" type="text/css" href="../utilitarios/DataTables/datatables.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="../template/plugins/select2/css/select2.min.css" />
    <link rel="stylesheet" type="text/css" href="../template/plugins/select2-bootstrap4-theme/select2-bootstrap4.css" />
    <link href="../css/index.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">                     
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <b> USUARIO: <?php echo $_SESSION['S_USUARIO']; ?></b>
                        <i class="fa fa-chevron-circle-down" aria-hidden="true"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item" style="font-size: large;" onclick="cargar_contenido('contenido_principal','usuario/mantenimiento_perfil.php')">
                            <i class="fas fa-user-cog mr-2"></i>
                            <span class="text-muted text-sm"><b>PERFIL</b></span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="../controller/usuario/cerrar_sesion.php" class="dropdown-item" style="font-size: large;">
                            <i class="fas fa-sign-out-alt"></i>
                            <span class="text-muted text-sm"><b>CERRAR SESION</b></span>
                        </a>
                        <div class="dropdown-divider"></div>

                    </div>
                </li>

            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-secondary elevation-4">
            <!-- Brand Logo -->
            
            <a href="index.php" class="brand-link">
                <!-- <img src="../img/logomuni.jpeg" alt="AdminLTE Logo" class="img-fluid float-left" >-->
                <span class="text-center">
                    <b>
                        <p style="color:FFFFFF">OMAPED</p>
                    </b>
                </span>
            </a>
            
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item ">
                            <a href=" " class="nav-link ">
                                <div class="text-center">
                                    <img src="../img/defaultM.png" class="profile-user-img img-fluid img-circle " width='100%'><br>
                                </div>
                                <div class="txt-center">
                                    <p class="text-center">
                                        <font size=3>
                                            <?php echo $_SESSION['S_USUARIO'] ?>
                                        </font>
                                    </p>

                                </div>
                            </a>
                        </li>
                        

                        <li class="nav-item menu-open">
                            <a href="index.php" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    DASHBOARD
                                    
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">MENÚ</li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-chart-pie"></i>
                            <p>
                                Mantenimiento
                                <i class="right fas fa-angle-left"></i>
                            </p>
                            </a>
                            
                            <ul class="nav nav-treeview">
                                <?php if ($_SESSION['S_ROL'] == "ADMIN") {

                                ?>
                                <li class="nav-item">
                                    <a href="#" class="nav-link" onclick="cargar_contenido('contenido_principal','usuario/mantenimiento_us.php')">
                                        <i class="bi bi-person-fill"></i>
                                        <p>
                                            Usuarios
                                        </p>
                                    </a>
                                </li>
                                
                                <li class="nav-item">
                                    <a href="#" class="nav-link" onclick="cargar_contenido('contenido_principal','estado_civil/mantenimiento_estado_civil.php')">
                                        <i class="bi bi-journal"></i>
                                        <p>
                                            Estado Civil
                                        </p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="#" class="nav-link" onclick="cargar_contenido('contenido_principal','grado_instruccion/mantenimiento_grado_instruccion.php')">
                                        <i class="bi bi-bookmark"></i>
                                        <p>
                                            Grado Instrucción
                                        </p>
                                    </a>
                                </li>
                                <?php } ?>
                                <li class="nav-item">
                                    <a href="#" class="nav-link" onclick="cargar_contenido('contenido_principal','persona/mantenimiento_persona.php')">
                                        <i class="bi bi-file-person"></i>
                                        <p>
                                            Persona
                                        </p>
                                    </a>
                                </li>
                                <?php if ($_SESSION['S_ROL'] == "ADMIN") {
                                ?>
                                <li class="nav-item">
                                    <a href="#" class="nav-link" onclick="cargar_contenido('contenido_principal','tipo_tramite/mantenimiento_tipo_tramite.php')">
                                        <i class="bi bi-layout-text-sidebar"></i>
                                        <p>
                                            Tipo de trámite
                                        </p>
                                    </a>
                                </li>
                                <?php } ?>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link" onclick="cargar_contenido('contenido_principal','tramite/mantenimiento_tramite.php')">
                                <i class="bi bi-journal-plus"></i>
                                <p>Nuevo Trámite</p>
                            </a>
                        </li>

                        

                        
                    </ul>
                    <input type="text" value="<?php echo $_SESSION['S_IDUSUARIO']; ?>" id="txt_idPrincipal" hidden>
                    <input type="text" value="<?php echo $_SESSION['S_ROL']; ?>" id="txt_rolPrincipal" hidden>
                </nav>
                <!-- SidebarSearch Form -->
                <div class="form-inline">

                </div>

                <!-- Sidebar Menu -->
                
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" id="contenido_principal">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <h1 class="m-0 display-1">Dashboard</h1>
                        </div>
                    </div>
                </div>
            </div>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3 id="id_tram_hoy" ></h3>

                                    <p>Trámites diarios</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3 id="id_num_bene"></h3>

                                    <p>Beneficiarios registrados</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3 id="id_num_repre"></h3>

                                    <p>Representantes registrados</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3 id="id_tram_total"></h3>

                                    <p>Total de trámites</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                            </div>
                        </div>
          <!-- ./col -->
                    </div>
                </div>
            </section>
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="col-12">
                <div class="row">
                    <div class="d-none d-sm-inline">
                        <img src="../img/logoMuni.jpg" class=" img-fluid " width="100px">
                    </div>
                    <!-- Default to the left -->
                    <div class="col-6 mt-5">
                        <strong>&copy; Copyright MPCH GTIE - Todos los derechos reservados.</strong> All rights reserved.
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="../template/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script type="text/javascript" src="../utilitarios/DataTables/datatables.min.js"></script>
    <!-- AdminLTE App -->
    <script type="text/javascript" src="../template/plugins/select2/js/select2.full.min.js"></script>
    <script src="../utilitarios/sweetalert.js"></script>
    <script src="../template/dist/js/adminlte.min.js"></script>
    <script src="../js/dashboard.js?rev=<?php echo time() ?>"></script>

    <script>
        function cargar_contenido(id, vista) {
            $("#" + id).load(vista);
        }
        var idioma_espanol = {
            select: {
                // rows: "%d fila seleccionada"
                rows: ""
            },
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ning&uacute;n dato disponible en esta tabla",
            "sInfo": "Registros del (START al END) total de TOTAL registros",
            "sInfoEmpty": "Registro del (0 al 0) total 0 registros",
            "sInfoFiltered": "(Filtrado de un total de MAX registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "<b> No se encontraron datos </b>",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ":Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ":Activar para ordenar la columna de manera descendente"
            }

        }
        $(function() {
            var menues = $(".nav-link");
            menues.click(function() {
                menues.removeClass("active");
                $(this).addClass("active");
            });
        })

        function soloNumeros(e) {
            tecla = (document.all) ? e.keyCode : e.which;
            if (tecla == 8) {
                return true;
            }
            // Patron de entrada, en este caso solo acepta numeros
            patron = /[0-9]/;
            tecla_final = String.fromCharCode(tecla);
            return patron.test(tecla_final);
        }

        function soloLetras(e) {
            key = e.keyCode || e.which;
            tecla = String.fromCharCode(key).toLowerCase();
            letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
            especiales = "8-37-39-46";
            tecla_especial = false
            for (var i in especiales) {
                if (key == especiales[i]) {
                    tecla_especial = true;
                    break;
                }
            }
            if (letras.indexOf(tecla) == -1 && !tecla_especial) {
                return false;
            }
        }

        function filterFloat(evt, input) {
            var key = window.Event ? evt.which : evt.keyCode;
            var chark = String.fromCharCode(key);
            var tempValue = input.value + chark;
            if (key >= 48 && key <= 57) {
                if (filter(tempValue) === false) {
                    return false;
                } else {
                    return true;
                }
            } else {
                if (key == 8 || key == 13 || key == 0) {
                    return true;
                } else if (key == 46) {
                    if (filter(tempValue) === false) {
                        return false;
                    } else {
                        return true;
                    }
                } else {
                    return false;
                }
            }
        }

        function filter(__val__) {
            var preg = /^([0-9]+\.?[0-9]{0,2})$/;
            if (preg.test(__val__) === true) {
                return true;
            } else {
                return false;
            }
        }
    </script>
</body>

</html>