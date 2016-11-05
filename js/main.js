var filas = 0;
document.getElementById('nuevoEquipo').addEventListener('click', function(){
    var tabla = document.getElementById('tablaEquipos');
    var fila = document.createElement('tr'),
        cell = document.createElement('td'),
        input = document.createElement('input');   
    input.setAttribute("type", "text"); 
    input.setAttribute("class", "form-control"); 
    input.setAttribute("name", "equipos["+filas+"]"); 
    cell.appendChild(input);
    fila.appendChild(cell);
    tabla.appendChild(fila);
    filas++;
});