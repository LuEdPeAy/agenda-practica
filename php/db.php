<?php
include_once('conexion.php');

class ManagementDB{

    public $conexion;
    public $contacts;
    public $contact;

    public function __construct(){
        try {
            $db = new conexionDB;
            $this->conexion = $db->getConexion();

            if (!$this->conexion instanceof PDO) {
                throw new Exception("No se obtuvo una instancia válida de PDO.");
            }
        } catch (Exception $e) {
            echo "Error en ManagementDB: " . $e->getMessage();
        }

    }

    public function saveDB($contacto){
        $this->__construct();
        $contact = [
            ':nombre' => $contacto['nombre'],
            ':numero' => $contacto['numero'],
            ':ciudad' => $contacto['ciudad'],
            ':empresa' => $contacto['empresa'],
        ];
        try{
            $sql = "INSERT INTO contacts (name, number, city, company) VALUES (:nombre, :numero, :ciudad, :empresa)";
            $stmt = $this->conexion->prepare($sql);

            $stmt->execute($contacto);

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        } finally {
            // Cerrar conexión
            $stmt = null;
            $this->conexion = null;
        }

    }

    public function getContacts(){
        $this->__construct();

        try{
            $sql = "SELECT * FROM contacts";
            $stmt = $this->conexion->prepare($sql);

            $stmt->execute();

            $this->contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $this->contacts;

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        } finally {
            // Cerrar conexión
            $stmt = null;
            $this->conexion = null;
        }

    }

    public function getContact($id){
        
        $this->__construct();

        try{
            $sql = "SELECT * FROM contacts WHERE id=".$id;
            $stmt = $this->conexion->prepare($sql);

            $stmt->execute();

            $this->contact = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $this->contact;
            
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        } finally {
            // Cerrar conexión
            $stmt = null;
            $this->conexion = null;
        }

    }
}

?>