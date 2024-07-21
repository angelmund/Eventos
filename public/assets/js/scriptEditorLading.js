

//Obtener la ruta actual 
let url = $('#url').val();

/*Funciones especiales para este formulario*/
function estanVaciosInputText() {
    // Seleccionar todos los elementos con la clase 'items__text'
    const inputs = document.querySelectorAll('.items__text');
    let vacio = false;

    // Iterar sobre cada elemento y verificar si está vacío
    inputs.forEach((input, index) => {
        // Obtener el valor del campo de entrada actual y eliminar espacios en blanco
        const valor = input.value.trim();

        // Verificar si el campo está vacío
        if (valor === '' && index !== 6 && index !== 5) {
            // Marcar los inputs que están vacíos
            input.style.border = '1px solid red';
            // Si está vacío un input, marcar que al menos uno está vacío
            console.log('index: ' + index);

            vacio = true;
        } else {
            input.style.border = '1px solid black';
        }
    });

    return vacio;
}

/*addEventListener de la ViewEditorLading*/
//Boton para cerrar el contenedor
document.getElementById('abrir_editor').addEventListener('click', function (event) {
    ventanaFormulario('cointenerPrincipal');
});

document.getElementById('cerrar_editor').addEventListener('click', function (event) {
    event.preventDefault();
    ventanaFormulario('cointenerPrincipal');
});

//guardar una landing
document.getElementById('form_editor').addEventListener('submit', async function (event) {
    event.preventDefault(); // Evitar que el formulario se envíe de forma predeterminada

    try {
        //Espera a una respuesta
        const confirmacion = await ventanaMostrarMensaje('confirmacion', '¿Deseas Terminar diseño de la web?');

        //Si la respuesta es sí
        if (confirmacion.value) {
            //Si un campo importante esta vacío
            if (estanVaciosInputText()) {
                //Marcara que debe de llenar los campos restantes
                ventanaMostrarMensaje(
                    'error',
                    'Llena los campos restantes.'
                );
                return; // Detener el flujo de ejecución si hay campos vacíos
            }

            // Si hay archivos no válidos, detener el proceso
            if (verificarArchivosDeImagen('items__file')) {
                //Marcara que debe de llenar los campos restantes
                ventanaMostrarMensaje(
                    'error',
                    'Imagen invalida, Agrega otra imagen valida.'
                );
                return; // Detener el flujo de ejecución si hay campos vacíos
            }

            // Obtener los datos del formulario
            const formData = new FormData(this);

            // Enviar los datos mediante Fetch
            fetch(url + '/createLading', {

                method: 'POST',
                mode: 'cors',
                // redirect: 'manual',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    // Aquí puedes manejar la respuesta del servidor si es necesario
                    //console.log('Datos enviados correctamente:', data);
                    if (data.idnotificacion == 1) {
                        Swal.fire({
                            title: "Evento guardado con éxito",
                            icon: "success",
                            showConfirmButton: false,  // No mostrar el botón "Ok"
                            timer: 1500,  // Cerrar automáticamente después de 1500 milisegundos (1.5 segundos)
                            timerProgressBar: true, // Mostrar una barra de progreso durante el temporizador
                            text: data.mensaje // Muestra el mensaje de éxito recibido del servidor
                        });
                        // Esp
                        setTimeout(function () {
                            document.getElementById('form_editor').reset();
                            window.location.reload();
                        }, 1000); // Espera 1 segundo
                    } else {
                        // En caso de que la respuesta no sea exitosa, muestra el mensaje de error recibido del servidor
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: data.mensaje
                        });
                    }
                })
                .catch(error => {
                    // Manejo de errores en caso de que falle la solicitud fetch
                    ventanaMostrarMensaje(
                        'error',
                        'Ups. Hubo un error al guardar la lading. Intente más tarde.'
                    );
                    console.error('Error al procesar la respuesta del servidor:', error);
                });

        }
    } catch (error) {
        console.error('Error al mostrar mensaje de confirmación:', error);
    }
});
// //termina guardar 



{/* <script>
		document.addEventListener('DOMContentLoaded', function() {
			// Obtener el valor de eventoPaso desde PHP
			const eventoPaso = {{ json_encode($eventoPaso) }};
		
			// Verificar si el evento ha pasado
			if (eventoPaso) {
				// Ocultar el componente <p id="fechaEvento">
				document.getElementById('cronometro').style.display = 'none';
				document.getElementById('fechaEvento').style.display = 'none';
				document.getElementById('btn_abrirFormulario').style.display = 'none';
				document.getElementById('cronometro').style.display = 'none';
				document.getElementById('cronometro_fechas').style.display = 'none';
				document.getElementById('info__parrafo').style.display = 'none';
				
				// Mostrar el texto de evento ya terminado
				const textoEventoTerminado = document.createElement('p');
				textoEventoTerminado.textContent = 'El evento ya ha iniciado';
				document.getElementById('contenedorDelTexto').appendChild(textoEventoTerminado);
			} else {
				// Si el evento no ha pasado, mantener el componente <p id="fechaEvento"> visible
				document.getElementById('fechaEvento').style.display = 'block';
			}
		});
		if ($('#form_editLan').length > 0) {
			const btn = document.querySelector('#guardar_portada');
		btn.addEventListener("click", function (event) {
			event.preventDefault();
			
			//Obtener la ruta actual 
			const url = $('#url').val();
			// Usando el ID del elemento
			var landingPageId = $('#landingPageId').val();
			console.log(landingPageId);
			try {
				//Espera a una respuesta
				const confirmacion = await ventanaMostrarMensaje('confirmacion', '¿Deseas Terminar diseño de la web?');
				// Obtener el ID del evento desde el atributo de datos
				const eventoId = contenedorEvento.dataset.eventoId;
				console.log(eventoId);
	
				//Si la respuesta es sí
				if (confirmacion.value) {
					//Si un campo importante esta vacío
					if (estanVaciosInputText()) {
						//Marcara que debe de llenar los campos restantes
						ventanaMostrarMensaje(
							'error',
							'Llena los campos restantes.'
						);
						return; // Detener el flujo de ejecución si hay campos vacíos
					}
	
					// Si hay archivos no válidos, detener el proceso
					if (verificarArchivosDeImagen('items__file')) {
						//Marcara que debe de llenar los campos restantes
						ventanaMostrarMensaje(
							'error',
							'Imagen invalida, Agrega otra imagen valida.'
						);
						return; // Detener el flujo de ejecución si hay campos vacíos
					}
	
					// Obtener los datos del formulario
					const formData = new FormData(this);
	
					// Enviar los datos mediante Fetch
					fetch(url + '/actualizar/landing/' + landingPageId, {
	
						method: 'POST',
						mode: 'cors',
						// redirect: 'manual',
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						},
						body: formData
					})
						.then(response => response.json())
						.then(data => {
							// Aquí puedes manejar la respuesta del servidor si es necesario
							//console.log('Datos enviados correctamente:', data);
							if (data.idnotificacion == 1) {
								Swal.fire({
									title: "Evento guardado con éxito",
									icon: "success",
									showConfirmButton: false,  // No mostrar el botón "Ok"
									timer: 1500,  // Cerrar automáticamente después de 1500 milisegundos (1.5 segundos)
									timerProgressBar: true, // Mostrar una barra de progreso durante el temporizador
									text: data.mensaje // Muestra el mensaje de éxito recibido del servidor
								});
								// Esp
								setTimeout(function () {
									document.getElementById('form_editLan').reset();
									window.location.reload();
								}, 1000); // Espera 1 segundo
							} else {
								// En caso de que la respuesta no sea exitosa, muestra el mensaje de error recibido del servidor
								Swal.fire({
									icon: "error",
									title: "Error",
									text: data.mensaje
								});
							}
						})
						.catch(error => {
							// Manejo de errores en caso de que falle la solicitud fetch
							ventanaMostrarMensaje(
								'error',
								'Ups. Hubo un error al guardar la lading. Intente más tarde.'
							);
							console.error('Error al procesar la respuesta del servidor:', error);
						});
	
				}
			} catch (error) {
				console.error('Error al mostrar mensaje de confirmación:', error);
			}
		});
			
		}
	</script> */}

