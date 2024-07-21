import { verificarVacios, ventanaMostrarMensaje, obtenerValoresFormulario, ventanaFormulario } from "./funcionesVentana";

document.addEventListener('DOMContentLoaded', () => {
    // Event listeners
    document.getElementById('abrir_editor').addEventListener('click', function () {
        var formulario = document.querySelector('.contenedor__editor');
        formulario.classList.add('mostrar'); // Agrega la clase 'mostrar' para mostrar el formulario
    });

    document.getElementById('cerrar_editor').addEventListener('click', function (event) {
        event.preventDefault();
        var formulario = document.querySelector('.contenedor__editor');
        formulario.classList.remove('mostrar'); // Quita la clase 'mostrar' para ocultar el formulario
    });

    document.getElementById('formulario').addEventListener('submit', function (event) {
        event.preventDefault();

        const formData = new FormData(this);
        const valores = obtenerValoresFormulario(formData);

        if (!verificarVacios(...valores)) {
            ventanaMostrarMensaje('error', "Por favor, completa todos los campos del formulario.");
            return;
        }

        const url = document.getElementById('url').value;

        fetch(url + '/evento/inscripcion', {
            method: 'POST',
            mode: 'cors',
            redirect: 'manual',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
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
                ventanaFormulario('formulario');
                ventanaMostrarMensaje('exito', "¡Registro exitoso! Por favor, verifica tu correo electrónico para continuar.");
            } else {
                ventanaMostrarMensaje('error', "Ups... Hubo un error al enviar tus datos.");
            }
        })
        .catch(error => {
            console.error('Error:', error);
            ventanaMostrarMensaje('error', "Ups... Hubo un error al enviar tus datos.");
        });
    });

    const btn = document.querySelector('#guardar_portada');
    const formulario = document.querySelector('#formulario');
    const url = document.getElementById('url').value;
    const landingPageId = document.getElementById('landingPageId').value;

    btn.addEventListener("click", function (event) {
        event.preventDefault();

        const formData = new FormData(formulario);
        const valores = obtenerValoresFormulario(formData);

        if (!verificarVacios(...valores)) {
            ventanaMostrarMensaje('error', "Por favor, completa todos los campos del formulario.");
            return;
        }

        fetch(url + '/actualizar/landing/' + landingPageId, {
            method: 'POST',
            mode: 'cors',
            redirect: 'manual',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
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
                ventanaFormulario('formulario');
                ventanaMostrarMensaje('exito', "Evento actualizado con éxito");

                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            } else {
                ventanaMostrarMensaje('error', "Ups... Hubo un error al enviar los datos.");
            }
        })
        .catch(error => {
            console.error('Error:', error);
            ventanaMostrarMensaje('error', "Ups... Hubo un error al enviar los datos.");
        });
    });

    // Inicializar Swiper
    let swiper = new Swiper('.swiper-container', {
        slidesPerView: 'auto',
        spaceBetween: 1000,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });
});