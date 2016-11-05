<?php
// FUNCI�N DE CONEXI�N CON LA BASE DE DATOS MYSQL

class BD {

    private $basedatos = '4webdeportiva';
    private $usuario = 'root';
    private $contrasenya = '';
    private $equipo = '127.0.0.1';
    
    protected static $bd = null;
    private function __construct() {
        try {
            self::$bd = new PDO("mysql:host=$this->equipo;dbname=$this->basedatos", $this->usuario, $this->contrasenya);
        } catch (PDOException $e) {
            echo "Connection Error: " . $e->getMessage();
            die();
        }
    }

    public static function getConexion() {
        if (!self::$bd) {
            new BD();
        }
        return self::$bd;
    }

}

?>