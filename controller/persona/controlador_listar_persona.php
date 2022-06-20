<?php
require "../../model/model_persona.php";
$MEC = new Persona();
$consulta = $MEC->listarPersona();

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