<?php

$id_usu = htmlspecialchars($_POST['id_usu'], ENT_QUOTES, 'UTF-8'); // ENT:QUOTE .. para saltar codigo o innyecciones js
$dni = htmlspecialchars($_POST['dni'], ENT_QUOTES, 'UTF-8');
$usuario = htmlspecialchars($_POST['usuario'], ENT_QUOTES, 'UTF-8');
$rol = htmlspecialchars($_POST['rol'], ENT_QUOTES, 'UTF-8'); // ENT:QUOTE .. para saltar codigo o innyecciones js
$apepat = htmlspecialchars($_POST['apepatusu'], ENT_QUOTES, 'UTF-8');
$apemat = htmlspecialchars($_POST['apematusu'], ENT_QUOTES, 'UTF-8');
$snombre = htmlspecialchars($_POST['nombre_usu'], ENT_QUOTES, 'UTF-8');
$pass = htmlspecialchars($_POST['usua_clave'], ENT_QUOTES, 'UTF-8'); // ENT:QUOTE .. para saltar codigo o innyecciones js
/////paara retornar el numero de asteriscos


session_start();
$_SESSION['S_IDUSUARIO'] = $id_usu;
$_SESSION['S_DNI'] = $dni;
$_SESSION['S_USUARIO'] = $usuario;
$_SESSION['S_ROL'] = $rol;
$_SESSION['S_APEPAT'] = $apepat;
$_SESSION['S_APEMAT'] = $apemat;
$_SESSION['S_SNOMBRE'] = $snombre;
$_SESSION['S_PASS'] = $pass;

