<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editor Lading</title>
    <meta name="robots" content="noindex">

    <link rel="stylesheet" type="text/css" href="{{asset('normalize.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('styles.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('stylesEditorLading.css')}}">
    <link rel="stylesheet" href="{{asset('stylesLading.css')}}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

    <!-- CSS de Swiper -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

</head>

<body>
    <input type="hidden" value="{{ url('/') }}" id="url">

    <div class="contenedor__boton">
        <button class="btn" id="abrir_editor">
            <i class="fas fa-edit"></i>
        </button>
    </div>

    <div class="cointenerPrincipal">
        <div class="capa"></div>
        <!---Datos de portada--->
        <div id="contenedor-portada" class="contenedor__editor flex centrar">
            <form id="form_editLan" class="form_editLan editor__form swiper-container" enctype="multipart/form-data" method="POST">
                <meta name="csrf-token" content="{{ csrf_token() }}">
                <div class="botones__formularios flex">
                    <button id="guardar_portada" class="btn guardar">
                        <i class="fas fa-save"></i> Guardar
                    </button>
                    <button id="cerrar_editor" class="btn cerrar">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <div class="swiper-wrapper">
                    <!--Datos de Encabezado-->
                    <fieldset class="swiper-slide form__datos">
                        <legend class="datos__titulo">Datos Encabezado</legend>

                        <div class="datos__items margin-top">
                            <label for="titulo_evento" class="items__label">Titulo Evento: </label>
                            <input class="items__text" type="text" name="titulo_evento"
                                value="{{ $landingPageData['titulo_evento'] }}">
                        </div>

                        <div class="datos__items">
                            <label for="fecha_evento" class="items__label">Fecha Evento: </label>
                            <input class="items__text" type="date" name="fecha_evento"
                                value="{{$landingPageData['fecha_evento']}}">
                        </div>

                        <div class="datos__items">
                            <label for="hora_evento" class="items__label">Hora Evento: </label>
                            <input class="items__text" type="time" name="hora_evento"
                                value="{{$landingPageData['hora_evento']}}">
                        </div>

                        <div class="datos__items">
                            <label for="imagen_logo" class="items__label">Imagen Logo: (png, jpg, jpeg)</label>
                            @if(isset($landingPage) && !empty($landingPage->img_logo))

                            <img class="boton logo__img" src="{{ asset('storage').'/' . $landingPage->img_logo}}"
                                alt="imagen logo">
                            @else
                            <p>No se encontró ninguna imagen</p>
                            @endif
                            <input id="img1" class="items__file" type="file" name="imagen_logo">
                        </div>

                        <div class="datos__items">
                            <label for="url_whatsapp" class="items__label">URL WhatsApp: </label>
                            <input class="items__text" type="text" name="url_whatsapp" value="{{$landingPageData['url_whatsapp']}}">
                        </div>

                        <div class="datos__items">
                            <label for="url_facebook" class="items__label">URL Facebook: </label>
                            <input class="items__text" type="text" name="url_facebook" value="{{$landingPageData['url_facebook']}}">
                        </div>
                    </fieldset>

                    <fieldset class="swiper-slide form__datos">
                        <legend class="datos__titulo">Colores Encabezado</legend>

                        <div class="datos__items margin-top">
                            <label for="color_fondo" class="items__label">Color Fondo Encabezado: </label>
                            <input class="items__color" type="color" name="color_fondo" value="{{$landingPageData['color_fondo']}}">
                        </div>

                        <div class="datos__items">
                            <label for="color_titulo" class="items__label">Color Titulo: </label>
                            <input class="items__color" type="color" name="color_titulo" value="{{$landingPageData['color_titulo']}}">
                        </div>

                        <div class="datos__items">
                            <label for="color-iconos" class="items__label">Color Redes: </label>
                            <input class="items__color" type="color" name="color-iconos" value="{{$landingPageData['color-iconos']}}">
                        </div>

                    </fieldset>
                    <!--Fin de datos de encabezado-->

                    <!--Datos de portada-->
                    <fieldset class="swiper-slide form__datos">
                        <legend class="datos__titulo">Datos Portada</legend>

                        <div class="datos__items margin-top">
                            <label for="subtitulo" class="items__label">Subtitulo Evento: </label>
                            <input class="items__text" type="text" name="subtitulo" value="{{$landingPageData['subtitulo']}}">
                        </div>

                        <div class="datos__items">
                            <label for="texto_portada" class="items__label">Texto Portada: </label>
                            <input class="items__text" type="text" name="texto_portada" value="{{$landingPageData['texto_portada']}}">
                        </div>

                        <div class="datos__items">
                            <label for="texto_boton" class="items__label">Texto Boton Registro: </label>
                            <input class="items__text" type="text" name="texto_boton" value="{{$landingPageData['texto_boton']}}">
                        </div>

                        <div class="datos__items">

                            <label for="img_portada" class="items__label">Imagen Portada Fondo: (png, jpg, jpeg)</label>
                                @if(isset($landingPage) && !empty($landingPage->imgPortada_logo))
				
                                <img class="boton logo__img" src="{{ asset('storage').'/' . $landingPage->imgPortada_logo}}"
                                    alt="imagen logo">
                                @else
                                <p>No se encontró ninguna imagen</p>
                                @endif
                            <input id="img2" class="items__file" type="file" name="img_portada">
                        </div>

                        <div class="datos__items">
                            <label for="opacidad_img_portada" class="items__label"> Opacidad Portada Fondo: </label>
                            <div class="items__medidor flex centrar-y">
                                <p>0</p>
                                <p>5</p>
                                <p>10</p>
                            </div>
                            <input class="items__text" type="range" name="opacidad_img_portada" min="0" max="10"
                                value="{{$landingPageData['opacidad_img_portada']}}">
                        </div>
                    </fieldset>

                    <fieldset class="swiper-slide form__datos">
                        <legend class="datos__titulo">Colores Portada</legend>

                        <div class="datos__items margin-top">
                            <label for="color_subtitulo" class="items__label">Color Subtitulo: </label>
                            <input class="items__color" type="color" name="color_subtitulo" value="{{$landingPageData['color_subtitulo']}}">
                        </div>

                        <div class="datos__items">
                            <label for="color_cronometro" class="items__label">Color Cronometro: </label>
                            <input class="items__color" type="color" name="color_cronometro" value="{{$landingPageData['color_cronometro']}}">
                        </div>

                        <div class="datos__items">
                            <label for="color_fechas" class="items__label">Color Fechas: </label>
                            <input class="items__color" type="color" name="color-fechas" value="{{$landingPageData['color-fechas']}}">
                        </div>

                        <div class="datos__items">
                            <label for="color_parrafo" class="items__label">Color Parrafo: </label>
                            <input class="items__color" type="color" name="color_parrafo" value="{{$landingPageData['color_parrafo']}}">
                        </div>

                        <div class="datos__items">
                            <label for="color_boton" class="items__label">Color Fondo Boton: </label>
                            <input class="items__color" type="color" name="color_boton" value="{{$landingPageData['color_boton']}}">
                        </div>

                        <div class="datos__items">
                            <label for="color_texto_boton" class="items__label">Color Texto Boton: </label>
                            <input class="items__color" type="color" name="color_texto_boton" value="{{$landingPageData['color_texto_boton']}}">
                        </div>

                    </fieldset>
                    <!--Fin de datos de portada -->

                    <!-- Datos de Informacion -->
                    <fieldset class="swiper-slide form__datos">
                        <legend class="datos__titulo">Datos Encabezado</legend>

                        <div class="datos__items margin-top">
                            <label for="titulo_informacion" class="items__label">Titulo Informacion: </label>
                            <input class="items__text" type="text" name="titulo_informacion" value="{{$landingPageData['titulo_informacion']}}">
                        </div>

                        <div class="datos__items">
                            <label for="fecha_evento" class="items__label">Texto Informacion: </label>
                            <textarea class="items__text items_textarea" name="items_textarea">
                                {{$landingPageData['items_textarea']}}
                            </textarea>
                        </div>
                    </fieldset>

                    <fieldset class="swiper-slide form__datos">
                        <legend class="datos__titulo">Colores Encabezado</legend>

                        <div class="datos__items margin-top">
                            <label for="color_fondo_body" class="items__label">Color Fondo Pagina: </label>
                            <input class="items__color" type="color" name="color_fondo_body" value="{{$landingPageData['color_fondo_body']}}">
                        </div>

                        <div class="datos__items">
                            <label for="color_fondo_seccion" class="items__label">Color Fondo Seccion: </label>
                            <input class="items__color" type="color" name="color_fondo_secciono" value="{{$landingPageData['color_fondo_secciono']}}">
                        </div>

                        <div class="datos__items">
                            <label for="color_titulo_seccion" class="items__label">Color Titulo Seccion: </label>
                            <input class="items__color" type="color" name="color_titulo_seccion" value="{{$landingPageData['color_titulo_seccion']}}">
                        </div>

                        <div class="datos__items">
                            <label for="color_texto_seccion" class="items__label">Color Texto Seccion: </label>
                            <input class="items__color" type="color" name="color_texto_seccion" value="{{$landingPageData['color_texto_seccion']}}">
                        </div>

                    </fieldset>
                    <!-- Fin Datos de Informacion -->

                </div>
                <!-- Agrega los botones de navegación del swiper si es necesario -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script type="text/javascript">
        let swiper = new Swiper('.swiper-container', {
            slidesPerView: 'auto', // Mostrar solo un slide a la vez
            spaceBetween: 1000, // Espacio entre slides ajustado
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });
    </script>
    {{--  <script >
        if ($('form_editLan').length > 0) {
            const btn = document.querySelectorById('#guardar_portada');
            btn.addEventListener("click", function (event) {
                event.preventDefault();
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
    </script>  --}}
</body>

</html>