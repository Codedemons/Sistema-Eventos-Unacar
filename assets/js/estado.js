//var myElement = document.getElementById("cambio");
//myElement.className += " bg-gradient-danger";

let obtenerFila1 = document.getElementById("fila");


// Se obtienen los elementos td de cada fila
let elementosFila1 = obtenerFila1.getElementsByTagName("td");

console.log(elementosFila1[1].innerHTML);

var elemento = document.getElementById("cambio");
elemento.className += " bg-gradient-warning";
