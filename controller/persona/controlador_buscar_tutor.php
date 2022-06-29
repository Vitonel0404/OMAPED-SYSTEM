<?php

require '../../model/model_persona.php';

$model= new Persona();

$dni=$_POST['dni'];
$consulta = $model-> buscarTutor($dni);
echo json_encode($consulta);
?>