import { ventanaFormulario, ventanaMostrarMensaje, verificarArchivosDeImagen } from "./funcionesVentana";
import { eliminar } from "./alertas";

if ($('.seccion-evento').length > 0) {
    //Obtener la ruta actual 
    const url = $('#url').val();


    async function cargarEventos() {
        try {
            // Obtener los eventos desde el servidor
            const response = await fetch(url + '/dashboard/json/');
            const eventos = await response.json();

            // Iterar sobre cada evento y generar el HTML correspondiente
            eventos.forEach(evento => {
                // Crear el contenedor del evento
                const cardEvento = document.createElement('div');
                cardEvento.classList.add('card-evento');

                // Crear la sección de texto del evento
                const eventoTexto = document.createElement('div');
                eventoTexto.classList.add('evento__texto');

                // Asignar el ID del evento como un atributo de datos al contenedor del evento
                cardEvento.dataset.eventoId = evento.id;
                //console.log(cardEvento);

                // Crear la imagen de portada del evento
                const imagenPortada = document.createElement('img');
                imagenPortada.classList.add('imagen-evento');
                imagenPortada.src = evento.url_imagen_portada;

                // Crear el elemento de título del evento
                const tituloElemento = document.createElement('h3');
                tituloElemento.classList.add('evento__titulo');
                tituloElemento.textContent = evento.titulo_evento;

                // Agregar la imagen y el título al contenedor de texto
                eventoTexto.appendChild(imagenPortada);
                eventoTexto.appendChild(tituloElemento);

                // Agregar la sección de texto al contenedor del evento
                cardEvento.appendChild(eventoTexto);

                // Agregar el título al contenedor de texto
                eventoTexto.appendChild(tituloElemento);

                // Agregar la sección de texto al contenedor del evento
                cardEvento.appendChild(eventoTexto);

                // Crear la sección de acciones del evento
                const eventoAcciones = document.createElement('div');
                eventoAcciones.classList.add('evento__acciones');

                // Crear los enlaces de acciones y sus íconos
                const enlaceReporte = document.createElement('a');
                enlaceReporte.classList.add('btn', 'acciones__btns');
                const iconoReporte = document.createElement('i');
                iconoReporte.classList.add('icon-reporte', 'fas', 'fa-chart-line');
                enlaceReporte.appendChild(iconoReporte);

                const enlaceEditar = document.createElement('a');
                enlaceEditar.classList.add('btn', 'acciones__btns');
                const iconoEditar = document.createElement('i');
                iconoEditar.classList.add('icon-editar', 'fas', 'fa-pencil-alt');
                enlaceEditar.appendChild(iconoEditar);

                const enlaceMostrar = document.createElement('a');
                enlaceMostrar.classList.add('btn', 'acciones__btns');
                const iconoMostrar = document.createElement('i');
                iconoMostrar.classList.add('icon-mostrar', 'fas', 'fa-eye');
                enlaceMostrar.appendChild(iconoMostrar);

                const enlaceEliminar = document.createElement('a');
                enlaceEliminar.classList.add('btn', 'acciones__btns');
                const iconoEliminar = document.createElement('i');
                iconoEliminar.classList.add('icon-eliminar', 'fas', 'fa-trash-alt');
                enlaceEliminar.appendChild(iconoEliminar);

                // Agregar el event listener al botón de eliminar
                enlaceEliminar.addEventListener("click", (e) => {
                    e.preventDefault();
                    eliminarEvento(evento.id); // Pasar el ID del evento como parámetro
                });

                // Agregar los enlaces de acciones al contenedor de acciones
                eventoAcciones.appendChild(enlaceReporte);
                eventoAcciones.appendChild(enlaceEditar);
                eventoAcciones.appendChild(enlaceMostrar);
                eventoAcciones.appendChild(enlaceEliminar);

                // Agregar la sección de acciones al contenedor del evento
                cardEvento.appendChild(eventoAcciones);

                // Agregar el nuevo evento al contenedor principal en tu vista
                const contenedorEventos = document.getElementById('contenedor-eventos');
                contenedorEventos.appendChild(cardEvento);
            });
        } catch (error) {
            console.error('Error al cargar los eventos:', error);
        }
    }

    // Escuchar eventos de clic en cualquier botón de "Editar" dentro de los eventos
    document.addEventListener('click', function (event) {
        // Verificar si el clic ocurrió en un botón de "Editar"
        if (event.target.classList.contains('icon-editar')) {
            // Obtener el contenedor del evento padre del botón
            const contenedorEvento = event.target.closest('.card-evento');
            if (contenedorEvento) {
                // Obtener el ID del evento desde el atributo de datos
                const eventoId = contenedorEvento.dataset.eventoId;
                // console.log(eventoId);
                //  redirigir a la página de edición pasando el ID como parámetro en la URL
                window.location.href = url + '/editar/evento/' + eventoId;
            }
        }
    });


    // Llamar a la función para cargar los eventos cuando la página se cargue
    window.addEventListener('DOMContentLoaded', cargarEventos);



    function eliminarEvento(id) {
        // Obtener la ruta actual
        const url = $('#url').val();
        const ur = url + '/eliminar/landing/' + id; // Construir la URL con el ID del evento

        // ventanaMostrarMensaje("¿Seguro que quiere eliminar la inscripción?", function () {
        //     console.log(id);
        //     enviarSolicitudDelete(url); // Llamar a la función que envía la solicitud DELETE
        // });
        eliminar("¿Seguro que quiere eliminar el evento?", function () {
            //console.log(id);
            enviarSolicitudDelete(ur); // Llamar a la función que envía la solicitud DELETE
        });
    }

    async function enviarSolicitudDelete(ur) {
        try {
            const response = await fetch(ur, {
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
            });

            const data = await response.json();

            if (data.idnotificacion == 1) {
                Swal.fire({
                    title: "Evento eliminado correctamente.",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 1500,
                    timerProgressBar: true
                });
                setTimeout(function () {
                    window.location.reload();
                }, 1500);
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "Ocurrió un error al eliminar"
                });
            }
        } catch (error) {
            console.error('Error en try-catch:', error);
        }
    }

}

if ($('#fechaEvento').length > 0) {
    // Función para actualizar el contador del cronómetro
    function actualizarCronometro() {
        // Obtener la fecha y hora actual
        var fechaActual = new Date();

        // Obtener la fecha y hora del evento desde el elemento oculto
        var fechaEvento = new Date(document.getElementById('fechaEvento').textContent);

        // Calcular la diferencia en milisegundos
        var diferencia = fechaEvento - fechaActual;

        // Calcular días, horas, minutos y segundos
        var dias = Math.floor(diferencia / (1000 * 60 * 60 * 24));
        var horas = Math.floor((diferencia % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutos = Math.floor((diferencia % (1000 * 60 * 60)) / (1000 * 60));
        var segundos = Math.floor((diferencia % (1000 * 60)) / 1000);
        if (dias > 10) {

        }
        // Formatear la cadena en el formato deseado
        var cronometro = dias + ":" + horas + ":" + minutos + ":" + segundos;

        // Mostrar la cadena en el elemento HTML
        document.getElementById('cronometro').textContent = cronometro;
    }

    // Llamar a la función actualizarCronometro cada segundo
    setInterval(actualizarCronometro, 1000);
}

