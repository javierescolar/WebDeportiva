<?php

Class Jornada {

    private $id;
    private $idliga;
    private $fecha;
    private $partidos;

    function __construct($idliga = null, $fecha = null) {
        $this->idliga = $idliga;
        $this->fecha = $fecha;
        $this->partidos = new Collection();
    }

    function getId() {
        return $this->id;
    }

    function getIdliga() {
        return $this->idliga;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getPartidos() {
        return $this->partidos;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setIdliga($idliga) {
        $this->idliga = $idliga;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setPartidos($partidos) {
        $this->partidos = $partidos;
    }

    function persiste($bd) {
        $select = "INSERT INTO jornadas(idliga,fecha) VALUES (:idliga, :fecha)";
        $sentencia = $bd->prepare($select);
        $sentencia->execute([":idliga" => $this->idliga, ":fecha" => $this->fecha]);
        $this->id = $bd->lastInsertId();
    }

    static function obtenJornadas($bd,$idliga) {
        $select = "SELECT * FROM jornadas WHERE idliga = " . $idliga;
        $sentencia = $bd->prepare($select);
        $sentencia->execute();
        $sentencia->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Jornada');
        $jornadas = $sentencia->fetchAll();
        foreach ($jornadas as $jornada) {
            foreach (Partido::obtenPartidos($bd,$jornada->getId()) as $partido) {
                $jornada->getPartidos()->add($partido);
            }
        }
        return $jornadas;
    }
}
