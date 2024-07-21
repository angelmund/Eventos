// import { ventanaFormulario, ventanaMostrarMensaje, verificarArchivosDeImagen } from "./funcionesVentana";
// if ($('#form_editLan').length > 0) {
// const btn = document.querySelector('#guardar_portada');
// btn.addEventListener("click", function (event) {
// 	event.preventDefault();

// 	//Obtener la ruta actual 
// 	const url = $('#url').val();
// 	// Usando el ID del elemento
// 	var landingPageId = $('#landingPageId').val();
//     alert(url);
// 	console.log(landingPageId);

// });

// }
if ($('form_editLan').length > 0) {
    const btn = document.querySelectorById('#guardar_portada');
    btn.addEventListener("click", function (event) {
        event.preventDefault();

        event.preventDefault(); // Evitar que el formulario se envíe de forma predeterminada
        //Obtener la ruta actual 
        const url = $('#url').val();
        // Usando el ID del elemento
        var landingPageId = $('#landingPageId').val();
        alert("Hola");
        console.log(landingPageId);
        // try {
        //     //Espera a una respuesta
        //     const confirmacion = await ventanaMostrarMensaje('confirmacion', '¿Deseas Terminar diseño de la web?');

        //     //Si la respuesta es sí
        //     if (confirmacion.value) {
        //         //Si un campo importante esta vacío
        //         if (estanVaciosInputText()) {
        //             //Marcara que debe de llenar los campos restantes
        //             ventanaMostrarMensaje(
        //                 'error',
        //                 'Llena los campos restantes.'
        //             );
        //             return; // Detener el flujo de ejecución si hay campos vacíos
        //         }

        //         // Si hay archivos no válidos, detener el proceso
        //         if (verificarArchivosDeImagen('items__file')) {
        //             //Marcara que debe de llenar los campos restantes
        //             ventanaMostrarMensaje(
        //                 'error',
        //                 'Imagen invalida, Agrega otra imagen valida.'
        //             );
        //             return; // Detener el flujo de ejecución si hay campos vacíos
        //         }

        //         // Obtener los datos del formulario
        //         const formData = new FormData(this);

        //         // Enviar los datos mediante Fetch
        //         fetch(url + '/actualizar/landing/' + landingPageId, {

        //             method: 'POST',
        //             mode: 'cors',
        //             // redirect: 'manual',
        //             headers: {
        //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //             },
        //             body: formData
        //         })
        //             .then(response => response.json())
        //             .then(data => {
        //                 // Aquí puedes manejar la respuesta del servidor si es necesario
        //                 //console.log('Datos enviados correctamente:', data);
        //                 if (data.idnotificacion == 1) {
        //                     Swal.fire({
        //                         title: "Evento guardado con éxito",
        //                         icon: "success",
        //                         showConfirmButton: false,  // No mostrar el botón "Ok"
        //                         timer: 1500,  // Cerrar automáticamente después de 1500 milisegundos (1.5 segundos)
        //                         timerProgressBar: true, // Mostrar una barra de progreso durante el temporizador
        //                         text: data.mensaje // Muestra el mensaje de éxito recibido del servidor
        //                     });
        //                     // Esp
        //                     setTimeout(function () {
        //                         document.getElementById('form_editLan').reset();
        //                         window.location.reload();
        //                     }, 1000); // Espera 1 segundo
        //                 } else {
        //                     // En caso de que la respuesta no sea exitosa, muestra el mensaje de error recibido del servidor
        //                     Swal.fire({
        //                         icon: "error",
        //                         title: "Error",
        //                         text: data.mensaje
        //                     });
        //                 }
        //             })
        //             .catch(error => {
        //                 // Manejo de errores en caso de que falle la solicitud fetch
        //                 ventanaMostrarMensaje(
        //                     'error',
        //                     'Ups. Hubo un error al guardar la lading. Intente más tarde.'
        //                 );
        //                 console.error('Error al procesar la respuesta del servidor:', error);
        //             });

        //     }
        // } catch (error) {
        //     console.error('Error al mostrar mensaje de confirmación:', error);
        // }
    });
}

