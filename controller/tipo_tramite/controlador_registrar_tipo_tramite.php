<?php

require '../../model/model_tipo_tramite.php';

$model= new TipoTramite();


$denom=$_POST['denominacion'];
$consulta = $model-> registrarTipoTramite($denom);
echo json_encode($consulta);
?>