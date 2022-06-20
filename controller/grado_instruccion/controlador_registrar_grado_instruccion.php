<?php

require '../../model/model_grado_instruccion.php';

$model= new GradoInstruccion();


$denom=$_POST['denominacion'];
$consulta = $model-> registrarGradoInstruccion($denom);
echo json_encode($consulta);
?>