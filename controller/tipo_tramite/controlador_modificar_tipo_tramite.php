<?php

require '../../model/model_tipo_tramite.php';

$model= new TipoTramite();


$id=$_POST['id'];
$denom=$_POST['denominacion'];
$estado=$_POST['estado'];
$consulta = $model-> modificarTipoTramite($id,$denom,$estado);
echo json_encode($consulta);
?>