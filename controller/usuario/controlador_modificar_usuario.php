<?php
require '../../model/model_usuario.php';

$MU = new model_usu(); //Instaciamos
$id = $_POST['id'];
$dni =  htmlspecialchars($_POST['dni'], ENT_QUOTES, 'UTF-8');
$nombre =  strtoupper(htmlspecialchars($_POST['nombre'], ENT_QUOTES, 'UTF-8'));
$apepat = strtoupper(htmlspecialchars($_POST['apat'], ENT_QUOTES, 'UTF-8'));
$apemat =  strtoupper(htmlspecialchars($_POST['amat'], ENT_QUOTES, 'UTF-8'));
$correo =  strtoupper(htmlspecialchars($_POST['correo'], ENT_QUOTES, 'UTF-8'));
$contra =    htmlspecialchars($_POST['contra'], ENT_QUOTES, 'UTF-8');
$nivel =  strtoupper(htmlspecialchars($_POST['nivel'], ENT_QUOTES, 'UTF-8'));
//$estado =  strtoupper(htmlspecialchars($_POST['estado'], ENT_QUOTES, 'UTF-8'));
$consultar = $MU->modificar_usuario($id, $dni, $nombre, $apepat, $apemat,$correo, $contra,$nivel);
echo $consultar;
