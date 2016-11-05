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
                <div class="col-md-12">
                <h4 class="col-md-6">Jornada 
                    <?php echo $_SESSION['jornadaPagina']; ?>
                    <small><?php echo date("d-m-Y", strtotime($liga->getJornadas()->getCurrent()->getFecha())); ?></small>
                </h4>
                <form class="form col-md-6" action="index.php" method="POST">
                    <input type="submit" class="col-md-offset-8 btn btn-link" name="verLigas" value="Volver"> 
                </form>
                </div>
                 <form class="form" action="index.php" method="POST"> 
                <?php
                include 'vistas/partials/tablaJornadas.php';
                ?>
                <div class="col-md-5">
               
                    <?php
                    if (!$liga->getJornadas()->currentObjIsFirst()) {
                        ?>
                        <input type="submit" class="btn btn-link" name="anterior" value="Anterior">
                        <?php
                    }
                    ?>
                    <?php
                    if (!$liga->getJornadas()->currentObjIsLast()) {
                        ?>
                        <input type="submit" class="btn btn-link" name="siguiente" value="Siguiente"> 
                        <?php
                    }
                    ?>
                    </div>
                 <div class="col-md-7">
                    <input type="submit" class="btn btn-link" name="clasificacion" value="Clasificacion">
                    <input type="submit" class="btn btn-link" name="guardar" value="Actualizar resultados">
                </div>
                </form>
            </div> 
        </div> 
    </body>
    <script src="js/jquery-1.12.1.min"></script> 
    <script src="js/bootstrap.min.js"></script> 
    <script src="js/main.js"></script> 
</html>

