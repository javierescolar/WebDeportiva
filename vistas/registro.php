<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Web deportiva</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/styles.css">
    </head>
    <body>
        <div class="container">
            <div class="col-md-6 col-md-offset-3">
                <h2 class="text-center">Registro</h2>
                <form class="form" action="index.php" method="POST"> 
                    <div class="form-group">
                        <input class="btn btn-link" type="submit" name="volver" value="Volver">
                    </div> 
                    <div class="form-group">
                        <label for="numSuperior">Username:</label>
                        <input class="form-control" type="text" name="username" >
                    </div> 
                    <div class="form-group">
                        <label for="numJugador">Password:</label>
                        <input class="form-control" type="password" name="password" >
                    </div> 
                     <?php echo isset($mensaje)?$mensaje:'';?>
                    <div class="form-group">
                        <input class="btn btn-primary col-md-offset-10" type="submit" name="registrarse" value="Guardar">
                    </div> 
                </form>
            </div> 
        </div> 
    </body>
    <script src="js/jquery-1.12.1.min"></script> 
    <script src="js/bootstrap.min.js"></script> 
    <script src="js/main.js"></script> 
</html>
