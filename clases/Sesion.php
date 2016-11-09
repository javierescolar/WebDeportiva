<?php

class Sesion {

    //protected static $session = null;
    /*private function __construct() {
        try {
          self::$session = session_start();
        } catch (PDOException $e) {
            $error = "Error de sesión";
            throw new Exception($error);
        }
    }*/

    public static function initSesion() {
        /*if (!self::$session) {
            new Sesion();
        }
        return self::$session;*/
        return session_start();
    }
    
    function checkSesion($nombre){
        return (isset($_SESSION[$nombre]));
    }
    
    function setSesion($nombre,$value){
        $_SESSION[$nombre] = $value;
        
    }
    
    function getSesion($nombre){
        return  $_SESSION[$nombre];
    }
    
    function destroySesion($nombre){
        unset( $_SESSION[$nombre]);
    }
    
    function destroy(){
        $_SESSION = [];
        session_destroy();
    }
}

?>