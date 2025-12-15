// Datos del array a mostrar en el HTML
var busqueda = new Set();
busqueda.add("Bebida");
busqueda.add("Comida");

function categorias(){
 	var xhttp = new XMLHttpRequest();       
 	xhttp.onreadystatechange = function() {
 	 if (this.readyState == 4 && this.status == 200) {  
 		// crear lista categoria
 		var categoria = document.createElement("ul");
 		// crear lista escuderia
 		var escuderia = document.createElement("ul");
 		// meter los datos de la respuesta en un array
 		var motociclismo = JSON.parse(this.response);				
		// para cada elemento del array 
		for(var i = 0; i < motociclismo.length; i++){
			if (busqueda.has(motociclismo[i]["nombre"])) {
				//se crea un elemento ul con el campo  nombre 
				var elem = document.createElement("li");
				elem.innerHTML = motociclismo[i]["nombre"];
				// se añade a la lista
				categoria.appendChild(elem);
			}		
		}
		var body = document.getElementById("principal");
		// eliminar el contenido actual
		body.innerHTML = "";
		body.appendChild(categoria);
		
	 }
	};
	xhttp.open("GET", "matrizMotos.php", true);     
	xhttp.send(); 
	// para que no se siga el link que llama a esta función
	return false;
}
