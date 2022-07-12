<?php

require '../../model/model_persona.php';

$model= new Persona();

$id=$_POST['id'];
$consulta = $model-> buscarBeneficiarioRepresentantePDF($id);
echo json_encode($consulta);
?>