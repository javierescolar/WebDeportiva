<?php

Class Usuario {

    private $id;
    private $username;
    private $pass;

    function __construct($id = null,  $username = null, $pass = null) {
        $this->id = $id;
        $this->username = $username;
        $this->pass = $pass;
    }

    function getId() {
        return $this->id;
    }

    function getUsername() {
        return $this->username;
    }

    function getPass() {
        return $this->pass;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setUsername($username) {
        $this->username = $username;
    }

    function setPass($pass) {
        $this->pass = $pass;
    }

    
    
        static function comprobarUsuarioPorCredenciales($username, $pass) {
        $select = "SELECT * FROM usuarios WHERE username = :username AND pass = :pass";
        $bd = BD::getConexion();
        $sentencia = $bd->prepare($select);
        $sentencia->execute([":username" => $username, ":pass" => $pass]);
        $sentencia->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Usuario');
        $usuario = $sentencia->fetch();
        return $usuario;
    }

    function persiste() {
        $bd = BD::getConexion();
        if ($this->id) {
            $select = "UPDATE usuarios SET  username = :username, pass = :pass WHERE id = " . $this->id;
            $sentencia = $bd->prepare($select);
            $result = $sentencia->execute([":username" => $this->username, ":pass" => $this->pass]);
        } else {
            $select = "INSERT INTO usuarios (username,pass) VALUES(:username,:pass)";
            $sentencia = $bd->prepare($select);
            $result = $sentencia->execute([":username" => $this->username, ":pass" => $this->pass]);
            if ($result) {
                $this->id = (int) $bd->lastInsertId();
            }
        }
        return $result;
    }

    
}

?>
