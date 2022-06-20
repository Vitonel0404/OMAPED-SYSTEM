<?php
require "../../model/model_ubigeo.php";
$MEC = new Ubigeo();
$consulta = $MEC->listarProvincia();

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