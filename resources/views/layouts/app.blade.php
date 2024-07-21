<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Eventos') }}</title>
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('DataTables/datatables.min.css') }}">
    <!-- jQuery -->
    <script src="{{ asset('DataTables/jQuery-3.7.0/jquery-3.7.0.min.js') }}"></script>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('bootstrap-5.2.3-dist/css/bootstrap.min.css') }}">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="stylesheet" href="{{asset('assets/css/normalize.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/styles_admin.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/styles.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/stylesEditorLading.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/stylesLading.css')}}">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.2.0/css/all.min.css">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <header class="header__admin flex centrar-y">
        <div class="admin__logo">
            <h1 class="logo__titulo">
                <a>Quality Copy</a>
                <span class="registered">®</span>
            </h1>
        </div>

        <div class="admin-btns">
            <a href="{{route('profile.edit')}}" id="btn_perfil" class="btn btns__btn icon-editar">
                <i class="fas fa-user-circle"></i>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>

            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                id="btn_salir" class="btn btns__btn icon-eliminar">
                <i class="fas fa-sign-out-alt"></i>
            </a>

        </div>
    </header>
    <div class="min-h-screen bg-gray-100">


        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('bootstrap-5.2.3-dist/js/bootstrap.min.js') }}"></script>
    <!-- SweetAlert2 JS -->
    // <script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- DataTables JS -->
    <script src="{{ asset('DataTables/datatables.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>