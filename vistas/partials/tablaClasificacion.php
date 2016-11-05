<table class="table table-bordered">
    <tr>
        <th>Equipo</th>
        <th>PJ</th>
        <th>GF</th>
        <th>GC</th>
        <th>GA</th>
        <th>PTS</th>
    </tr>
    <?php
    foreach ($clasificacion as $equipo => $datos) {
        if ($equipo != "extra!!") {
            echo "<tr>";
            echo "<td>$equipo</td>";
            echo "<td>" . $datos['PJ'] . "</td>";
            echo "<td>" . $datos['GF'] . "</td>";
            echo "<td>" . $datos['GC'] . "</td>";
            echo "<td>" . $datos['GA'] . "</td>";
            echo "<td>" . $datos['PTS'] . "</td>";
            echo "</tr>";
        }
    }
    ?>
</table>


