<?php

class conexion_nueva
{

    private $host = 'localhost';
    private $dbname = 'omaped';
    private $usuario = 'postgres';
    private $password = 'ydaleu';

    private $pdo;


    public function conectarBD()
    {

        try {
            $this->pdo = new PDO("pgsql:host=$this->host;dbname=$this->dbname", $this->usuario, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->exec("SET NAMES 'UTF8'");
            //return"Conexión Lista";
            return $this->pdo;
        } catch (PDOException $e) {
            echo "Falló la conexión" . $e;
        }
    }
    public function cerrar_conexion()
    {
        $this->pdo = null;
    }

    public function consultar($sql)
    {
        $sentencia = $this->pdo->prepare($sql);
        $sentencia->execute();
        return $sentencia->fetchAll();
    }
}

//$llama= new conexion_nueva();
//$hola=$llama->conectarBD();
//echo $hola;
//$llamar->cerrar_conexion();
