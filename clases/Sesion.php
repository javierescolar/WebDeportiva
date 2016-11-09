<?php

class Sesion {

    function __construct() {
        session_start();
    }

    function checkSesion($nombre) {
        return (isset($_SESSION[$nombre]));
    }

    function setSesion($nombre, $value) {
        $_SESSION[$nombre] = $value;
    }

    function getSesion($nombre) {
        return $_SESSION[$nombre];
    }

    function destroySesion($nombre) {
        unset($_SESSION[$nombre]);
    }

    function destroy() {
        $_SESSION = [];
        session_destroy();
    }

}

?>