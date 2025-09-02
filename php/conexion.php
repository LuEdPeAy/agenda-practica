<?php

class conexionDB{

    private string $host;
    private string $user;
    private string $password;
    private string $database;
    private $conexion;

    public function __construct(){
        $this->host = 'localhost';
        $this->user = 'root';
        $this->password = '';
        $this->database = 'agenda';

        try {
            $this->conexion = new PDO("mysql:host=$this->host;dbname=$this->database;charset=utf8", $this->user, $this->password);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Lanza la excepción para que el error no se oculte
            throw new Exception("Error de conexión: " . $e->getMessage());

        }
    }

    public function getConexion(){
        return $this->conexion;
    }

    public function setHost($host){
        $this->host = $host;
    }

    public function setUser($user){
        $this->user = $user;
    }

    public function setPassword($password){
        $this->password = $password;
    }

    public function setDatabase($database){
        $this->database = $database;
    }

    public function getHost(){
        return $this->host;
    }

    public function getUser(){
        return $this->user;
    }

    public function getPassword(){
        return $this->password;
    }

    public function getDatabase(){
        return $this->database;
    }

    public function conectar(){
        
    }

    

}

/* try {
    $conexion = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $user, $password);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexión exitosa";
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
} */


?>
