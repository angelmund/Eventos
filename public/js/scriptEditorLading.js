//Obtener la ruta actual 
const rutaActual = window.location.href;

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
document.getElementById('abrir_editor').addEventListener('click', function(event) {    
    ventanaFormulario('cointenerPrincipal');    
});

document.getElementById('cerrar_editor').addEventListener('click', function(event) {
    event.preventDefault();
    ventanaFormulario('cointenerPrincipal');
});

document.getElementById('form_editor').addEventListener('submit', async function(event) {
    event.preventDefault(); // Evitar que el formulario se envíe de forma predeterminada

    try {
        //Espera a una respuesta
        const confirmacion = await ventanaMostrarMensaje('confirmacion', '¿Deseas Terminar diseño de la web?');

        //Si la respuesta es sí
        if (confirmacion.value) {             
            //Si un campo importante esta vacío
            if(estanVaciosInputText() ) {                
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
            fetch(rutaActual + 'url_para_guardar_los_estilos_lading_en_un_json', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error al enviar los datos');
                }
                return response.json();
            })
            .then(data => {
                // Aquí puedes manejar la respuesta del servidor si es necesario
                //console.log('Datos enviados correctamente:', data);
                ventanaMostrarMensaje(
                    'exito',
                    '¡Se ha guardado tu lading exitosamente!'
                );

                //Cerramos el contenedor y enviamos los datos del formulario
                ventanaFormulario('cointenerPrincipal');

                //Lo envia de vuelta al panel de administración

            })
            .catch(error => {
                ventanaMostrarMensaje(
                    'error',
                    'Ups. Hubo un error al guardar la lading. Intente más tarde.'
                );

            });
        }
    } catch (error) {
        console.error('Error al mostrar mensaje de confirmación:', error);
    }
});
