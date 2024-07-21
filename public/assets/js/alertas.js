// Mensaje de Confirmación para eliminar un registro
function eliminar(titulo,callback){
    Swal.fire({
        title: `${titulo}`,
        text: "Si elimina, no se volverá a recuperar",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Eliminar"
      }).then((result) => {
        if (result.isConfirmed) {
            if (callback && typeof callback === 'function') {
                callback();
            }
        }
      });
}