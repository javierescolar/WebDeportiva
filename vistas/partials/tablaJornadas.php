<table class="table table-bordered">    
    <?php
   
    foreach ($jornadas as $key =>$jornada) {

        echo "<tr>";
        echo "<td>Jornada " .($key + 1). "</td>";
        echo "<td>" . $jornada->getFecha(). "</td>";
        echo "<td><form action='index.php' method='POST'>"
              ."<input class='btn btn-primary col-md-10 col-md-offset-1' type='submit' name='jornadaSeleccionada' value='Ver'>"
              ."<input type='hidden' name='idJornadaSeleccionada' value='$key'>"  
              ."</form></td>";
        echo "</tr>";
    }
    ?>
</table>