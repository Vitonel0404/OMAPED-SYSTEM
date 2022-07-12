<?php

require '../../model/model_tramite.php';

$model= new Tramite();

$fecha=$_POST['fecha'];
$archivo=$_POST['archivo'];
$id_titr=$_POST['id_titr'];
$id_pers=$_POST['id_pers'];
$id_usuario=$_POST['id_usuario'];

$consulta = $model-> registrarTramite($fecha,$archivo,$id_titr,$id_pers,$id_usuario);
echo json_encode($consulta);
?>