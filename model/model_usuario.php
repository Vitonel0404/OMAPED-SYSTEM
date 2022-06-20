<?php

require_once 'model_conexion.php';

class model_usu extends conexion_nueva
{

    public function VerificarUsuario($dni, $pass)
    {

        $c = conexion_nueva::conectarBD();

        $sql = "SELECT * FROM  sp_verificar_usuario(?)";

        $arreglo = array();
        $query = $c->prepare($sql);
        $query->bindParam(1, $dni); /// para que la primer entrada de la setencia sql reciba un dato
        $query->execute();

        $resultado = $query->fetchAll();
        //$nuevo="";

        foreach ($resultado as $resu) {

            if (password_verify($pass, $resu['usua_clave'])) { // PHP brinda una funcion para poder verificar contraseñas ncriptadas ya que siempre estan cambiando
                $arreglo[] = $resu;
            }
        }

        //echo strlen($nuevo);/// contar en un string espacio.
        //$cumple =strpos($nuevo,$usuario); buscar string en la cadina -arroja el valor

        //echo substr($nuevo,$cumple,$suma);cadena de llama




        //return $resultado;
        return $arreglo;

        conexion_nueva::cerrar_conexion();
    }
    function listar_usuario()
    {
        $c = conexion_nueva::conectarBD();

        $sql = "SELECT * FROM  sp_listar_usuario()";

        $arreglo = array();
        $query = $c->prepare($sql);
        $query->execute();

        $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($resultado as $resu) {
            $arreglo["data"][] = $resu;
        }
        return $arreglo;

        conexion_nueva::cerrar_conexion();
    }
    function registrar_usuario($dni, $nombre, $apepat, $apemat, $contra)
    {
        $c = conexion_nueva::conectarBD();

        $sql = "SELECT *FROM  sp_registar_usuario(?,?,?,?,?) ";


        $query = $c->prepare($sql);
        $query->bindParam(1, $dni);
        $query->bindParam(2, $nombre);
        $query->bindParam(3, $apepat);
        $query->bindParam(4, $apemat);
        $query->bindParam(5, $contra);
        //$query->bindParam(6, $nivel);
        $query->execute();
        //solo se utiliza cuando no retornas un valor en el procedure

        /* if ($resultado == 1) {
    return 5;
  } else {
    return 0;
  }-*/
        if ($row = $query->fetchColumn()) {
            return $row;
        }

        conexion_nueva::cerrar_conexion();
    }
    function modificar_usuario($id, $dni, $nombre, $apepat, $apemat, $contra, $nivel)
    {
        $c = conexion_nueva::conectarBD();

        $sql = "SELECT *FROM  sp_modificar_usuario(?,?,?,?,?,?,?) ";


        $query = $c->prepare($sql);
        $query->bindParam(1, $id);
        $query->bindParam(2, $dni);
        $query->bindParam(3, $nombre);
        $query->bindParam(4, $apepat);
        $query->bindParam(5, $apemat);
        $query->bindParam(6, $contra);
        $query->bindParam(7, $nivel);
        //$query->bindParam(8, $estado);
        $query->execute();
        if ($row = $query->fetchColumn()) {
            return $row;
        }

        conexion_nueva::cerrar_conexion();
    }
    function modificar_contra_usuario($id, $contra)
    {
        $c = conexion_nueva::conectarBD();
        $sql = "SELECT *FROM  sp_modificar_contra_usuario(?,?) ";
        $query = $c->prepare($sql);
        $query->bindParam(1, $id);
        $query->bindParam(2, $contra);
        $query->execute();
        if ($row = $query->fetchColumn()) {
            return $row;
        }

        conexion_nueva::cerrar_conexion();
    }

    public function Modificar_Usuario_Estatus($id, $estatus)
    {
        $con = conexion_nueva::conectarBD();
        $sql = "select sp_modificar_usuario_estatus(?,?)";
        $query = $con->prepare($sql);
        $query->bindParam(1, $id);
        $query->bindParam(2, $estatus);

        $resultado = $query->execute();
        //Se utiliza cuando no retornas un valor en el procedure
        if ($resultado) {
            return 1;
        } else {
            return 0;
        }
        conexion_nueva::cerrar_conexion();
    }
}
