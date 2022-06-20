<?php
session_start();
if (isset($_SESSION['S_IDUSUARIO'])) {
    header('Location: view/index.php'); /// si mi inicion esta creada me manda a la pagina
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SISTEMA MUNI</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="template/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="template/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="template/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center container border ">
                <!-- <a href="template/index2.html" class="h1"><b>Admin</b>LTE</a>-->
                <img src="img/logomuni.jpeg" height="auto" width="500px" class="img-fluid">
            </div>
            <div class="card-body">
                <div class="input-group mb-3">
                    <input type="txt" class="form-control" placeholder="Usuario" id="txtUsu">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Password" id="txtPass">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary btn-block" onclick="iniciar_Sesion()">INGRESAR</button>
                    </div>
                    <!-- /.col -->
                </div>
            </div>
            <div class="card-body container border">
                <img src="img/logoMuni.jpg" class=" img-fluid " width="60px">
                <font size=2.5 style="float:right" class="mt-4 mr-3"> <strong>&copy; Copyright MPCH GTIE</strong> All rights reserved.
                </font>


            </div>
            
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="template/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="template/dist/js/adminlte.min.js"></script>
    <script src="utilitarios/sweetalert.js"></script>
    <script src="js/usuario.js?rev=<?php echo time() ///para recgar el js 
                                    ?>"></script>
</body>

</html>