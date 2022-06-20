<?php
require "../../model/model_tipo_tramite.php";
$MEC = new TipoTramite();
$consulta = $MEC->listarTipoTramite();

if ($consulta) {
    //echo 1;
    echo json_encode($consulta);
} else {
    echo '{
        "sEcho":1,
        "iTotalRecords":"0",
        "iTotalDisplayRecords":"0",
        "aaData":[]
    }';
}

?>