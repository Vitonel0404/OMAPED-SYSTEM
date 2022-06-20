<?php

require_once 'model_conexion.php';

class Ubigeo extends conexion_nueva{

    function listarProvincia(){
        $c = conexion_nueva::conectarBD();
        $sql = "SELECT * FROM sp_listar_provincia()";

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
    function listarDistritoXProvincia($provincia){
        $c = conexion_nueva::conectarBD();
        $sql = "SELECT * FROM sp_listar_distrito(?)";

        $query = $c -> prepare($sql);
        $query->bindParam(1, $provincia);
        $query->execute();
        $result = $query->fetchall(PDO::FETCH_ASSOC);
        $arreglo = array();
        foreach ($result as $r) {
            $arreglo["data"][] = $r;
        }
        return $arreglo;
        conexion_nueva::cerrar_conexion();

    }
    /*
    function registrarPersona($denominacion,$abreviatura){
        $c = conexion_nueva::conectarBD();
        $sql = "SELECT *FROM  sp_registrar_estado_civil(?,?) ";
        $query = $c->prepare($sql);
        $query->bindParam(1, $denominacion);
        $query->bindParam(2, $abreviatura);
        $query->execute();
        if ($row = $query->fetchColumn()) {
            return $row;
        }
        conexion_nueva::cerrar_conexion();
    }

    function modificarPersona($id,$denominacion,$abreviatura,$estado){
        $c = conexion_nueva::conectarBD();
        $sql = "SELECT * FROM  sp_modificar_estado_civil(?,?,?,?) ";
        $query = $c->prepare($sql);
        $query->bindParam(1, $id);
        $query->bindParam(2, $denominacion);
        $query->bindParam(3, $abreviatura);
        $query->bindParam(4, $estado);
        $query->execute();
        if ($row = $query->fetchColumn()) {
            return $row;
        }
        conexion_nueva::cerrar_conexion();
    }
    */
    
}



?>