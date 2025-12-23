function categorias(){
 	var xhttp = new XMLHttpRequest();       
 	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			// Meter los datos de la respuesta en una variable matriz
			var matriz = JSON.parse(this.response);
			// Recoger datos del formulario
			const categoria = document.getElementById("categoria");
			const escuderia = document.getElementById("escuderia");
			const piloto = document.getElementById("piloto");
			const contenido = document.getElementById("contenido");
			// Variables de control
			var categoria_filled = false;
			var escuderia_filled = false;
			var piloto_filled = false;
			var contenido_filled = false;
			// Comprobar qué variables están rellenas
			// +
			// Formateo de variables
			if (categoria.value.trim() != "") {
				categoria_filled = true;
				var categoria_value = categoria.value.toLowerCase().trim()
			}
			if (escuderia.value.trim() != "") {
				escuderia_filled = true;
				var escuderia_value = escuderia.value.toLowerCase().trim()
			}
			if (piloto.value.trim() == "1" || piloto.value.trim() == "2") {
				piloto_filled = true;
				var piloto_value = piloto.value.toLowerCase().trim()
			}
			if (contenido.value.trim() != "") {
				contenido_filled = true;
				var contenido_value = contenido.value.toLowerCase().trim()
			}
			// Procesamiento de búsqueda
			var resultadoFinal;
			// 3 campos rellenos
			if (categoria_filled && escuderia_filled && piloto_filled) {
				resultadoFinal = busquedaCompleta(matriz);
			// 2 campos rellenos
			} else if (categoria_filled && escuderia_filled && !piloto_filled) {
				resultadoFinal = busquedaPorCatEsc(matriz);
			} else if (categoria_filled && !escuderia_filled && piloto_filled) {
				resultadoFinal = busquedaPorCatPil(matriz);
			} else if (!categoria_filled && escuderia_filled && piloto_filled) {
				resultadoFinal = busquedaPorEscPil(matriz);
			// 1 campo relleno
			} else if (categoria_filled && !escuderia_filled && !piloto_filled) {
				resultadoFinal = busquedaPorCat(matriz);
			} else if (!categoria_filled && escuderia_filled && !piloto_filled) {
				resultadoFinal = busquedaEsc(matriz);
			} else if (!categoria_filled && !escuderia_filled && piloto_filled) {
				resultadoFinal = busquedaPil(matriz);
			// ningun campo relleno
			} else if (!categoria_filled && !escuderia_filled && !piloto_filled && !contenido_filled) {
				resultadoFinal = busquedaVacia();
			// busqueda por contenido
			} else if (contenido_filled) {
				resultadoFinal = busquedaContenido(matriz);
			}
			/**
			 
			   FOR NO VALIDO, TOMAR COMO REFERENCIA PARA HACER EL RESTO

			
			for(var i = 0; i < matriz.length; i++) {
				if (busqueda.has(motociclismo[i]["nombre"])) {
					//se crea un elemento ul con el campo  nombre
					var elem = document.createElement("li");
					elem.innerHTML = motociclismo[i]["nombre"];
					// se añade a la lista
					categoria.appendChild(elem);
				}		
			}
			 */
			var body = document.getElementById("principal");
			// eliminar el contenido actual
			body.innerHTML = "";
			//body.appendChild(resultadoFinal);
			
		}
	};
	xhttp.open("GET", "matrizMotos.php", true);     
	xhttp.send(); 
	// para que no se siga el link que llama a esta función
	return false;
}

function busquedaCompleta(busqueda, matriz) {
	console.log("Completa");
}

function busquedaPorCatEsc(busqueda, matriz) {
	console.log("Categoria Escuderia");
}

function busquedaPorCatPil(busqueda, matriz) {
	console.log("Categoria Piloto");
}

function busquedaPorEscPil(busqueda, matriz) {
	console.log("Escuderia Piloto");
}

function busquedaPorCat(busqueda, matriz) {
	console.log("Categoria");
}

function busquedaEsc(busqueda, matriz) {
	console.log("Escuderia");
}

function busquedaPil(busqueda, matriz) {
	console.log("Piloto");
}

function busquedaContenido(busqueda, matriz) {
	console.log("Contenido");
}

function busquedaVacia() {
	console.log("Vacía");
}