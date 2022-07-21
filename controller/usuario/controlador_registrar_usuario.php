<?php
require '../../model/model_usuario.php';

$MU = new model_usu(); //Instaciamos
$dni =  htmlspecialchars($_POST['dni'], ENT_QUOTES, 'UTF-8');
$nombre =  strtoupper(htmlspecialchars($_POST['nombre'], ENT_QUOTES, 'UTF-8'));
$apepat = strtoupper(htmlspecialchars($_POST['apepat'], ENT_QUOTES, 'UTF-8'));
$apemat =  strtoupper(htmlspecialchars($_POST['apemat'], ENT_QUOTES, 'UTF-8'));
$correo =  strtoupper(htmlspecialchars($_POST['correo'], ENT_QUOTES, 'UTF-8'));
$contra =  password_hash($_POST['contra'], PASSWORD_DEFAULT, ['cost' => 12]);;
$nivel =  strtoupper(htmlspecialchars($_POST['nivel'], ENT_QUOTES, 'UTF-8'));
$consultar = $MU->registrar_usuario($dni, $nombre, $apepat, $apemat,$correo,$contra,$nivel);
echo $consultar;
