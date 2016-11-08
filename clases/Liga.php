<?php

Class Liga {

    private $id;
    private $nombre;
    private $jornadas;

    function __construct($nombre = null) {
        $this->nombre = $nombre;
        $this->jornadas = new Collection();
    }

    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getJornadas() {
        return $this->jornadas;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setJornadas($jornadas) {
        $this->jornadas = $jornadas;
    }

    static function muestraLigas() {
        $bd = BD::getConexion();
        $select = "SELECT * FROM liga";
        $sentencia = $bd->prepare($select);
        $sentencia->execute();
        $sentencia->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Liga');
        $ligas = $sentencia->fetchAll();
        return $ligas;
    }

    function roundRobin($equipos) {

        if (count($equipos) % 2 != 0) {
            array_push($equipos, "extra!!");
        }
        for ($i = 0; $i < count($equipos) - 1; $i++) {
            $locales = array_slice($equipos, 0, (count($equipos) / 2));
            $visitantes = array_reverse(array_slice($equipos, (count($equipos) / 2)));

            for ($j = 0; $j < count($visitantes); $j++) {
                $liga[$i][$j]['local'] = $locales[$j];
                $liga[$i][$j]['visitante'] = $visitantes[$j];
            }
            $equipoBase = array_shift($equipos);
            array_unshift($equipos, array_pop($equipos));
            array_unshift($equipos, $equipoBase);
        }
        foreach ($liga as $jornada) {
            $jornadaVuelta = [];
            foreach ($jornada as $partido) {
                $partidoVuelta['local'] = $partido['visitante'];
                $partidoVuelta['visitante'] = $partido['local'];
                $jornadaVuelta[] = $partidoVuelta;
            }
            array_push($liga, $jornadaVuelta);
        }
        return $liga;
    }

    function persiste($bd,$equipos, $fecha) {
        $select = "INSERT INTO liga(nombre) VALUES ('$this->nombre')";
        $sentencia = $bd->prepare($select);
        $sentencia->execute();
        $this->id = $bd->lastInsertId();
        $calendarioLiga = $this->roundRobin($equipos);
        foreach ($calendarioLiga as $jornada => $partidos) {
            $objJornada = new Jornada($this->id, $fecha);
            $objJornada->persiste();
            $nuevafecha = strtotime('+7 day', strtotime($fecha));
            $fecha = date('Y-m-j', $nuevafecha);
            foreach ($partidos as $partido => $datos) {
                $objPartido = new Partido($objJornada->getId(), $datos['local'], $datos['visitante'],0,0);
                $objPartido->persiste();
            }
        }
    }

    static function recuperaLigaSeleccionada($bd,$idLiga) {
        $select = "SELECT * FROM liga WHERE id = " . $idLiga;
        $sentencia = $bd->prepare($select);
        $sentencia->execute();
        $sentencia->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Liga');
        $liga = $sentencia->fetch();
        foreach (Jornada::obtenJornadas($liga->getId()) as $jornada) {
            $liga->getJornadas()->add($jornada);
        }
        return $liga;
    }

    function muestraClasificacion() {
        $datosClasificacion = ['PJ', 'GF', 'GC', 'PTS'];
        $equipos = [];
        foreach ($this->getJornadas()->getObjects() as $jornadas) {
            foreach ($jornadas->getPartidos()->getObjects() as $partidos) {
                if (!in_array($partidos->getEquipoLocal(), $equipos)) {
                    array_push($equipos, $partidos->getEquipoLocal());
                }
            }
        }
        $clasificacion = array_fill_keys($equipos, array_fill_keys($datosClasificacion, 0));

        foreach ($clasificacion as $equipo => $datos) {
            if ($equipo != "extra!!") {
                foreach ($this->getJornadas()->getObjects() as $jornadas) {
                    foreach ($jornadas->getPartidos()->getObjects() as $partido) {

                        if ($partido->getEquipoLocal() == $equipo) {
                            $clasificacion[$equipo]['PJ'] += 1;
                            $clasificacion[$equipo]['GF'] += $partido->getGolesLocal();
                            $clasificacion[$equipo]['GC'] += $partido->getGolesVisitante();
                            if ($partido->getGolesLocal() == $partido->getGolesVisitante()) {
                                $clasificacion[$equipo]['PTS'] += 1;
                            } else if ($partido->getGolesLocal() < $partido->getGolesVisitante()) {
                                $clasificacion[$equipo]['PTS'] += 0;
                            } else if ($partido->getGolesLocal() > $partido->getGolesVisitante()) {
                                $clasificacion[$equipo]['PTS'] += 3;
                            }
                        } else if ($partido->getEquipoVisitante() == $equipo) {
                            $clasificacion[$equipo]['PJ'] += 1;
                            $clasificacion[$equipo]['GF'] += $partido->getGolesLocal();
                            $clasificacion[$equipo]['GC'] += $partido->getGolesVisitante();
                            if ($partido->getGolesLocal() == $partido->getGolesVisitante()) {
                                $clasificacion[$equipo]['PTS'] += 1;
                            } else if ($partido->getGolesLocal() > $partido->getGolesVisitante()) {
                                $clasificacion[$equipo]['PTS'] += 0;
                            } else if ($partido->getGolesLocal() < $partido->getGolesVisitante()) {
                                $clasificacion[$equipo]['PTS'] += 3;
                            }
                        }
                    }
                }
            }
        }
        foreach ($clasificacion as $equipo => $datos) {
            if ($equipo != "extra!!") {
                $clasificacion[$equipo]['GA'] = number_format(($clasificacion[$equipo]['GF'] + $clasificacion[$equipo]['GC']) / $clasificacion[$equipo]['PJ'], 2, '.', ',');
            } else {
                $clasificacion[$equipo]['GA'] = 0;
            }
        }
        $maxPtos = array_column($clasificacion, 'PTS');
        $maxGA = array_column($clasificacion, 'GA');
        array_multisort($maxPtos, SORT_NUMERIC, SORT_DESC, $maxGA, SORT_NUMERIC, SORT_DESC, $clasificacion);
        return $clasificacion;
    }
    
    function importaLiga($bd,$fecha,$jornadas) {
        $select = "INSERT INTO liga(nombre) VALUES ('$this->nombre')";
        $sentencia = $bd->prepare($select);
        $sentencia->execute();
        $this->id = $bd->lastInsertId();
        foreach ($jornadas as $jornada => $partidos) {
            $objJornada = new Jornada($this->id, $fecha);
            $objJornada->persiste();
            $nuevafecha = strtotime('+7 day', strtotime($fecha));
            $fecha = date('Y-m-j', $nuevafecha);
            foreach ($partidos as $partido => $datos) {
                $objPartido = new Partido($objJornada->getId(), (String)$datos->equipoLocal, (String)$datos->equipoVisitante,(int)$datos->golesLocal,(int)$datos->golesVisitante);
                $objPartido->persiste();
            }
        }
    }
}
