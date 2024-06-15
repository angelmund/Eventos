const rutaActual = window.location.href;

function cargarContenidoTextArea(contenido, content) {
      const parrafos = contenido.split('\n');

      // Limpiar el contenedor de párrafos
      const contenedor = document.getElementById(content);
      contenedor.innerHTML = '';

      // Agregar cada párrafo al contenedor de la sección
      parrafos.forEach(parrafo => {        
        if (parrafo.trim() !== '') {
          const p = document.createElement('p');          
          p.textContent = parrafo;
          p.classList.add('info-evento__texto');
          contenedor.appendChild(p);          
        } else {
          const br = document.createElement('br');
          contenedor.appendChild(br);   
        }

      });
}

function quitarEstiloCapaCarga() {
    // Obtenemos la capa de carga
    let capaCarga = document.querySelector('.container__capa');

    // Ocultamos la capa de carga
    capaCarga.style.display = 'none';
}

function cargarEstilosLading() {
    /*Aqui deberia devolver un json con los estilos de la lading*/
    fetch(rutaActual+'back/lading1.json')
    .then(response => response.json())
    .then(data => {
        //Asignar y cargar los componentes de la lading
        asignarEstilos(data.estilos);
        asignarImagenes(data);
        cargarContenido(data);
        
        setInterval(function(){
            actualizarTemporizador(
                data.informacion['fecha-evento'], 
                data.informacion['hora-evento']
                /**/
            );
        }, 1000);
        
        quitarEstiloCapaCarga();        
    })
    .catch(error => console.error('Error al leer el archivo JSON:', error));
}


function asignarEstilos(estilos) {
    // Asigno los estilos a las variables CSS

    document.documentElement.style.setProperty('--color-fondo-header', estilos.header['color-fondo']);
    /*document.documentElement.style.setProperty('--url-img-logo', estilo.estilos.header['url-img-logo']);*/
    document.documentElement.style.setProperty('--color-titulo-header', estilos.header['color-titulo']);    

    document.documentElement.style.setProperty('--color-iconos-header', estilos.header['color-iconos']);
    /*document.documentElement.style.setProperty('--url-img-portada', estilo.estilos.portada['url-img-portada']);*/
    document.documentElement.style.setProperty('--opacidad-img-portada', estilos.portada['opacidad-img-portada']);
    document.documentElement.style.setProperty('--color-titulo-portada', estilos.portada['color-titulo']);
    document.documentElement.style.setProperty('--color-subtitulo-cronometro-portada', estilos.portada['color-subtitulo-cronometro']);
    document.documentElement.style.setProperty('--color-subtitulo-fecha-portada', estilos.portada['color-subtitulo-fecha']);
    document.documentElement.style.setProperty('--color-letra-parrafo-portada', estilos.portada['color-letra-parrafo']);
    document.documentElement.style.setProperty('--color-fondo-boton-portada', estilos.portada['color-fondo-boton']);
    document.documentElement.style.setProperty('--color-letra-boton-portada', estilos.portada['color-letra-boton']);

    document.documentElement.style.setProperty('--color-fondo-pagina', estilos.pagina['color-fondo']);
    document.documentElement.style.setProperty('--color-fondo-seccion-info-evento', estilos.pagina['color-fondo-seccion-info-evento']);
    document.documentElement.style.setProperty('--color-titulo-seccion-info-evento', estilos.pagina['color-titulo-seccion-info-evento']);
    document.documentElement.style.setProperty('--color-letra-info-evento', estilos.pagina['color-letra-info-evento']);
}

function asignarImagenes(estilo) {    
    document.querySelector('.logo__img').src = rutaActual + estilo.estilos.header['url-img-logo'];    
    document.querySelector('.footer__img').src = rutaActual + estilo.estilos.header['url-img-logo'];            
    document.getElementById('img_registro').src = rutaActual + estilo.estilos.header['url-img-logo'];
    document.querySelector('.seccion__portada').style.backgroundImage = "url('"+ rutaActual + estilo.estilos.portada['url-img-portada'] +"')";
}

function cargarContenido(estilo) {
    document.querySelector('.titulo__texto').textContent = estilo.informacion['titulo-evento'];
    document.querySelector('.footer__titulo').textContent = estilo.informacion['titulo-evento'];    
    document.querySelector('.portada__titulo').textContent = estilo.informacion['subtitulo'];
    //document.querySelector('.info__parrafo').textContent = estilo.informacion['texto-portada'];    
    document.querySelector('.info__parrafo').textContent = estilo.informacion['texto-portada'];    
    document.getElementById('btn_abrirFormulario').textContent = estilo.informacion['texto-boton'];  
    document.querySelector('.info-evento__titulo').textContent = estilo.informacion['subtitulo-informacion'];      
    cargarContenidoTextArea(estilo.informacion['descripcion-evento'], 'info_eventos');

    document.getElementById('whatsApp').href = estilo.informacion['link-whatsapp'];
    document.getElementById('facebook').href = estilo.informacion['link-facebook'];
        
}

function actualizarTemporizador(fechaEvento, horaEvento) {
      var fechaActual = new Date();      
      var fechaInicioEvento = new Date(fechaEvento + "T" + horaEvento + ":00");

      var diferencia = fechaInicioEvento - fechaActual; // Calcula la diferencia en milisegundos

      if (diferencia > 0) { // Asegúrate de que la diferencia sea positiva
        var dias = Math.floor(diferencia / (1000 * 60 * 60 * 24));
        var horas = Math.floor((diferencia % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutos = Math.floor((diferencia % (1000 * 60 * 60)) / (1000 * 60));
        var segundos = Math.floor((diferencia % (1000 * 60)) / 1000);

        if (dias < 10) { dias = "0" + dias; }
        if (horas < 10) { horas = "0" + horas; }
        if (minutos < 10) { minutos = "0" + minutos; }
        if (segundos < 10) { segundos = "0" + segundos; }

        var cronometroHTML = dias + ":" + horas + ":" + minutos + ":" + segundos;
        document.getElementById("cronometro").innerHTML = cronometroHTML;
      } else {
        document.getElementById("cronometro").innerHTML = "El evento ha comenzado";
      }
}

cargarEstilosLading();