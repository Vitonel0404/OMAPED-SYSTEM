<?php
require "../../model/model_tramite.php";
$MEC = new Tramite();
$consulta = $MEC->listarTramite();

echo json_encode($consulta);

?>