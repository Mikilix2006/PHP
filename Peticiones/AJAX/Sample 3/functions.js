function categorias(){
 	var xhttp = new XMLHttpRequest();       
 	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			// meter los datos de la respuesta en un array
			var datos = JSON.parse(this.response);
			var matriz = datos[0];
			var busqueda = datos[1];
			// crear lista categoria
			var categoria = document.createElement("ul");
			// crear lista escuderia
			var escuderia = document.createElement("ul");
			// crear lista escuderia
			var piloto = document.createElement("ul");
			// procesar busqueda
			var resultadoFinal;
			// 3 campos rellenos
			if (busqueda["tipo_busqueda"] == 111) {
				resultadoFinal = busquedaCompleta(busqueda, matriz);
			// 2 campos rellenos
			} else if (busqueda["tipo_busqueda"] == 110) {
				resultadoFinal = busquedaPorCatEsc(busqueda, matriz);
			} else if (busqueda["tipo_busqueda"] == 101) {
				resultadoFinal = busquedaPorCatPil(busqueda, matriz);
			} else if (busqueda["tipo_busqueda"] == 11) {
				resultadoFinal = busquedaPorEscPil(busqueda, matriz);
			// 1 campo relleno
			} else if (busqueda["tipo_busqueda"] == 100) {
				resultadoFinal = busquedaPorCat(busqueda, matriz);
			} else if (busqueda["tipo_busqueda"] == 10) {
				resultadoFinal = busquedaEsc(busqueda, matriz);
			} else if (busqueda["tipo_busqueda"] == 1) {
				resultadoFinal = busquedaPil(busqueda, matriz);
			// ningun campo relleno
			} else if (busqueda["tipo_busqueda"] == 0) {
				resultadoFinal = busquedaVacia();
			// busqueda por contenido
			} else if (busqueda["tipo_busqueda"] == 1000) {
				resultadoFinal = busquedaContenido(busqueda, matriz);
			}
			// para cada elemento del array 
			/**
			 
			   FOR NO VALIDO, TOMAR COMO REFERENCIA PARA HACER EL RESTO

			 */
			for(var i = 0; i < matriz.length; i++) {
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
			body.appendChild(resultadoFinal);
			
		}
	};
	xhttp.open("GET", "main.php", true);     
	xhttp.send(); 
	// para que no se siga el link que llama a esta función
	return false;
}

function busquedaCompleta(busqueda, matriz) {
	
}

function busquedaPorCatEsc(busqueda, matriz) {
	
}

function busquedaPorCatPil(busqueda, matriz) {
	
}

function busquedaPorEscPil(busqueda, matriz) {
	
}

function busquedaPorCat(busqueda, matriz) {
	
}

function busquedaEsc(busqueda, matriz) {
	
}

function busquedaPil(busqueda, matriz) {
	
}

function busquedaContenido(busqueda, matriz) {

}

function busquedaVacia() {
	
}