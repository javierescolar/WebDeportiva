
<table class="table table-bordered">
    <?php
    if (count($ligas) == 0) {
        echo "<td>No hay ligas disponibles...</td>";
    } else {
        ?>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Calendario</th>
        </tr>
        <?php
        foreach ($ligas as $liga) {
            echo "<tr>";
            echo "<td>" . $liga->getId() . "</td>";
            echo "<td>" . $liga->getNombre() . "</td>";
            echo '<td><form class="form" action="index.php" method="POST">'; 
            echo "<input class='btn btn-primary' type='submit' name='ligaSeleccionada' value='Ver'>";
            echo "<input type='hidden' name='idLigaSeleccionada' value='". $liga->getId() ."'>";
            echo "</form></td>";
            echo "</tr>";
        }
    }
    ?>
</table>




