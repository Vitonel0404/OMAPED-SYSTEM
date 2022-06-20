<?php

require '../../model/model_estado_civil.php';

$model= new EstadoCivil();


$id=$_POST['id'];
$denom=$_POST['denominacion'];
$abrev=$_POST['abreviatura'];
$estado=$_POST['estado'];
$consulta = $model-> modificarEstadoCivil($id,$denom,$abrev,$estado);
echo json_encode($consulta);
?>