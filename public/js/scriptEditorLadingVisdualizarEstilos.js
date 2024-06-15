// Obtener todos los elementos con la clase 'items__text'
const inputsText = document.querySelectorAll('.items__text');

//Arreglo con los nombres de donde se editaran el texto
const etiquetas = [
    { id: 0, nombreEtiqueta: '.titulo__texto' }, 
    { id: 3, nombreEtiqueta: '.whatsapp' },
    { id: 4, nombreEtiqueta: '.facebook' },
    { id: 5, nombreEtiqueta: '.portada__titulo' },
    { id: 6, nombreEtiqueta: '.info__parrafo' },
    { id: 7, nombreEtiqueta: '.info__btn' }, 
    { id: 9, nombreEtiqueta: '.info-evento__titulo' },
    { id: 10, nombreEtiqueta: '.info-evento__texto' }
    //{ id: 3, nombreEtiqueta: 'etiqueta3' }
];

// Agregar un event listener para el evento 'input' a cada elemento
inputsText.forEach((input, index) => {
    input.addEventListener('input', function(event) {
        // Obtener el índice del elemento actual
        const currentIndex = [...inputsText].findIndex(el => el === event.target);
               
        //busque el id y asigne el texto        	
        const etiquetaCorrespondiente = etiquetas.find(etiqueta => etiqueta.id === currentIndex);           
        event.target.style.border = '1px solid black';

        if (etiquetaCorrespondiente) {
            // Si hay una etiqueta correspondiente, obtener su nombre y asignar el texto del input a esa etiqueta
            const nombreEtiqueta = etiquetaCorrespondiente.nombreEtiqueta;
            const elementoEtiqueta = document.querySelector(nombreEtiqueta);

            if (elementoEtiqueta) {

            	if(index != 1 && index != 2 && index != 3 && index != 4 && index != 10) {
            		console.log('text');
            		elementoEtiqueta.textContent = event.target.value;
            	} else if(index == 3 || index == 4) {            		
            		console.log('link');
            		elementoEtiqueta.href = event.target.value;
            	} else if (index == 10) {
            	    extraerTextoExactamente(event.target.value);            
            	} else {
            		console.log('nada');
            	}                   
            }
        }               
    });
});


// Obtener todos los elementos con la clase 'items__text'
const inputsColor = document.querySelectorAll('.items__color');

//Arreglo con los nombres de donde se editaran el texto
const etiquetasColor = [
    { id: 0, nombreVariable: '--color-fondo-header' }, 
    { id: 1, nombreVariable: '--color-titulo-header' },
    { id: 2, nombreVariable: '--color-iconos-header' },
    { id: 3, nombreVariable: '--color-titulo-portada' },
    { id: 4, nombreVariable: '--color-subtitulo-cronometro-portada' },
    { id: 5, nombreVariable: '--color-subtitulo-fecha-portada' }, 
    { id: 6, nombreVariable: '--color-letra-parrafo-portada' },
    { id: 7, nombreVariable: '--color-fondo-boton-portada' },
    { id: 8, nombreVariable: '--color-letra-boton-portada' },
    { id: 9, nombreVariable: '--color-fondo-pagina' },
    { id: 10, nombreVariable: '--color-fondo-seccion-info-evento' },
    { id: 11, nombreVariable: '--color-titulo-seccion-info-evento' },
    { id: 12, nombreVariable: '--color-letra-info-evento' },    
];

/* Para cambiar el color de los items*/
// Agregar un event listener para el evento 'input' a cada elemento de entrada de texto
inputsColor.forEach((input, index) => {
    input.addEventListener('input', function(event) {
        // Obtener el índice del elemento actual
        const currentIndex = [...inputsColor].findIndex(el => el === event.target);
               
        // Buscar el ID correspondiente en el arreglo etiquetasColor
        const etiquetaCorrespondiente = etiquetasColor.find(etiqueta => etiqueta.id === currentIndex);           

        if (etiquetaCorrespondiente) {
            // Si se encuentra la etiqueta correspondiente, obtener su nombre de variable CSS
            const nombreVariableCSS = etiquetaCorrespondiente.nombreVariable;

            // Obtener el valor del campo de entrada
            const nuevoColor = event.target.value;

            // Aplicar el nuevo color a la variable CSS
            document.documentElement.style.setProperty(nombreVariableCSS, nuevoColor);
        }               
    });
});

document.getElementById('img1').addEventListener('change', function(event) {
    var input = event.target;

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            document.querySelector('.logo__img').src = e.target.result;
            document.querySelector('.footer__img').src = e.target.result;
            document.querySelector('.invitado__img').src = e.target.result;            
        }

        reader.readAsDataURL(input.files[0]);
    }
});

document.getElementById('img2').addEventListener('change', function(event) {
    var input = event.target;
    
    if (input.files && input.files[0]) {
        var reader = new FileReader();
                
        reader.onload = function(e) {
            document.querySelector('.seccion__portada').style.backgroundImage = 'url(' + e.target.result + ')';
        }

        reader.readAsDataURL(input.files[0]);
    }
});

