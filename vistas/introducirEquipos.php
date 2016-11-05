<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Web Deportiva</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/styles.css">
    </head>
    <body>
        <div class="container">
            <div class="col-md-6 col-md-offset-3">
                <h2 class="text-center">Web Deportiva</h2>
                <form class="form" action="index.php" method="POST">
                     <input type="submit" class="col-md-offset-8 btn btn-link" name="verLigas" value="Volver"> 
                    <div class="form-group col-md-6">
                        <label for="fechaCalendario">Inicio Calendario</label>
                        <input class="form-control" type="date" name="fechaCalendario">
                    </div> 
                    <div class="form-group col-md-4">
                        <label for=""></label>
                        <input class="btn btn-primary col-md-offset-8" type="submit" name="enviarEquipos" value="Crear Liga">
                    </div> 
                    <br>
                    <div class="form-group col-md-12">
                        <div class="form-group">
                            <label for="liga">Nombre Liga</label>
                            <input class="form-control" type="text" name="liga">
                        </div> 
                        <h4>Equipos</h4>
                        <table class="table table-bordered" id="tablaEquipos">

                        </table>
                        <p id="nuevoEquipo" class="btn btn-link">Añadír Equipo</p>
                    </div> 

                </form>
            </div> 
        </div> 
    </body>
    <script src="js/jquery-1.12.1.min"></script> 
    <script src="js/bootstrap.min.js"></script> 
    <script src="js/main.js"></script> 
</html>

