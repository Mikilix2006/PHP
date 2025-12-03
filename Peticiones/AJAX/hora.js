/*
AL CARGAR EL DOCUMENTO

Crea una peticion HTTP asincrona al servidor
con los parametros pasados por el archivo hora.php,
recibiendo la respuesta para modificar el contenido
del elemento con id "hora" en el archivo index.html
cada 5000 milisegundos o 5 segundos.

 xhttp.open("GET", "hora.php", true) {
        "GET" : es el metodo por el cual va a hacer la peticion,
                se podria usar tambien POST, PUT y DELETE.
        "hora.php" : son los parámetros que se el pasan a la
                     peticion.
        true : indica que la peticion es asincrona,
               si pusiera false la peticion seria sincrona.
 }
*/
function loadDoc() {
    var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            const divs = document.getElementsByTagName("div")
            //for (const div of divs) {
            //    div.style.color="red";
            //}
            if (this.readyState == 0) { // 0 --> va tan rapido que no detecta el estado 0
                document.getElementById("state0").style.color="green";
            }
            if (this.readyState == 1) { // 1
                document.getElementById("state1").style.color="green";
            } 
            if (this.readyState == 2) { // 2
                document.getElementById("state2").style.color="green";
            }      
            if (this.readyState == 3) { // 3
                document.getElementById("state3").style.color="green";
            }
            if (this.readyState == 4 && this.status == 200) { // 4
                document.getElementById("state4").style.color="green";
                document.getElementById("hora").innerHTML =
                    "Hora en el servidor: " + this.response;
            }
        };
    xhttp.open("GET", "hora.php", true); // configura la peticion, true = asincrono
    xhttp.send(); // se envia la peticion
    return false;
}

setInterval(loadDoc, 5000); // cada 5 seg se ejecuta la funcion loadDoc