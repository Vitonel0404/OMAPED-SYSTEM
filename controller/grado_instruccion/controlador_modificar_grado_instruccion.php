<?php

require '../../model/model_grado_instruccion.php';

$model= new GradoInstruccion();


$id=$_POST['id'];
$denom=$_POST['denominacion'];
$estado=$_POST['estado'];
$consulta = $model-> modificarGradoInstruccion($id,$denom,$estado);
echo json_encode($consulta);
?>