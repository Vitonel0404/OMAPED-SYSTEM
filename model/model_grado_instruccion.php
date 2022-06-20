<?php
require_once 'model_conexion.php';

class GradoInstruccion extends conexion_nueva{

    function listarGradoInstruccion(){
        $c = conexion_nueva::conectarBD();
        $sql = "SELECT * FROM sp_listar_grado_instruccion()";

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

    function registrarGradoInstruccion($denominacion){
        $c = conexion_nueva::conectarBD();
        $sql = "SELECT *FROM  sp_registrar_grado_instruccion(?) ";
        $query = $c->prepare($sql);
        $query->bindParam(1, $denominacion);
        $query->execute();
        if ($row = $query->fetchColumn()) {
            return $row;
        }
        conexion_nueva::cerrar_conexion();

    }

    function modificarGradoInstruccion($id,$denominacion,$estado){
        $c = conexion_nueva::conectarBD();
        $sql = "SELECT * FROM  sp_modificar_grado_instruccion(?,?,?) ";
        $query = $c->prepare($sql);
        $query->bindParam(1, $id);
        $query->bindParam(2, $denominacion);
        $query->bindParam(3, $estado);
        $query->execute();
        if ($row = $query->fetchColumn()) {
            return $row;
        }
        conexion_nueva::cerrar_conexion();
    }
}
?>