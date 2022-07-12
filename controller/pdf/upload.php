<?php
if ($_POST) {
    $directorio ="../../uploads/";
    $id=$_POST['id_tram'];
    $route= $_FILES['file']["name"];
    $archivo =$directorio . basename($_FILES["file"]["name"]);
    $typeFile = strtolower(pathinfo($archivo,PATHINFO_EXTENSION));
  
    if ($typeFile=='pdf') {
        if (move_uploaded_file($_FILES["file"]["tmp_name"],$archivo)) {
            
            require('../../model/model_tramite.php');
            $MR =  new Tramite();
            $consulta = $MR->updateFile($id,$route);
            //print_r($consulta);
            echo json_encode(["status"=>true,"mensaje"=>"Archivo cargado correctamente"]);
        }else{
            echo  json_encode (["status"=>false,"mensaje"=>"Error al cargar archivo"]);
        }
    } else {
        echo json_encode (["status"=>false,"mensaje"=>'SOLO SE ADMITE ARCHIVOS .PDF']);
    }
}


?>