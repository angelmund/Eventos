
if ($('.seccion-evento').length > 0) {
    // Escuchar eventos de clic en cualquier botón de "Editar" dentro de los eventos
document.addEventListener('click', function(event) {
    // Verificar si el clic ocurrió en un botón de "Editar"
    if (event.target.classList.contains('btn-editar')) {
        // Obtener el contenedor del evento padre del botón
        const contenedorEvento = event.target.closest('.card-evento');
        if (contenedorEvento) {
            // Obtener el ID del evento desde el atributo de datos
            const eventoId = contenedorEvento.dataset.eventoId;
            // Ahora puedes usar el ID del evento (eventoId) para realizar la acción de edición
            // Por ejemplo, podrías redirigir a la página de edición pasando el ID como parámetro en la URL
            window.location.href = '/editar-evento/' + eventoId;
        }
    }
});

}