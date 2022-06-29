<?php
require "../../model/model_ubigeo.php";
$MEC = new Ubigeo();

$provincia=$_POST['provincia'];
$consulta = $MEC->listarDistritoXProvincia($provincia);

echo json_encode($consulta);

?>