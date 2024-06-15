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
    @vite(['resources/js/app.js'])
</head>

<body>
    <input type="hidden" value="{{ url('/') }}" id="url">

    

    <div class="cointenerPrincipal">
        <div class="capa"></div>
        <!---Datos de portada--->
        <div id="contenedor-portada" class="contenedor__editor flex centrar">
            <form id="form_editor" class="editor__form swiper-container" enctype="multipart/form-data">
                <meta name="csrf-token" content="{{ csrf_token() }}">
                @csrf
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
                            <input class="items__text" type="text" name="titulo_evento">
                        </div>

                        <div class="datos__items">
                            <label for="fecha_evento" class="items__label">Fecha Evento: </label>
                            <input class="items__text" type="date" name="fecha_evento">
                        </div>

                        <div class="datos__items">
                            <label for="hora_evento" class="items__label">Hora Evento: </label>
                            <input class="items__text" type="time" name="hora_evento">
                        </div>

                        <div class="datos__items">
                            <label for="imagen_logo" class="items__label">Imagen Logo: (png, jpg, jpeg)</label>
                            <input id="img1" class="items__file" type="file" name="imagen_logo">
                        </div>

                        <div class="datos__items">
                            <label for="url_whatsapp" class="items__label">URL WhatsApp: </label>
                            <input class="items__text" type="text" name="url_whatsapp">
                        </div>

                        <div class="datos__items">
                            <label for="url_facebook" class="items__label">URL Facebook: </label>
                            <input class="items__text" type="text" name="url_facebook">
                        </div>
                    </fieldset>

                    <fieldset class="swiper-slide form__datos">
                        <legend class="datos__titulo">Colores Encabezado</legend>

                        <div class="datos__items margin-top">
                            <label for="color_fondo" class="items__label">Color Fondo Encabezado: </label>
                            <input class="items__color" type="color" name="color_fondo" value="#f5f5f5">
                        </div>

                        <div class="datos__items">
                            <label for="color_titulo" class="items__label">Color Titulo: </label>
                            <input class="items__color" type="color" name="color_titulo" value="#000000">
                        </div>

                        <div class="datos__items">
                            <label for="color-iconos" class="items__label">Color Redes: </label>
                            <input class="items__color" type="color" name="color-iconos" value="#000000">
                        </div>

                    </fieldset>
                    <!--Fin de datos de encabezado-->

                    <!--Datos de portada-->
                    <fieldset class="swiper-slide form__datos">
                        <legend class="datos__titulo">Datos Portada</legend>

                        <div class="datos__items margin-top">
                            <label for="subtitulo" class="items__label">Subtitulo Evento: </label>
                            <input class="items__text" type="text" name="subtitulo">
                        </div>

                        <div class="datos__items">
                            <label for="texto_portada" class="items__label">Texto Portada: </label>
                            <input class="items__text" type="text" name="texto_portada">
                        </div>

                        <div class="datos__items">
                            <label for="texto_boton" class="items__label">Texto Boton Registro: </label>
                            <input class="items__text" type="text" name="texto_boton" value="Registrate">
                        </div>

                        <div class="datos__items">
                            <label for="img_portada" class="items__label">Imagen Portada Fondo: (png, jpg, jpeg)</label>
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
                                value="5">
                        </div>
                    </fieldset>

                    <fieldset class="swiper-slide form__datos">
                        <legend class="datos__titulo">Colores Portada</legend>

                        <div class="datos__items margin-top">
                            <label for="color_subtitulo" class="items__label">Color Subtitulo: </label>
                            <input class="items__color" type="color" name="color_subtitulo" value="#f5f5f5">
                        </div>

                        <div class="datos__items">
                            <label for="color_cronometro" class="items__label">Color Cronometro: </label>
                            <input class="items__color" type="color" name="color_cronometro" value="#ffffff">
                        </div>

                        <div class="datos__items">
                            <label for="color_fechas" class="items__label">Color Fechas: </label>
                            <input class="items__color" type="color" name="color-fechas" value="#cccccc">
                        </div>

                        <div class="datos__items">
                            <label for="color_parrafo" class="items__label">Color Parrafo: </label>
                            <input class="items__color" type="color" name="color_parrafo" value="#bbbbbb">
                        </div>

                        <div class="datos__items">
                            <label for="color_boton" class="items__label">Color Fondo Boton: </label>
                            <input class="items__color" type="color" name="color_boton" value="#ffffff">
                        </div>

                        <div class="datos__items">
                            <label for="color_texto_boton" class="items__label">Color Texto Boton: </label>
                            <input class="items__color" type="color" name="color_texto_boton" value="#000000">
                        </div>

                    </fieldset>
                    <!--Fin de datos de portada -->

                    <!-- Datos de Informacion -->
                    <fieldset class="swiper-slide form__datos">
                        <legend class="datos__titulo">Datos Encabezado</legend>

                        <div class="datos__items margin-top">
                            <label for="titulo_informacion" class="items__label">Titulo Informacion: </label>
                            <input class="items__text" type="text" name="titulo_informacion">
                        </div>

                        <div class="datos__items">
                            <label for="fecha_evento" class="items__label">Texto Informacion: </label>
                            <textarea class="items__text items_textarea" name="items_textarea">

                            </textarea>
                        </div>
                    </fieldset>

                    <fieldset class="swiper-slide form__datos">
                        <legend class="datos__titulo">Colores Encabezado</legend>

                        <div class="datos__items margin-top">
                            <label for="color_fondo_body" class="items__label">Color Fondo Pagina: </label>
                            <input class="items__color" type="color" name="color_fondo_body" value="#ffffff">
                        </div>

                        <div class="datos__items">
                            <label for="color_fondo_seccion" class="items__label">Color Fondo Seccion: </label>
                            <input class="items__color" type="color" name="color_fondo_secciono" value="#f5f5f5">
                        </div>

                        <div class="datos__items">
                            <label for="color_titulo_seccion" class="items__label">Color Titulo Seccion: </label>
                            <input class="items__color" type="color" name="color_titulo_seccion" value="#000000">
                        </div>

                        <div class="datos__items">
                            <label for="color_texto_seccion" class="items__label">Color Texto Seccion: </label>
                            <input class="items__color" type="color" name="color_texto_seccion" value="#111111">
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
    {{--  <script type="text/javascript">
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
    </script>  --}}

    {{-- <script type="text/javascript" src="js/funcionesVentana.js"></script>
    <script type="text/javascript" src="js/scriptEditorLading.js"></script> --}}
</body>

</html>