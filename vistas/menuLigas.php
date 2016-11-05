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
                    <input type="submit" class="col-md-offset-11 btn btn-link" name="salir" value="Salir"> 
                </form>
                    <?php
                    include 'vistas/partials/tablaLigas.php';
                    ?>
                <form class="form" action="index.php" method="POST"> 
                    <input type="submit" class="btn btn-link" name="nuevaLiga" value="Crear Liga"> 
                    <input type="submit" class="btn btn-link" name="importarXML" value="Importar Liga"> 
                </form>
            </div> 
        </div> 
    </body>
    <script src="js/jquery-1.12.1.min"></script> 
    <script src="js/bootstrap.min.js"></script> 
    <script src="js/main.js"></script> 
</html>

