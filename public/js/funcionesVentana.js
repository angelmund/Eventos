/*No ayudara abrir los formularios*/
function ventanaFormulario(nombreFormulario) {
    //Obtenemos el formulario
    let form = document.querySelector('.' + nombreFormulario);

    // Verificar si está abierto o cerrado con su display 
    if (window.getComputedStyle(form).display === 'none')
        form.style.display = 'flex';
    else
        form.style.display = 'none';
}

function ventanaFormularioID(nombreFormulario) {
    //Obtenemos el formulario
    let form = document.getElementById(nombreFormulario);

    // Verificar si está abierto o cerrado con su display 
    if (window.getComputedStyle(form).display === 'none')
        form.style.display = 'flex';
    else
        form.style.display = 'none';
}

function ventanaMostrarMensaje(tipo, mensaje) {
    if (tipo === 'error') {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: mensaje
        });
    } else if (tipo === 'exito') {
        Swal.fire({
            icon: 'success',
            title: 'Éxito',
            text: mensaje
        });
    } else if (tipo === 'confirmacion') {
        return Swal.fire({
            icon: 'question',
            title: 'Confirmación',
            text: mensaje,
            showCancelButton: true,
            confirmButtonText: 'Sí',
            cancelButtonText: 'Cancelar'
        });
    } else {
        console.error('Tipo de mensaje no válido');
    }
}

//Obtener valores de formularios 
function obtenerValoresFormulario(form) {
    // Obtener los valores de los campos del FormData
    const valores = [];

    for (const [clave, valor] of form.entries()) {
        valores.push(valor);
    }

    return valores;
}

function estanVaciosInputs(clase) {
    // Seleccionar todos los elementos con la clase especificada
    const inputs = document.querySelectorAll('.' + clase);

    // Iterar sobre cada elemento y verificar si está vacío
    inputs.forEach(input => {
        // Obtener el valor del campo de entrada actual y eliminar espacios en blanco
        const valor = input.value.trim();

        // Verificar si el campo está vacío
        if (valor === '') {
            // Si está vacío, mostrar un mensaje de error o realizar alguna otra acción
            input.style.border = '1px solid red';
            // Aquí puedes agregar código para mostrar un mensaje de error o realizar alguna otra acción
        }
    });
}


//obtener si las imagen es valida
function verificarArchivosDeImagen(clase) {
    // Obtener todos los elementos con la clase especificada
    const inputsArchivo = document.querySelectorAll('.' + clase);

    // Iterar sobre cada elemento y verificar si contiene un archivo
    inputsArchivo.forEach(input => {
        const archivo = input.files[0]; // Obtener el archivo seleccionado

        // Verificar si se seleccionó un archivo
        if (archivo) {
            // Obtener la extensión del archivo
            const extension = archivo.name.split('.').pop().toLowerCase();

            // Lista de extensiones de archivo de imagen comunes
            const extensionesImagen = ['jpg', 'jpeg', 'png', 'gif', 'bmp'];

            // Verificar si la extensión está en la lista de extensiones de imagen
            if (!extensionesImagen.includes(extension)) {
                // Si el archivo no es una imagen válida, establece el borde rojo
                input.style.border = '1px solid red';
            } else {
                // Si es una imagen válida, asegúrate de quitar cualquier borde rojo
                input.style.border = '1px solid transparent';
            }
        }
    });
}

/*Funciones para validar si los argumentos enviados estan vacios*/
function verificarVacios() {
    // Verificar si hay al menos un argumento    
    if (arguments.length === 0) {        
        return false;
    }

    // Iterar sobre los argumentos
    for (let i = 0; i < arguments.length; i++) {
        // Verificar si el argumento actual está vacío
        if (arguments[i] === '')                    
            return false;        
    }    
    //Todo bien 

    return true;
}


/*Obtiene lo esriot de un text area exactamente como se escribio*/
function extraerTextoExactamente(contenido) {
    // Dividir el contenido del textarea en párrafos
    const parrafos = contenido.split('\n');

    // Limpiar el contenedor de párrafos
    const seccionInfoEvento = document.getElementById('info_eventos');
    seccionInfoEvento.innerHTML = '';

    // Agregar cada párrafo al contenedor de la sección
    parrafos.forEach(parrafo => {    
        if (parrafo.trim() !== '') {
            const p = document.createElement('p');          
            p.textContent = parrafo;
            p.classList.add('info-evento__texto');
            seccionInfoEvento.appendChild(p);          
        } else {
            const br = document.createElement('br');
            seccionInfoEvento.appendChild(br);   
        }
    });
}
