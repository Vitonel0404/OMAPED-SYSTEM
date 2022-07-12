<?php
require_once 'model_conexion.php';

class Tramite extends conexion_nueva{

    function listarTramite(){
        $c = conexion_nueva::conectarBD();
        $sql = "SELECT * FROM sp_listar_tramite()";

        $query = $c -> prepare($sql);
        $query->execute();

        $result = $query->fetchall(PDO::FETCH_ASSOC);
        

        $arreglo = array();
        foreach ($result as $r) {
            $arreglo["data"][] = $r;
        }
        return $result;
        conexion_nueva::cerrar_conexion();

    }

    function registrarTramite($fecha,$archivo,$id_titr,$id_pers,$id_usuario){
        $c = conexion_nueva::conectarBD();
        $sql = "SELECT *FROM  sp_registrar_tramite(?,?,?,?,?)";
        $query = $c->prepare($sql);
        $query->bindParam(1, $fecha);
        $query->bindParam(2, $archivo);
        $query->bindParam(3, $id_titr);
        $query->bindParam(4, $id_pers);
        $query->bindParam(5, $id_usuario);
        $query->execute();
        $result = $query->fetchall(PDO::FETCH_ASSOC);
        /*
        $arreglo = array();
        foreach ($result as $r) {
            $arreglo["data"][] = $r;
        }*/
        return $result[0]['sp_registrar_tramite'];
        conexion_nueva::cerrar_conexion();
    }

    function buscarDescripcionTramite($id){
        $c = conexion_nueva::conectarBD();
        $sql = "SELECT *FROM sp_buscar_descrpcion_tramite(?)";
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
    function updateFile($id,$route){
        $c = conexion_nueva::conectarBD();
        $sql = "SELECT *FROM  sp_actualizar_ruta_pdf(?,?)";
        $query = $c->prepare($sql);
        $query->bindParam(1, $id);
        $query->bindParam(2, $route);
        
        $query->execute();
        if ($row = $query->fetchColumn()) {
            return $row;
        }
        conexion_nueva::cerrar_conexion();
    }
    
}
?>