<?php
require '../../model/model_usuario.php';
$ruta = "";
$MU = new model_usu();
$id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
$estatus = htmlspecialchars($_POST['estatus'], ENT_QUOTES, 'UTF-8');

$consulta = $MU->Modificar_Usuario_Estatus($id, $estatus);
echo $consulta;
