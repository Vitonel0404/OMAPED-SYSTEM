<?php

require '../../model/model_persona.php';

$model= new Persona();

$dni=$_POST['dni'];
$nombre=$_POST['nombre'];
$apepat=$_POST['apepat'];
$apemat=$_POST['apemat'];
$fechanac=$_POST['fechanac'];
$sexo=$_POST['sexo'];
$telefono=$_POST['telefono'];
$correo=$_POST['correo'];
$numcert=$_POST['numcert'];
$tipo=$_POST['tipo'];
$dependiente=$_POST['dependiente'];
$id_esci=$_POST['id_esci'];
$id_grin=$_POST['id_grin'];
$distrito=$_POST['distrito'];
$consulta = $model-> registrarPersona($dni,$nombre,$apepat,$apemat,$fechanac,$sexo,$telefono,$correo,$numcert,$tipo,$dependiente,$id_esci,$id_grin,$distrito);
echo json_encode($consulta);
?>