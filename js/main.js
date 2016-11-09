var filas = 0;
document.getElementById('nuevoEquipo').addEventListener('click', function () {
   // var permite = true;
    var tabla = document.getElementById('tablaEquipos');

   /* Array.prototype.forEach.call(tabla.children, function (e) {
        if (e.children[0].textContent == "") {
            permite = false;
        }
    });*/
   // if (permite) {
        var fila = document.createElement('tr'),
                cell = document.createElement('td'),
                input = document.createElement('input');
        input.setAttribute("type", "text");
        input.setAttribute("class", "form-control");
        input.setAttribute("name", "equipos[" + filas + "]");
        cell.appendChild(input);
        fila.appendChild(cell);
        tabla.appendChild(fila);
        filas++;
    //}

});