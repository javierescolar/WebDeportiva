<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Web deportiva</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/styles.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    </head>
    <body>
        <div class="container">
            <div class="col-md-6 col-md-offset-3">
                <h2 class="text-center">Login</h2>
                <form class="form" action="index.php" method="POST"> 
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="username" id="username"  placeholder="Enter your Username"/>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                            <input type="password" class="form-control" name="password" id="password"  placeholder="Enter your Password"/>
                        </div>
                    </div> 
                    <?php echo isset($mensaje) ? $mensaje : ''; ?>

                    <div class="form-group">
                        <input class="btn btn-link" type="submit" name="formRegistro" value="Sing on">
                        <input class="btn btn-primary" type="submit" name="login" value="Sing In">
                    </div> 

                </form>
            </div> 
        </div> 
    </body>
    <script src="js/jquery-1.12.1.min"></script> 
    <script src="js/bootstrap.min.js"></script> 
    <script src="js/main.js"></script> 
</html>
