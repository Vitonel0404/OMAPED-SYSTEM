<?php

session_start();
if (!isset($_SESSION['S_IDUSUARIO'])) {
    header('Location:../index.php'); /// si mi inicion esta creada me manda a la pagina
}
$admi = "";
$visitante = "";
$operador = "";
/* if($_SESSION['S_ROL']=="ADMIN"){
    $admi="display:none;";
}*/
?>
<?php
ob_start();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../../template/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <title>Document</title>
</head>
<body>
    <style>
        .text-center {
            text-align: center !important;
        }
        .row {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-right: -7.5px;
            margin-left: -7.5px;
        }
        .align-items-center {
            -ms-flex-align: center !important;
            align-items: center !important;
        }
        .justify-content-center {
            -ms-flex-pack: center !important;
            justify-content: center !important;
        }
        .min-vh-100 {
            min-height: 100vh !important;
        }
        .col-sm-12{
            position: relative;
            width: 100%;
            padding-right: 7.5px;
            padding-left: 7.5px;
        }
        .table {
            border-collapse: collapse;
        }
        .table-bordered {
            border: 1px solid #dee2e6;
        }
        .table-bordered th,
        .table-bordered td {
        border: 1px solid #dee2e6;
        }

        .table-bordered thead th,
        .table-bordered thead td {
        border-bottom-width: 2px;
        }
        .table-sm th,
        .table-sm td {
            padding: 0.3rem;
        }
        .table-borderless th,
        .table-borderless td,
        .table-borderless thead th,
        .table-borderless tbody + tbody {
            border: 0;
        }
        

    </style>
    <div style="margin-top:-50px;">
        <div>
            <p class="text-center">Formulario 1</p>
            <p style="margin-top:-2%;" class="text-center">Registro de personas naturales con discapacidad</p>
            <p style="margin-top:-2%;" class="text-center">Con carácter de declaración jurada</p>
        </div>

        
        <div class="row align-items-center justify-content-center vh-100">
            <div class="col-sm-12">
                <?php
                    if ($_GET) {
                        $id=0;
                        foreach ($_GET as $key => $value) {
                            $id=$key;
                        }
                        $fecha=date('d/m/Y');
                        require('../../model/model_persona.php');
                        $MR =  new Persona();
                        $consulta = $MR->buscarBeneficiarioRepresentantePDF($id);
                        foreach ($consulta['data'] as $key => $value) {
                           
                            if ($value['tipo_pe']=='B'){
                                $tramDenom=$value['tram_descripcion'];
                                $id_b=$value['id_pe'];
                                $dni_b=$value['dni_pe'];
                                $nombre_b=$value['nombre_pe'];
                                $apepat_b=$value['apepat_pe'];
                                $apemat_b=$value['apemat_pe'];
                                $fecha_b=$value['fecha_pe'];
                                $sexo_b=$value['sexo_pe'];
                                $telefono_b=$value['telefono_pe'];
                                $correo_b=$value['correo_pe'];
                                $numcertdisc_b=$value['numcertdisc'];
                                $tipo_b=$value['tipo_pe'];
                                $estado_civil_b=$value['denominacion_esci'];
                                $direccion_b=$value['direccion_pe'];
                                $grado_instruccion_b=$value['denominacion_grin'];
                                $lugar_nacimiento_b=$value['distrito_ubig'];

                            }else{
                                $id_r=$value['id_pe'];
                                $dni_r=$value['dni_pe'];
                                $nombre_r=$value['nombre_pe'];
                                $apepat_r=$value['apepat_pe'];
                                $apemat_r=$value['apemat_pe'];
                                $fecha_r=$value['fecha_pe'];
                                $sexo_r=$value['sexo_pe'];
                                $telefono_r=$value['telefono_pe'];
                                $correo_r=$value['correo_pe'];
                                //$numcertdisc_r=$value['numcertdisc'];
                                $tipo_r=$value['tipo_pe'];
                                $estado_civil_r=$value['denominacion_esci'];
                                $direccion_r=$value['direccion_pe'];
                                //$direccion_r=$value['denominacion_esci'];
                                $grado_instruccion_r=$value['denominacion_grin'];
                                $lugar_nacimiento_r=$value['distrito_ubig'];
                            }
                            
                        }
                    }
                ?>
                <p style="font-size:11px"><b>Datos proporcionados por el solicitante</b></p>
                <table class="table table-bordered table-sm">
                    <thead style="font-size:13px" >
                        <tr>
                            <th scope="col">Tipo de Trámite:</th>
                            <th scope="col">Solicitud Inicial</th>
                            <th scope="col">Duplicado</th>
                            <th scope="col">Modificación o actualizacion</th>
                            <th scope="col">Copias autenticadas</th>
                            <th scope="col">Rectificación por error material</th>
                            <th scope="col">Retiro del registro</th>
                        </tr>
                    </thead>
                    <tbody style="font-size:11px" >
                        <tr class="table-sm">
                            <td ><b>Motivo de trámite</b></td>
                            <td colspan="6"><?php echo $tramDenom ?></td>
                        </tr>
                        <tr class="table-sm">
                            <td colspan="7"><b>DNI:</b>  <?php echo $dni_b?></td>
                        </tr>
                        <tr class="table-sm">
                            <td colspan="7"><b>N° de certificado de discapacidad:</b> <?php echo $numcertdisc_b?></td>
                        </tr>
                        <tr class="table-sm">
                            <td colspan="7"><b>DNI del representante (si correspondiera):</b>  <?php echo $dni_r?></td>
                        </tr>
                        <tr class="table-sm">
                            <td colspan="7"><b>Correo electrónico de contacto:</b> <?php echo $correo_b?></td>
                        </tr>
                        <tr class="table-sm">
                            <td colspan="7"><b>Número de contacto:</b> <?php echo $telefono_b?></td>
                        </tr>
                        <tr class="table-sm">
                            <th  scope="row" colspan="7" >Datos del solicitante obtenidos de la base de datos de la RENIEC</th>
                        </tr>
                        <tr class="table-sm">
                            <td colspan="7"><b>Nombre:</b> <?php echo $nombre_b?></td>
                        </tr>
                        <tr class="table-sm">
                            <td colspan="7"><b>Primer apellido:</b> <?php echo $apepat_b?></td>
                        </tr>
                        <tr class="table-sm">
                            <td colspan="7"><b>Segundo apellido:</b> <?php echo $apemat_b?></td>
                        </tr>
                        <tr class="table-sm">
                            <td colspan="7"><b>Fecha de nacimiento:</b> <?php echo $fecha_b?></td>
                        </tr>
                        <tr class="table-sm">
                            <td colspan="7"><b>Sexo:</b> <?php if ($sexo_b=='M'){echo 'MASCULINO';}else{echo 'FEMENINO';}  ?></td>
                        </tr>
                        <tr class="table-sm">
                            <td colspan="7"><b>Estado civil:</b> <?php echo $estado_civil_b?></td>
                        </tr>
                        <tr class="table-sm">
                            <td colspan="7"><b>Dirección:</b> <?php echo $direccion_b?> </td>
                        </tr>
                        <tr class="table-sm">
                            <td colspan="7"><b>Grado de instrucción:</b> <?php echo $grado_instruccion_b?></td>
                        </tr>
                        <tr class="table-sm">
                            <td colspan="7"><b>Lugar de nacimiento:</b> <?php echo $lugar_nacimiento_b?></td>
                        </tr>
                        <tr class="table-sm">
                            <th  scope="row" colspan="7" >Datos del representante obtenidos de la base de datos de la RENIEC</th>
                        </tr>
                        <tr class="table-sm">
                            <td colspan="7"><b>Nombre:</b> <?php echo $nombre_r?></td>
                        </tr>
                        <tr class="table-sm">
                            <td colspan="7"><b>Primer apellido:</b> <?php echo $apepat_r?></td>
                        </tr>
                        <tr class="table-sm">
                            <td colspan="7"><b>Segundo apellido:</b> <?php echo $apemat_r?></td>
                        </tr>
                        <tr class="table-sm">
                            <td colspan="7"><b>Fecha de nacimiento:</b> <?php echo $fecha_r?></td>
                        </tr>
                        <tr class="table-sm">
                            <td colspan="7"><b>Sexo:</b> <?php if ($sexo_r=='M'){echo 'MASCULINO';}else{echo 'FEMENINO';}  ?></td>
                        </tr>
                        <tr class="table-sm">
                            <td colspan="7"><b>Estado civil:</b> <?php echo $estado_civil_r?></td>
                        </tr>
                        <tr class="table-sm">
                            <td colspan="7"><b>Dirección:</b> <?php echo $direccion_r?> </td>
                        </tr>
                        <tr class="table-sm">
                            <td colspan="7"><b>Grado de instrucción:</b> <?php echo $grado_instruccion_r?></td>
                        </tr>
                        <tr class="table-sm">
                            <td colspan="7"><b>Lugar de nacimiento:</b> <?php echo $lugar_nacimiento_r?></td>
                        </tr>
                    </tbody>
                    <tfoot class="table-borderless" >
                        <tr >
                            <th colspan="7"></th>
                        </tr>
                        <br>
                        <br>
                        
                        <tr>
                            <th scope="col" colspan="2">Fecha: <?php echo $fecha?></th>
                            <td colspan="2">Huella digital</td>
                            <td colspan="3">Firma del solicitante o su representante/apoderado</td>
                        </tr>
                    </tfoot>
                </table>
                
            </div>
        </div>
    </div>
    
    
</body>
</html>

<?php

$html=ob_get_clean();
//echo $html;

require_once '../../library/dompdf/autoload.inc.php';

use Dompdf\Dompdf;
$dompdf = new Dompdf();

$options = $dompdf->getOptions();
$options-> set(array('isRemoteEnabled' => true));
$dompdf->setOptions($options);
$dompdf -> loadHtml($html);

$dompdf->setPaper('letter','portrait');
$dompdf->render();
$dompdf->stream('archivo_.pdf',array("Attachment" => false));

?>