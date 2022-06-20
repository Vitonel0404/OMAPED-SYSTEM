<?php

require '../../model/model_estado_civil.php';

$model= new EstadoCivil();

$denom=$_POST['denominacion'];
$abrev=$_POST['abreviatura'];
$consulta = $model-> registrarEstadoCivil($denom,$abrev);
echo json_encode($consulta);
?>