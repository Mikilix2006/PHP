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
				var categoria_value = categoria.value.toLowerCase().trim();
			}
			if (escuderia.value.trim() != "") {
				escuderia_filled = true;
				var escuderia_value = escuderia.value.toLowerCase().trim();
			}
			if (piloto.value.trim() != "") {
				piloto_filled = true;
				var piloto_value = piloto.value.toLowerCase().trim();
			}
			if (contenido.value.trim() != "") {
				contenido_filled = true;
				var contenido_value = contenido.value.toLowerCase().trim();
			}
			// Procesamiento de búsqueda
			// 3 campos rellenos
			if (categoria_filled && escuderia_filled && piloto_filled) {
				busquedaCompleta(matriz, categoria_value, escuderia_value, piloto_value);
			// 2 campos rellenos
			} else if (categoria_filled && escuderia_filled && !piloto_filled) {
				busquedaPorCatEsc(matriz, categoria_value, escuderia_value);
			} else if (categoria_filled && !escuderia_filled && piloto_filled) {
				busquedaPorCatPil(matriz, categoria_value, piloto_value);
			} else if (!categoria_filled && escuderia_filled && piloto_filled) {
				busquedaPorEscPil(matriz, escuderia_value, piloto_value);
			// 1 campo relleno
			} else if (categoria_filled && !escuderia_filled && !piloto_filled) {
				busquedaCat(matriz, categoria_value);
			} else if (!categoria_filled && escuderia_filled && !piloto_filled) {
				busquedaEsc(matriz, escuderia_value);
			} else if (!categoria_filled && !escuderia_filled && piloto_filled) {
				busquedaPil(matriz, piloto_value);
			// ningun campo relleno
			} else if (!categoria_filled && !escuderia_filled && !piloto_filled && !contenido_filled) {
				busquedaVacia();
			// busqueda por contenido
			} else if (contenido_filled) {
				busquedaContenido(matriz, contenido_value);
			}
		}
	};
	xhttp.open("GET", "matrizMotos.php", true);     
	xhttp.send(); 
	// para que no se siga el link que llama a esta función
	return false;
}

/*

FUNCIONA A LA PERFECCIÓN

*/
function busquedaCompleta(matriz, categoria_value, escuderia_value, piloto_value) {
	// DEBUG
	console.log("Completa");

	var resultado_de_busqueda = document.getElementById("principal");
    // 1. Limpiar la pantalla antes de mostrar
	resultado_de_busqueda.innerHTML = "";

    for (var cat in matriz) {
        // 2. Comprobar si la categoría coincide con lo escrito
        if (cat.toLowerCase().includes(categoria_value)) {
            // Si la categoria existe, creara una linea para 
			// dicha categoria y la agrega a la lista
            var lista_categorias = document.createElement("ul");
            var linea_categorias = document.createElement("li");

			var contiene_escuderia = false;
			var contiene_piloto = false;
            
            linea_categorias.innerHTML = "<strong>" + cat + "</strong>";
            lista_categorias.appendChild(linea_categorias);
            
            var lista_escuderias = document.createElement("ul");
            for (var esc in matriz[cat]) {
				// 3. Comprobar si la escuderia coincide con lo escrito
				if (esc.toLowerCase().includes(escuderia_value)) {
					// Activacion de variable por existencia de escuderia encontrada
					contiene_escuderia = true;
					var linea_escuderias = document.createElement("li");
					linea_escuderias.innerHTML = esc;
					lista_escuderias.appendChild(linea_escuderias);

					// 4. Mostrar el piloto especificado
					var lista_pilotos = document.createElement("ul");	
					var linea_pilotos = document.createElement("li");
					if (piloto_value == "1") {
						// Activacion de variable por existencia de piloto encontrada
						contiene_piloto = true;
						var linea_pilotos = document.createElement("li");
						// matriz[cat][esc][pil] contiene "Nombre, País"
						linea_pilotos.innerHTML = "Piloto 1: " + matriz[cat][esc][0];
					}
					if (piloto_value == "2") {
						// Activacion de variable por existencia de piloto encontrada
						contiene_piloto = true;
						// matriz[cat][esc][pil] contiene "Nombre, País"
						linea_pilotos.innerHTML = "Piloto 2: " + matriz[cat][esc][1];
					}
					if (piloto_value == "1" || piloto_value == "2") {
						lista_pilotos.appendChild(linea_pilotos);
					}
					
					// Anidar: Pilotos dentro de Escudería, y Escudería dentro de Categoría en caso de que exista un piloto
					if (contiene_piloto) {
						linea_escuderias.appendChild(lista_pilotos);
						linea_categorias.appendChild(lista_escuderias);
					}
				}
            }
			// En caso de que la categoría contenga tanto escudería como piloto, la mostrará
			// En su defecto, no se mostrará
			if (contiene_piloto && contiene_escuderia) {
				linea_categorias.appendChild(lista_escuderias);

				// 5. Añadir todo al contenedor principal de la página
				resultado_de_busqueda.appendChild(lista_categorias);
			}
        }
    }

	// Mensaje de control si no hay coincidencias
    if (resultado_de_busqueda.innerHTML == "") {
        resultado_de_busqueda.innerHTML = "<p>No se encontraron coincidencias</p>";
    }
}

/*

FUNCIONA A LA PERFECCIÓN

*/
function busquedaPorCatEsc(matriz, categoria_value, escuderia_value) {
	// DEBUG
	console.log("Categoria Escuderia");

	var resultado_de_busqueda = document.getElementById("principal");
    // 1. Limpiar la pantalla antes de mostrar
	resultado_de_busqueda.innerHTML = "";

    for (var cat in matriz) {
        // 2. Comprobar si la categoría coincide con lo escrito
        if (cat.toLowerCase().includes(categoria_value)) {
            // Si la categoria existe, creara una linea para 
			// dicha categoria y la agrega a la lista
            var lista_categorias = document.createElement("ul");
            var linea_categorias = document.createElement("li");

			var contiene_escuderia = false;
			var contiene_piloto = false;
            
            linea_categorias.innerHTML = "<strong>" + cat + "</strong>";
            lista_categorias.appendChild(linea_categorias);
            
            var lista_escuderias = document.createElement("ul");
            for (var esc in matriz[cat]) {
				// 3. Comprobar si la escuderia coincide con lo escrito
				if (esc.toLowerCase().includes(escuderia_value)) {
					// Activacion de variable por existencia de escuderia encontrada
					contiene_escuderia = true;
					var linea_escuderias = document.createElement("li");
					linea_escuderias.innerHTML = esc;
					lista_escuderias.appendChild(linea_escuderias);

					// 4. Mostrar también los pilotos de esa escudería
					var lista_pilotos = document.createElement("ul");
					for (var pil in matriz[cat][esc]) {
						var linea_pilotos = document.createElement("li");
						linea_pilotos.innerHTML = "Piloto " + (parseInt(pil) + 1) + ": " + matriz[cat][esc][pil];
						
						lista_pilotos.appendChild(linea_pilotos);
					}
					// Anidar: Pilotos dentro de Escudería, y Escudería dentro de Categoría
					linea_escuderias.appendChild(lista_pilotos);
					linea_categorias.appendChild(lista_escuderias);
				}
            }
			// En caso de que la categoría contenga una escudería, la mostrará
			// En su defecto, no se mostrará
			if (contiene_escuderia) {
				linea_categorias.appendChild(lista_escuderias);

				// 5. Añadir todo al contenedor principal de la página
				resultado_de_busqueda.appendChild(lista_categorias);
			}
        }
    }

	// Mensaje de control si no hay coincidencias
    if (resultado_de_busqueda.innerHTML == "") {
        resultado_de_busqueda.innerHTML = "<p>No se encontraron coincidencias</p>";
    }
}

/*

FUNCIONA A LA PERFECCIÓN

*/
function busquedaPorCatPil(matriz, categoria_value, piloto_value) {
	// DEBUG
	console.log("Categoria Piloto");

	var resultado_de_busqueda = document.getElementById("principal");
    // 1. Limpiar la pantalla antes de mostrar
	resultado_de_busqueda.innerHTML = "";

    for (var cat in matriz) {
        // 2. Comprobar si la categoría coincide con lo escrito
        if (cat.toLowerCase().includes(categoria_value)) {
            // Si la categoria existe, creara una linea para 
			// dicha categoria y la agrega a la lista
            var lista_categorias = document.createElement("ul");
            var linea_categorias = document.createElement("li");

			var contiene_piloto = false;
            
            linea_categorias.innerHTML = "<strong>" + cat + "</strong>";
            lista_categorias.appendChild(linea_categorias);
            
            var lista_escuderias = document.createElement("ul");
            for (var esc in matriz[cat]) {
				// 3. Introducir las escuderías
				var linea_escuderias = document.createElement("li");
				linea_escuderias.innerHTML = esc;
				lista_escuderias.appendChild(linea_escuderias);

				// 4. Mostrar el piloto especificado
				var lista_pilotos = document.createElement("ul");	
				var linea_pilotos = document.createElement("li");
				if (piloto_value == "1") {
					// Activacion de variable por existencia de piloto encontrada
					contiene_piloto = true;
					var linea_pilotos = document.createElement("li");
					// matriz[cat][esc][pil] contiene "Nombre, País"
					linea_pilotos.innerHTML = "Piloto 1: " + matriz[cat][esc][0];
				}
				if (piloto_value == "2") {
					// Activacion de variable por existencia de piloto encontrada
					contiene_piloto = true;
					// matriz[cat][esc][pil] contiene "Nombre, País"
					linea_pilotos.innerHTML = "Piloto 2: " + matriz[cat][esc][1];
				}
				if (piloto_value == "1" || piloto_value == "2") {
					lista_pilotos.appendChild(linea_pilotos);
				}
				
				// Anidar: Pilotos dentro de Escudería, y Escudería dentro de Categoría en caso de que exista un piloto
				if (contiene_piloto) {
					linea_escuderias.appendChild(lista_pilotos);
					linea_categorias.appendChild(lista_escuderias);
				}
            }
			// En caso de que la categoría contenga tanto escudería como piloto, la mostrará
			// En su defecto, no se mostrará
			if (contiene_piloto) {
				linea_categorias.appendChild(lista_escuderias);

				// 5. Añadir todo al contenedor principal de la página
				resultado_de_busqueda.appendChild(lista_categorias);
			}
        }
    }

	// Mensaje de control si no hay coincidencias
    if (resultado_de_busqueda.innerHTML == "") {
        resultado_de_busqueda.innerHTML = "<p>No se encontraron coincidencias</p>";
    }
}

/*

FUNCIONA A LA PERFECCIÓN

*/
function busquedaPorEscPil(matriz, escuderia_value, piloto_value) {
	// DEBUG
	console.log("Escuderia Piloto");

	var resultado_de_busqueda = document.getElementById("principal");
    // 1. Limpiar la pantalla antes de mostrar
	resultado_de_busqueda.innerHTML = "";

    for (var cat in matriz) {
        // 2. Introducir las categorías
		var lista_categorias = document.createElement("ul");
		var linea_categorias = document.createElement("li");

		var contiene_escuderia = false;
		var contiene_piloto = false;
		
		linea_categorias.innerHTML = "<strong>" + cat + "</strong>";
		lista_categorias.appendChild(linea_categorias);
		
		var lista_escuderias = document.createElement("ul");
		for (var esc in matriz[cat]) {
			// 3. Comprobar si la escuderia coincide con lo escrito
			if (esc.toLowerCase().includes(escuderia_value)) {
				// Activacion de variable por existencia de escuderia encontrada
				contiene_escuderia = true;
				var linea_escuderias = document.createElement("li");
				linea_escuderias.innerHTML = esc;
				lista_escuderias.appendChild(linea_escuderias);

				// 4. Mostrar el piloto especificado
				var lista_pilotos = document.createElement("ul");	
				var linea_pilotos = document.createElement("li");
				if (piloto_value == "1") {
					// Activacion de variable por existencia de piloto encontrada
					contiene_piloto = true;
					var linea_pilotos = document.createElement("li");
					// matriz[cat][esc][pil] contiene "Nombre, País"
					linea_pilotos.innerHTML = "Piloto 1: " + matriz[cat][esc][0];
				}
				if (piloto_value == "2") {
					// Activacion de variable por existencia de piloto encontrada
					contiene_piloto = true;
					// matriz[cat][esc][pil] contiene "Nombre, País"
					linea_pilotos.innerHTML = "Piloto 2: " + matriz[cat][esc][1];
				}
				if (piloto_value == "1" || piloto_value == "2") {
					lista_pilotos.appendChild(linea_pilotos);
				}
				
				// Anidar: Pilotos dentro de Escudería, y Escudería dentro de Categoría en caso de que exista un piloto
				if (contiene_piloto) {
					linea_escuderias.appendChild(lista_pilotos);
					linea_categorias.appendChild(lista_escuderias);
				}
			}
		}
		// En caso de que la categoría contenga tanto escudería como piloto, la mostrará
		// En su defecto, no se mostrará
		if (contiene_piloto && contiene_escuderia) {
			linea_categorias.appendChild(lista_escuderias);

			// 5. Añadir todo al contenedor principal de la página
			resultado_de_busqueda.appendChild(lista_categorias);
		}
    }

	// Mensaje de control si no hay coincidencias
    if (resultado_de_busqueda.innerHTML == "") {
        resultado_de_busqueda.innerHTML = "<p>No se encontraron coincidencias</p>";
    }
}

/*

FUNCIONA A LA PERFECCIÓN

*/
function busquedaCat(matriz, categoria_value) {
	console.log("Categoria");

    var resultado_de_busqueda = document.getElementById("principal");
    // 1. Limpiar la pantalla antes de mostrar
	resultado_de_busqueda.innerHTML = "";

    for (var cat in matriz) {
        // 2. Comprobar si la categoría coincide con lo escrito
        if (cat.toLowerCase().includes(categoria_value)) {
            // Si la categoria existe, creara una linea para 
			// dicha categoria y la agrega a la lista
            var lista_categorias = document.createElement("ul");
            var linea_categorias = document.createElement("li");
            
            linea_categorias.innerHTML = "<strong>" + cat + "</strong>";
            lista_categorias.appendChild(linea_categorias);
            
            // 3. Mostrar también las escuderías de esa categoría
            var lista_escuderias = document.createElement("ul");
            for (var esc in matriz[cat]) {
                var linea_escuderias = document.createElement("li");
                linea_escuderias.innerHTML = esc;
                lista_escuderias.appendChild(linea_escuderias);

				// 4. Mostrar también los pilotos de esa escudería
				var lista_pilotos = document.createElement("ul");
                for (var pil in matriz[cat][esc]) {
                    var linea_pilotos = document.createElement("li");
                    // matriz[cat][esc][pil] contiene "Nombre, País"
                    linea_pilotos.innerHTML = "Piloto " + (parseInt(pil) + 1) + ": " + matriz[cat][esc][pil];
                    lista_pilotos.appendChild(linea_pilotos);
                }
                
                // Anidar: Pilotos dentro de Escudería, y Escudería dentro de Categoría
                linea_escuderias.appendChild(lista_pilotos);
                linea_categorias.appendChild(lista_escuderias);
            }
            linea_categorias.appendChild(lista_escuderias);

            // 5. Añadir todo al contenedor principal de la página
            resultado_de_busqueda.appendChild(lista_categorias);
        }
    }

	// Mensaje de control si no hay coincidencias
    if (resultado_de_busqueda.innerHTML == "") {
        resultado_de_busqueda.innerHTML = "<p>No se encontraron coincidencias</p>";
    }
}

/*

FUNCIONA A LA PERFECCIÓN

*/
function busquedaEsc(matriz, escuderia_value) {
	// DEBUG
	console.log("Escuderia");

	var resultado_de_busqueda = document.getElementById("principal");
    // 1. Limpiar la pantalla antes de mostrar
	resultado_de_busqueda.innerHTML = "";

    for (var cat in matriz) {
        // 2. Introducir las categorías
		var lista_categorias = document.createElement("ul");
		var linea_categorias = document.createElement("li");

		var contiene_escuderia = false;
		
		linea_categorias.innerHTML = "<strong>" + cat + "</strong>";
		lista_categorias.appendChild(linea_categorias);
		
		var lista_escuderias = document.createElement("ul");
		for (var esc in matriz[cat]) {
			// 3. Comprobar si la escuderia coincide con lo escrito
			if (esc.toLowerCase().includes(escuderia_value)) {
				// Activacion de variable por existencia de escuderia encontrada
				contiene_escuderia = true;
				var linea_escuderias = document.createElement("li");
				linea_escuderias.innerHTML = esc;
				lista_escuderias.appendChild(linea_escuderias);

				// 4. Mostrar también los pilotos de esa escudería
					var lista_pilotos = document.createElement("ul");
					for (var pil in matriz[cat][esc]) {
						var linea_pilotos = document.createElement("li");
						linea_pilotos.innerHTML = "Piloto " + (parseInt(pil) + 1) + ": " + matriz[cat][esc][pil];
						
						lista_pilotos.appendChild(linea_pilotos);
					}
					// Anidar: Pilotos dentro de Escudería, y Escudería dentro de Categoría
					linea_escuderias.appendChild(lista_pilotos);
					linea_categorias.appendChild(lista_escuderias);
			}
		}
		// En caso de que la categoría contenga tanto escudería como piloto, la mostrará
		// En su defecto, no se mostrará
		if (contiene_escuderia) {
			linea_categorias.appendChild(lista_escuderias);

			// 5. Añadir todo al contenedor principal de la página
			resultado_de_busqueda.appendChild(lista_categorias);
		}
    }

	// Mensaje de control si no hay coincidencias
    if (resultado_de_busqueda.innerHTML == "") {
        resultado_de_busqueda.innerHTML = "<p>No se encontraron coincidencias</p>";
    }
}

/*

FUNCIONA A LA PERFECCIÓN

*/
function busquedaPil(matriz, piloto_value) {
	// DEBUG
	console.log("Piloto");

	var resultado_de_busqueda = document.getElementById("principal");
    // 1. Limpiar la pantalla antes de mostrar
	resultado_de_busqueda.innerHTML = "";

    for (var cat in matriz) {
		var lista_categorias = document.createElement("ul");
		var linea_categorias = document.createElement("li");

		var contiene_piloto = false;
		
		linea_categorias.innerHTML = "<strong>" + cat + "</strong>";
		lista_categorias.appendChild(linea_categorias);
		
		var lista_escuderias = document.createElement("ul");
		for (var esc in matriz[cat]) {
			// 3. Introducir las escuderías
			var linea_escuderias = document.createElement("li");
			linea_escuderias.innerHTML = esc;
			lista_escuderias.appendChild(linea_escuderias);

			// 4. Mostrar el piloto especificado
			var lista_pilotos = document.createElement("ul");	
			var linea_pilotos = document.createElement("li");
			if (piloto_value == "1") {
				// Activacion de variable por existencia de piloto encontrada
				contiene_piloto = true;
				var linea_pilotos = document.createElement("li");
				// matriz[cat][esc][pil] contiene "Nombre, País"
				linea_pilotos.innerHTML = "Piloto 1: " + matriz[cat][esc][0];
			}
			if (piloto_value == "2") {
				// Activacion de variable por existencia de piloto encontrada
				contiene_piloto = true;
				// matriz[cat][esc][pil] contiene "Nombre, País"
				linea_pilotos.innerHTML = "Piloto 2: " + matriz[cat][esc][1];
			}
			if (piloto_value == "1" || piloto_value == "2") {
				lista_pilotos.appendChild(linea_pilotos);
			}
			
			// Anidar: Pilotos dentro de Escudería, y Escudería dentro de Categoría en caso de que exista un piloto
			if (contiene_piloto) {
				linea_escuderias.appendChild(lista_pilotos);
				linea_categorias.appendChild(lista_escuderias);
			}
		}
		// En caso de que la categoría contenga tanto escudería como piloto, la mostrará
		// En su defecto, no se mostrará
		if (contiene_piloto) {
			linea_categorias.appendChild(lista_escuderias);

			// 5. Añadir todo al contenedor principal de la página
			resultado_de_busqueda.appendChild(lista_categorias);
		}
    }

	// Mensaje de control si no hay coincidencias
    if (resultado_de_busqueda.innerHTML == "") {
        resultado_de_busqueda.innerHTML = "<p>No se encontraron coincidencias</p>";
    }
}

function busquedaContenido(matriz, contenido_value) {
	// DEBUG
	console.log("Contenido");

	var resultado_de_busqueda = document.getElementById("principal");
    resultado_de_busqueda.innerHTML = ""; // Limpiar antes de empezar

    // Recorremos Categorías
    for (var cat in matriz) {
        var lista_categorias = null;
        var linea_categoria = null;

        // Recorremos Escuderías
        for (var esc in matriz[cat]) {
            var lista_escuderias = null;
            var linea_escuderia = null;

            // Recorremos Pilotos
            for (var pil in matriz[cat][esc]) {
                var infoPiloto = matriz[cat][esc][pil];

                // Filtro: Solo si el piloto contiene el texto
                if (infoPiloto.toLowerCase().includes(contenido_value)) {
                    
                    // 1. Si es el primer piloto encontrado en esta CATEGORÍA, crear el encabezado
                    if (!lista_categorias) {
                        lista_categorias = document.createElement("ul");
                        linea_categoria = document.createElement("li");
                        linea_categoria.innerHTML = "<strong> " + cat + ":</strong>";
                        lista_categorias.appendChild(linea_categoria);
                        resultado_de_busqueda.appendChild(lista_categorias);
                    }

                    // 2. Si es el primer piloto encontrado en esta ESCUDERÍA, crear su nodo
                    if (!lista_escuderias) {
                        lista_escuderias = document.createElement("ul");
                        linea_escuderia = document.createElement("li");
                        linea_escuderia.innerHTML = esc;
                        lista_escuderias.appendChild(linea_escuderia);
                        linea_categoria.appendChild(lista_escuderias);
                    }

                    // 3. Añadir el PILOTO
                    var lista_pilotos = document.createElement("ul");
                    var linea_piloto = document.createElement("li");
                    linea_piloto.innerHTML = infoPiloto;
                    lista_pilotos.appendChild(linea_piloto);
                    linea_escuderia.appendChild(lista_pilotos);
                }
            }
        }
    }

    // Mensaje de control si no hay coincidencias
    if (resultado_de_busqueda.innerHTML == "") {
        resultado_de_busqueda.innerHTML = "<p>No se encontraron coincidencias</p>";
    }
}

/*

FUNCIONA A LA PERFECCIÓN

*/
function busquedaVacia() {
	// DEBUG
	console.log("Vacía");

	var resultado_de_busqueda = document.getElementById("principal");
	resultado_de_busqueda.innerHTML = "<strong> No se han introducido datos </strong>";
}