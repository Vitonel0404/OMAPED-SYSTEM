<?php

require_once 'model_conexion.php';

class Persona extends conexion_nueva{

    function listarPersona(){
        $c = conexion_nueva::conectarBD();
        $sql = "SELECT * FROM sp_listar_persona()";

        $query = $c -> prepare($sql);
        $query->execute();

        $result = $query->fetchall(PDO::FETCH_ASSOC);
        $arreglo = array();
       
        foreach ($result as $r) {
            $arreglo["data"][] = $r;
        }

        return $arreglo;
    
        
        
        conexion_nueva::cerrar_conexion();

    }
    
    function registrarPersona($dni,$nombre,$apepat,$apemat,$fecha,$sexo,$telefono,$correo,$numcert,$tipo,$dependiente,$id_esci,$direccion,$id_grin,$distrito){
        $c = conexion_nueva::conectarBD();
        $sql = "SELECT *FROM  sp_registrar_persona(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $query = $c->prepare($sql);
        $query->bindParam(1, $dni);
        $query->bindParam(2, $nombre);
        $query->bindParam(3, $apepat);
        $query->bindParam(4, $apemat);
        $query->bindParam(5, $fecha);
        $query->bindParam(6, $sexo);
        $query->bindParam(7, $telefono);
        $query->bindParam(8, $correo);
        $query->bindParam(9, $numcert);
        $query->bindParam(10, $tipo);
        $query->bindParam(11, $dependiente);
        $query->bindParam(12, $id_esci);
        $query->bindParam(13, $direccion);
        $query->bindParam(14, $id_grin);
        $query->bindParam(15, $distrito);
        $query->execute();
        if ($row = $query->fetchColumn()) {
            return $row;
        }
        conexion_nueva::cerrar_conexion();
    }

    function modificarPersona($id,$dni,$nombre,$apepat,$apemat,$fechanac,$sexo,$telefono,$correo,$numcert,$tipo,$estado,$dependiente,$id_esci,$direccion,$id_grin,$distrito){
        $c = conexion_nueva::conectarBD();
        $sql = "SELECT * FROM  sp_modificar_persona(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ";
        $query = $c->prepare($sql);
        $query->bindParam(1, $id);
        $query->bindParam(2, $dni);
        $query->bindParam(3, $nombre);
        $query->bindParam(4, $apepat);
        $query->bindParam(5, $apemat);
        $query->bindParam(6, $fechanac);
        $query->bindParam(7, $sexo);
        $query->bindParam(8, $telefono);
        $query->bindParam(9, $correo);
        $query->bindParam(10, $numcert);
        $query->bindParam(11, $tipo);
        $query->bindParam(12, $estado);
        $query->bindParam(13, $dependiente);
        $query->bindParam(14, $id_esci);
        $query->bindParam(15, $direccion);
        $query->bindParam(16, $id_grin);
        $query->bindParam(17, $distrito);
        $query->execute();
        if ($row = $query->fetchColumn()) {
            return $row;
        }
        conexion_nueva::cerrar_conexion();
    }

    function buscarTutor($dni){
        $c = conexion_nueva::conectarBD();
        $sql = "SELECT *FROM  sp_buscar_tutor(?)";
        $query = $c->prepare($sql);
        $query->bindParam(1, $dni);
        $query->execute();
        $result = $query->fetchall(PDO::FETCH_ASSOC);
        

        $arreglo = array();
        foreach ($result as $r) {
            $arreglo["data"][] = $r;
        }
        return $arreglo;
        conexion_nueva::cerrar_conexion();

    }
    function buscarBeneficiarioRepresentantePDF($id){
        $c = conexion_nueva::conectarBD();
        $sql = "SELECT *FROM  sp_buscar_beneficiario_representante_pdf(?)";
        $query = $c->prepare($sql);
        $query->bindParam(1, $id);
        $query->execute();
        $result = $query->fetchall(PDO::FETCH_ASSOC);
        

        $arreglo = array();
        foreach ($result as $r) {
            $arreglo["data"][] = $r;
        }
        return $arreglo;
        conexion_nueva::cerrar_conexion();
    }
    
}



?>