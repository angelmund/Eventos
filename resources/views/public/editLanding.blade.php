<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="robots" content="noindex">

	<title>Lading</title>
	<!-- Estilos generales -->
	<link rel="stylesheet" type="text/css" href="{{asset('normalize.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('styles.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('stylesEditorLading.css')}}">
	<script src="https://code.jquery.com/jquery-3.7.0.js"></script>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

	<!-- CSS de Swiper -->
	<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
	{{--
	<link rel="stylesheet" href="{{asset('js/cargarEstilosLading.js')}}">
	<link rel="stylesheet" href="{{asset('js/formularioRegistro.js')}}">
	<link rel="stylesheet" href="{{asset('js/funcionesVentana.js')}}">
	<link rel="stylesheet" href="{{asset('js/scriptEditorLading.js')}}">
	<link rel="stylesheet" href="{{asset('js/scriptEditorLadingVisdualizarEstilos.js')}}"> --}}
	<style>
		.titulo__texto {
			color: {{ $landingPageData['color_titulo'] }};
		}
		.header__titulo {
			color: {{ $landingPageData['color_fondo'] }};
		}
		header, .footer__contenedor{
			background: {{ $landingPageData['color_fondo'] }} !important;
		}
		
		body{
			background: {{ $landingPageData['color_fondo_body'] }} !important;
		}
		.portada__contenedor {
		
			background-image: url('http://127.0.0.1:8000/storage/eventos/img/5_portada.png') !important; /* Imagen de fondo */
			background-size: cover !important;
			background-position: center !important;
			background-repeat: no-repeat !important;
		  }
		.informacion__cronometro{
			color: {{$landingPageData['color_cronometro']}} !important;
		}
		.cronometro__fecha{
			color: {{ $landingPageData['color-fechas'] }} !important;
		}
		.info__parrafo{
			
			color: {{ $landingPageData['color_parrafo'] }} !important;
		}
		.info__btn{
			background: {{ $landingPageData['color_boton'] }} !important;
			color: {{ $landingPageData['color_texto_boton'] }} !important;
		}
		.informacion__cronometro{
			color: {{ $landingPageData['color_cronometro']}} !important;
		}
		.redes_item{
			color: {{ $landingPageData['color-iconos'] }} !important;
		}
		.submit__button{
			background: {{ $landingPageData['color_boton'] }} !important;
			color: {{ $landingPageData['color_texto_boton'] }} !important;
		}
		.seccion__info-evento{
			background: {{ $landingPageData['color_fondo_secciono'] }} !important;
		}
		.info-evento__titulo{
			color: {{ $landingPageData['color_titulo_seccion'] }} !important;
			
		}
		.info-evento__texto{
			color: {{ $landingPageData['color_texto_seccion'] }} !important;
		}
		.portada__titulo{
			color: {{$landingPageData['color_subtitulo']}} !important;
		}
		.redes__link{
			color: {{$landingPageData['color-iconos']}} !important;
		}
		.mensaje{
			color: white;
			-webkit-text-stroke: 1px #F8F8F8;
			text-shadow: 0px 2px 4px red;
			font-size: 5rem
		}
	</style>
	
	

	@vite(['resources/js/app.js'])
	<!-- Estilos leading -->
	<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

	
</head>

<body>

	{{--
	<?php
	    include 'viewEditorLading.php';
	?> --}}
	@include('public.formEditPage')
	<header class="header grid">
		<input type="hidden" value="{{url('/')}}" id="url">
		<input type="hidden" id="landingPageId" value="{{ $landingPage->id }}">

		<div class="header__logo flex">
			@if(isset($landingPage) && !empty($landingPage->img_logo))
		
			<img class="boton logo__img" src="{{ asset('storage').'/' . $landingPage->img_logo}}"
				alt="imagen logo">
			@else
			<p>No se encontró ninguna imagen</p>
			@endif
		</div>


		<div class="header__titulo">
			<h1 class="titulo__texto">{{ $landingPageData['titulo_evento'] }}</h1>
		</div>

		<ul class="header__redes flex">
			<li class="redes__item">
				<a class="redes__link whatsapp">
					<i class="fab fa-whatsapp"></i>
				</a>
			</li>
			<li class="redes__item">
				<a class="redes__link facebook">
					<i class="fab fa-facebook"></i>
				</a>
			</li>
		</ul>
	</header>

	<!--Infromacion de portada y cronometro-->
	<section class="seccion__portada">
		<div class="capa"></div>

		<div class="portada__contenedor flex centrar-y">
			
			<div class="portada__titulos">
				<h2 class="portada__titulo">{{$landingPageData['subtitulo']}}</h2>
				<div class="titulo__cronometro">
					<p id="fechaEvento" style="display: none;">{{$landingPageData['fecha_evento']}} {{$landingPageData['hora_evento']}}</p>
					<p id="cronometro" class="informacion__cronometro"></p>
					<div id="contenedorDelTexto" class="mensaje"></div>
					<p id="cronometro_fechas" class="cronometro__fecha">Días Horas Minutos Segundos</p>
				</div>
				
			</div>

			<div class="portada__info">
				<p class="info__parrafo">
					{{$landingPageData['texto_portada']}}
				</p>
			</div>
			<button id="btn_abrirFormulario" class="btn info__btn">Regístrate</button>
		</div>

	</section>

	<!-- Formulario Registro -->
	<section class="formulario">
		<div class="capa"></div>
		<div class="formulario__contenedor ">
			<form id="form_registro" class="formulario__registro">
				<div class="registro__button_cerrar flex centrar">
					<button id="btn_cerrarFormulario" class="close__button">
						<i class="fas fa-times"></i>
					</button>
				</div>

				<fieldset class="registro__invitado">
					<legend class="invitado__titulo">
						@if(isset($landingPage) && !empty($landingPage->img_logo))
		
						<img class="boton logo__img" src="{{ asset('storage').'/' . $landingPage->img_logo}}"
							alt="imagen logo">
						@else
						<p>No se encontró ninguna imagen</p>
						@endif
					</legend>

					<h3 class="invitado__subtitulo">Registrate: </h3>

					<div class="registro__input">
						<label for="nombreRegistro" class="input__label">Nombre</label>
						<input class="input__text" type="text" name="nombreRegistro">
					</div>

					<div class="registro__input">
						<label for="apellidoRegistro" class="input__label">Apellido</label>
						<input class="input__text" type="text" name="apellidoRegistro">
					</div>

					<div class="registro__input">
						<label for="telefonoRegistro" class="input__label">Teléfono</label>
						<input class="input__text" type="tel" name="telefonoRegistro">
					</div>

					<div class="registro__input">
						<label for="emailRegistro" class="input__label">Correo electrónico</label>
						<input class="input__text" type="email" name="emailRegistro">
					</div>

					<div class="registro__input">
						<label for="empresaRegistro" class="input__label">Empresa</label>
						<input class="input__text" type="text" name="empresaRegistro">
					</div>

					<button class="submit__button" type="submit">Enviar</button>
				</fieldset>
			</form>
		</div>
	</section>

	<main>
		<section class="seccion__info-evento">
			<h2 class="info-evento__titulo">{{$landingPageData['subtitulo']}}</h2>

			<div id="info_eventos" class="info-evento__texto">
				<p class="info-evento__texto">
					{{$landingPageData['items_textarea']}}
				</p>
			</div>
		</section>
	</main>

	<footer class="footer flex centrar">

		<div class="footer__contenedor">
			<div class="footer__logo flex centrar">
				<div class="header__logo flex">
					@if(isset($landingPage) && !empty($landingPage->img_logo))
				
					<img class="boton logo__img" src="{{ asset('storage').'/' . $landingPage->img_logo}}"
						alt="imagen logo">
					@else
					<p>No se encontró ninguna imagen</p>
					@endif
				</div>
				<h3 class="footer__titulo">{{ $landingPageData['titulo_evento'] }}</h3>
			</div>

			<div class="footer__terminos flex centrar">
				<a class="footer__link" href="">AVISO DE PRIVACIDAD</a>
				<a class="footer__link" href="">TÉRMINOS Y CONDICIONES</a>
			</div>
		</div>

	</footer>

	<script>
		document.addEventListener('DOMContentLoaded', function() {
			// Obtener el valor de eventoPaso desde PHP
			const eventoPaso = {{ json_encode($eventoPaso) }};
		
			// Verificar si el evento ha pasado
			if (eventoPaso) {
				// Ocultar el componente <p id="fechaEvento">
				document.getElementById('cronometro').style.display = 'none';
				document.getElementById('fechaEvento').style.display = 'none';
				document.getElementById('btn_abrirFormulario').style.display = 'none';
				document.getElementById('cronometro').style.display = 'none';
				document.getElementById('cronometro_fechas').style.display = 'none';
				document.getElementById('info__parrafo').style.display = 'none';
				
				// Mostrar el texto de evento ya terminado
				const textoEventoTerminado = document.createElement('p');
				textoEventoTerminado.textContent = 'El evento ya ha iniciado';
				document.getElementById('contenedorDelTexto').appendChild(textoEventoTerminado);
			} else {
				// Si el evento no ha pasado, mantener el componente <p id="fechaEvento"> visible
				document.getElementById('fechaEvento').style.display = 'block';
			}
		});
		
	</script>
</body>

</html>