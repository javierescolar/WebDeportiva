
<table class="table table-bordered">    
    <?php
    foreach ($jornada->getPartidos()->getObjects() as $partido) {

        echo "<tr>";
        echo "<td>" . $partido->getEquipoLocal() . "</td>";
        echo "<td>";
        echo "<input class='form-control col-md-1' type='number' name='golesLocal[" . $partido->getId() . "]' value='" . $partido->getGolesLocal() . "'>";
        echo "</td>";
        echo "<td>";
        echo "<input  class='form-control col-md-1' type='number' name='golesVisitante[" . $partido->getId() . "]' value='" . $partido->getGolesVisitante() . "'>";
        echo "</td>";
        echo "<td>" . $partido->getEquipoVisitante() . "</td>";
        echo "</tr>";
    }
    ?>
</table>



