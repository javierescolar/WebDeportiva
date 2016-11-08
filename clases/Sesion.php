<?php
// FUNCI�N DE CONEXI�N CON LA BASE DE DATOS MYSQL

class Sesion {

    
    protected static $sesion = null;
    
    private function __construct() {
        try {
            self::$sesion = new Sesion();
        } catch (PDOException $e) {
            echo "Error Sesion: " . $e->getMessage();
            die();
        }
    }

    public static function getConexion() {
        if (!self::$sesion) {
            new Sesion();
        }
        return self::$sesion;
    }
    
    function login($sesion){
        
    }

}

?>