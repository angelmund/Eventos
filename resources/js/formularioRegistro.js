import { verificarVacios, ventanaMostrarMensaje, obtenerValoresFormulario, ventanaFormulario } from "./funcionesVentana";

/*Los addEvenListeners va aqui (Los Eschucas)*/

/*Al preisonal el boton de registro abre el formulario*/
/* Al presionar el botón de registro, abre el formulario */
document.getElementById('btn_abrirFormulario').addEventListener('click', function () {
    var formulario = document.querySelector('.formulario');
    formulario.classList.add('mostrar'); // Agrega la clase 'mostrar' para mostrar el formulario
});

document.getElementById('btn_cerrarFormulario').addEventListener('click', function (event) {
    event.preventDefault(); // Evita que el formulario se envíe (si estás dentro de un formulario)
    var formulario = document.querySelector('.formulario');
    formulario.classList.remove('mostrar'); // Quita la clase 'mostrar' para ocultar el formulario
});

// Agrega un evento de envío al formulario 
document.getElementById('form_registro').addEventListener('submit', function (event) {
    // Detén el comportamiento predeterminado de envío del formulario
    event.preventDefault();

    // Recolecta los datos del formulario
    const formData = new FormData(this);
    //Obtenemos los datos
    const valores = obtenerValoresFormulario(formData);

    //Si algun valor esta vacio
    if (!verificarVacios(...valores)) {
        ventanaMostrarMensaje(
            'error',
            "Por favor, completa todos los campos del formulario."
        );
        return;
    } else
        console.log('');

    const url = $('#url').val();
    // Envía los datos al backend
    fetch(url + '/evento/inscripcion', {
        method: 'POST',
        mode: 'cors',
        redirect: 'manual',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        body: formData
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error al enviar los datos al servidor.');
            }
            return response.json();
        })
        .then(data => {
            if (data) {
                this.reset();
                //Cierra el formulario (lo oculta)
                ventanaFormulario('formulario');

                ventanaMostrarMensaje(
                    'exito',
                    "¡Registro exitoso! Por favor, verifica tu correo electrónico para continuar.");
            } else {
                ventanaMostrarMensaje(
                    'error',
                    "Ups... Hubo un error al enviar tus datos."
                );
            }
        })
        .catch(error => {
            console.error('Error:', error);
            //Esto lo puedes cambiar Chango
            ventanaMostrarMensaje(
                'error',
                "Ups... Hubo un erro al enviar tus datos."
            );
        });
});


const btn = document.querySelector('#guardar_portada');
const formulario = document.querySelector('#form_editLan');
const url = $('#url').val();
const landingPageId = $('#landingPageId').val();

btn.addEventListener("click", function (event) {
    event.preventDefault();


    // Recolecta los datos del formulario
    const formData = new FormData(formulario);
    //Obtenemos los datos
    const valores = obtenerValoresFormulario(formData);

    //Si algun valor esta vacio
    if (!verificarVacios(...valores)) {
        ventanaMostrarMensaje(
            'error',
            "Por favor, completa todos los campos del formulario."
        );
        return;
    } else {
        console.log('');

        // Envía los datos al backend
        fetch(url + '/actualizar/landing/' + landingPageId, {
            method: 'POST',
            mode: 'cors',
            redirect: 'manual',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            body: formData
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error al enviar los datos al servidor.');
                }
                return response.json();
            })
            .then(data => {
                if (data) {

                    //Cierra el formulario (lo oculta)
                    ventanaFormulario('formulario');

                    ventanaMostrarMensaje(
                        'exito',
                        "Evento actualizado con éxito"
                    );
                    // Retrasar la recarga de la página durante 2 segundos
                    setTimeout(() => {
                        window.location.reload(); // Recargar la página después de 2 segundos
                    }, 2000);
                } else {
                    ventanaMostrarMensaje(
                        'error',
                        "Ups... Hubo un error al enviar los datos."
                    );
                }
            })
            .catch(error => {
                console.error('Error:', error);
                //Esto lo puedes cambiar Chango
                ventanaMostrarMensaje(
                    'error',
                    "Ups... Hubo un error al enviar los datos."
                );
            });
    }
});
