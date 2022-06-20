<?php
require "../../model/model_grado_instruccion.php";
$MEC = new GradoInstruccion();
$consulta = $MEC->listarGradoInstruccion();

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