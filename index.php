<?php

require_once 'clases/BD.php';
require_once 'clases/Collection.php';
require_once 'clases/Liga.php';
require_once 'clases/Jornada.php';
require_once 'clases/Partido.php';
require_once 'clases/Usuario.php';

session_start();
try{
    $bd = BD::getConexion();
}  catch (Exception $e){
    $error = $e;
    include 'vistas/error.php';
    die();
}

if (isset($_SESSION['usuario'])) {
    if (isset($_SESSION['liga'])) {
        $liga = $_SESSION['liga'];
        if (isset($_POST['verLigas'])) {
            unset($_SESSION['liga']);
            $ligas = Liga::muestraLigas();
            include 'vistas/menuLigas.php';
        } else if (isset($_POST['siguiente'])) {
            $_SESSION['jornadaPagina'] += 1;
            $liga->getJornadas()->next();
            $jornada = $liga->getJornadas()->getCurrent();
            include 'vistas/jornadas.php';
        } else if (isset($_POST['anterior'])) {
            $_SESSION['jornadaPagina'] -= 1;
            $liga->getJornadas()->previous();
            $jornada = $liga->getJornadas()->getCurrent();
            include 'vistas/jornadas.php';
        } else if (isset($_POST['guardar'])) {
            $golesLocal = $_POST['golesLocal'];
            $golesVisitante = $_POST['golesVisitante'];
            $jornada = $liga->getJornadas()->getCurrent();
            foreach ($jornada->getPartidos()->getObjects() as $partido) {
                $partido->setGolesLocal($golesLocal[$partido->getId()]);
                $partido->setGolesVisitante($golesVisitante[$partido->getId()]);
                $partido->persiste();
            }
            include 'vistas/jornadas.php';
        } else if (isset($_POST['clasificacion'])) {
            $clasificacion = $liga->muestraClasificacion();
            include 'vistas/clasificacion.php';
        } else if (isset($_POST['exportarXML'])) {
            $clasificacion = $liga->muestraClasificacion();
            include 'vistas/partials/generarXML.php';
        }else if (isset($_POST['volverJornadas'])) {
            $jornada = $liga->getJornadas()->getCurrent();
            include 'vistas/jornadas.php';
        } else {
            $jornada = $liga->getJornadas()->getCurrent();
            include 'vistas/jornadas.php';
        }
    } else {
        $_SESSION['jornadaPagina'] = 1;
        if(isset($_POST['importarXML'])){
            $xml = simplexml_load_file('importarLiga.xml');
            $nombreLiga =(string) $xml->nombre;
            $fecha = (string)$xml->fechaInicio;
            $jornadas = (Array)$xml->jornada;
            $liga = new Liga($nombreLiga);
            $liga->importaLiga($bd,$fecha, $jornadas);
            $ligas = Liga::muestraLigas();
            include 'vistas/menuLigas.php';
        } else if (isset($_POST['nuevaLiga'])) {
            include 'vistas/introducirEquipos.php';
        } else if (isset($_POST['salir'])) {
            unset($_SESSION['liga']);
            unset($_SESSION['usuario']);
            session_destroy();
            include 'vistas/login.php';
        } else if (isset($_POST['enviarEquipos'])) {
            //obtengo los datos de la liga que vamos a crear
            $fechaCalendario = $_POST['fechaCalendario'];
            $nombreLiga = $_POST['liga'];
            $equipos = $_POST['equipos'];
            //creo el objeto liga para crear la nueva liga
            $liga = new Liga($nombreLiga);
            $liga->persiste($bd,$equipos, $fechaCalendario);
            //volvemos a la vista para ver las ligas
            $ligas = Liga::muestraLigas();
            include 'vistas/menuLigas.php';
        } else if (isset($_POST['ligaSeleccionada'])) {
            $liga = Liga::recuperaLigaSeleccionada($bd,$_POST['idLigaSeleccionada']);
            $jornada = $liga->getJornadas()->getCurrent();
            $_SESSION['liga'] = $liga;
            include 'vistas/jornadas.php';
        } else {
            $ligas = Liga::muestraLigas();
            include 'vistas/menuLigas.php';
        }
    }
} else {
    if (isset($_POST['login'])) {
        $usuario = Usuario::comprobarUsuarioPorCredenciales($bd,$_POST['username'], $_POST['password']);
        if ($usuario) {
            $_SESSION['usuario'] = $usuario;
            $ligas = Liga::muestraLigas();
            include 'vistas/menuLigas.php';
        } else {
            $mensaje = "Usuario no existe o las credenciales no son correctas";
            include 'vistas/login.php';
        }
    } else if (isset($_POST['formRegistro'])) {
        include 'vistas/registro.php';
    } else if (isset($_POST['registrarse'])) {
        $usuNew = new Usuario(null, $_POST['username'], $_POST['password']);
        try {
            $usuNew->persiste($bd);
            $mensaje = "Usuario Registrado";
        } catch (Exception $ex) {
            $mensaje = $ex->getMessage();
        }
        include 'vistas/registro.php';
    } else {
        include 'vistas/login.php';
    }
}
?>