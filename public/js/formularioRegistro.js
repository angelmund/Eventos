

/*Los addEvenListeners va aqui (Los Eschucas)*/

/*Al preisonal el boton de registro abre el formulario*/
/* Al presionar el botón de registro, abre el formulario */
document.getElementById('btn_abrirFormulario').addEventListener('click', function() {
    var formulario = document.querySelector('.formulario');
    formulario.classList.add('mostrar'); // Agrega la clase 'mostrar' para mostrar el formulario
});

document.getElementById('btn_cerrarFormulario').addEventListener('click', function(event) {
    event.preventDefault(); // Evita que el formulario se envíe (si estás dentro de un formulario)
    var formulario = document.querySelector('.formulario');
    formulario.classList.remove('mostrar'); // Quita la clase 'mostrar' para ocultar el formulario
});

// Agrega un evento de envío al formulario 
document.getElementById('form_registro').addEventListener('submit', function(event) {
    // Detén el comportamiento predeterminado de envío del formulario
    event.preventDefault();

    // Recolecta los datos del formulario
    const formData = new FormData(this);
    //Obtenemos los datos
    const valores = obtenerValoresFormulario(formData);

    //Si algun valor esta vacio
    if(!verificarVacios(...valores)) {
        ventanaMostrarMensaje(
            'error',
            "Por favor, completa todos los campos del formulario."
        );
        return;        
    } else
        console.log('log');


    // Envía los datos al backend
    fetch(rutaActual + 'back/registroInvitado.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Error al enviar los datos al servidor.');
        }            
        return response.json();
    })
    .then(data => {        
        if(data) {         
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
