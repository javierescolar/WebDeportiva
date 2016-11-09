<?php

Class Partido {

    private $id;
    private $idjornada;
    private $equipoLocal;
    private $equipoVisitante;
    private $golesLocal;
    private $golesVisitante;

    function __construct($idjornada = null, $equipoLocal = null, $equipoVisitante = null, $golesLocal = null, $golesVisitante = null) {
        $this->idjornada = $idjornada;
        $this->equipoLocal = $equipoLocal;
        $this->equipoVisitante = $equipoVisitante;
        $this->golesLocal = $golesLocal;
        $this->golesVisitante = $golesVisitante;
    }

    function getId() {
        return $this->id;
    }

    function getIdjornada() {
        return $this->idjornada;
    }

    function getEquipoLocal() {
        return $this->equipoLocal;
    }

    function getEquipoVisitante() {
        return $this->equipoVisitante;
    }

    function getGolesLocal() {
        return $this->golesLocal;
    }

    function getGolesVisitante() {
        return $this->golesVisitante;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setIdjornada($idjornada) {
        $this->idjornada = $idjornada;
    }

    function setEquipoLocal($equipoLocal) {
        $this->equipoLocal = $equipoLocal;
    }

    function setEquipoVisitante($equipoVisitante) {
        $this->equipoVisitante = $equipoVisitante;
    }

    function setGolesLocal($golesLocal) {
        $this->golesLocal = $golesLocal;
    }

    function setGolesVisitante($golesVisitante) {
        $this->golesVisitante = $golesVisitante;
    }

    function persiste($bd) {
        if ($this->id) {
            $select = "UPDATE partidos SET golesLocal = :golesLocal,"
                    . " golesVisitante = :golesVisitante "
                    . " WHERE id = ".$this->id;
            $sentencia = $bd->prepare($select);
            $resul = $sentencia->execute([":golesLocal" => $this->golesLocal,":golesVisitante" => $this->golesVisitante]);
        } else {
            $select = "INSERT INTO partidos(idjornada,equipoLocal,equipoVisitante,golesLocal,golesVisitante) VALUES (:idjornada,:equipoLocal,:equipoVisitante,:golesLocal,:golesVisitante)";
            $sentencia = $bd->prepare($select);
            $resul = $sentencia->execute([":idjornada" => $this->idjornada,
                                        ":equipoLocal" => $this->equipoLocal,
                                        ":equipoVisitante" => $this->equipoVisitante,
                                        ":golesLocal" => $this->golesLocal,
                                        ":golesVisitante" => $this->golesVisitante]);
            $this->id = $bd->lastInsertId();
        }
        return $resul;
    }
    
    static function obtenPartidos ($bd,$idjornada){
        $select = "SELECT * FROM partidos WHERE idjornada = ".$idjornada;
        $sentencia = $bd->prepare($select);
        $sentencia->execute();
        $sentencia->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Partido');
        $partidos = $sentencia->fetchAll();
        return $partidos;
    }

}
