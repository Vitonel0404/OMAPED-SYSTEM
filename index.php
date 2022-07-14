<?php
session_start();
if (isset($_SESSION['S_IDUSUARIO'])) {
    header('Location: view/index.php'); /// si mi inicion esta creada me manda a la pagina
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="template/dist/css/adminlte.min.css">
    <title>Registro de Trámites OMAPED</title>
</head>
<body>
<div class="parent clearfix">
    <div class="bg-illustration">
        <img src="img/imgLogin.svg" alt="logo">
        
    </div>
    
    <div class="login">
      <div class="container">
      <img src="img/logomuni.jpeg" height="auto" width="500px" class="img-fluid">
    
        <div class="login-form">
          <form action="">
            <input type="email" placeholder="Usuario" id="txtUsu">
            <input type="password" placeholder="Contraseña"  id="txtPass">

            <button type="button" onclick="iniciar_Sesion()">Iniciar Sesión</button>
          </form>
          
        </div>
    
      </div>
      </div>
            
</div>
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