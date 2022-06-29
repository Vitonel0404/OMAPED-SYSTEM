<?php

require '../../model/model_persona.php';

$model= new Persona();
$id=$_POST['id'];
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
$estado=$_POST['estado'];
$dependiente=$_POST['dependiente'];
$id_esci=$_POST['id_esci'];
$id_grin=$_POST['id_grin'];
$distrito=$_POST['distrito'];
$consulta = $model-> modificarPersona($id,$dni,$nombre,$apepat,$apemat,$fechanac,$sexo,$telefono,$correo,$numcert,$tipo,$estado,$dependiente,$id_esci,$id_grin,$distrito);
echo json_encode($consulta);
?>