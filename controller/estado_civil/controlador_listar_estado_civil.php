<?php
require "../../model/model_estado_civil.php";
$MEC = new EstadoCivil();
$consulta = $MEC->listarEstadoCivil();

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