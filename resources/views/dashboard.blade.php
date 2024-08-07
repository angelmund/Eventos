<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Eventos Activos') }}
        </h2>
    </x-slot>

    {{-- <div class="py-12">

    </div> --}}
    <section class="seccion-evento ">
        <h2 class="seccion-evento__titulos">
            Eventos Activos
        </h2>
        <input type="hidden" value="{{url('/')}}" id="url">
        <input type="hidden" id="landingPageId" value="">
        <div class="eventos">
            @if($usuario->name == 'Admin')
            <div class="eventos__items flex">
                <a class="btn items__btn" href="{{route('publica.publica')}}">
                    <i class="icon-agregar fas fa-plus"> </i>
                    Nuevo Evento
                </a>
            </div>
            @endif
            <div class="eventos__mostrar grid">

                <!-- evento -->
                <div class="card-evento">

                    <div class="evento__texto">
                        <img src="{{asset('assets/img/Fondo.png')}}" alt="Fondo del evento" class="imagen-evento">
                        <div class="capa"></div>
                        <h3 class="evento__titulo"></h3>
                    </div>

                    <div class="evento__acciones">
                       
                        <a href="{{route('usuarios')}}" class="btn acciones__btns">
                            <i class="icon-mostrar fas fa-eye"></i>
                        </a>
                    </div>

                </div>
                <!-- Fin evento-->

                <!-- Contenedor donde se agregarán los eventos -->
                <div id="contenedor-eventos"></div>
                <!---- Termina----->



            </div>
        </div>
    </section>
</x-app-layout>