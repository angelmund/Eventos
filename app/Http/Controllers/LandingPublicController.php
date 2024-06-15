<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\LandingPage;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Str;


class LandingPublicController extends Controller
{
    //devulve la vista landing 
    public function publica()
    {
        // Obtener el registro más reciente de la base de datos
        $landingPage = LandingPage::latest()->first();

        // Convertir el contenido JSON en un array asociativo
        $landingPageData = json_decode($landingPage->content, true);
        // Obtener la fecha y hora actual
        $fechaActual = now();

        // Verificar si la fecha y hora del evento han pasado
        $fechaEvento = $landingPageData['fecha_evento'];
        $horaEvento = $landingPageData['hora_evento'];
        $fechaHoraEvento = Carbon::parse($fechaEvento . ' ' . $horaEvento);

        $eventoPaso = false;
        if ($fechaHoraEvento->lt($fechaActual)) {
            $eventoPaso = true;
        }

        // Pasar tanto el modelo LandingPage como el contenido JSON a la vista
        return view('public.landing', [
            'landingPage' => $landingPage,
            'landingPageData' => $landingPageData,
            'fecha_evento' => $fechaEvento,
            'hora_evento' => $horaEvento,
            'eventoPaso' => $eventoPaso
        ]);
    }

    public function nuevaLading(Request $request)
    {
        if (Auth::check()) {
            try {
                DB::beginTransaction();

                // Recopilar los datos del formulario
                $formData = [
                    'titulo_evento' => $request->input('titulo_evento'),
                    'fecha_evento' => $request->input('fecha_evento'),
                    'hora_evento' => $request->input('hora_evento'),
                    // 'imagen_logo' => $request->input('imagen_logo'), //
                    'url_whatsapp' => $request->input('url_whatsapp'),
                    'url_facebook' => $request->input('url_facebook'),
                    'color_fondo' => $request->input('color_fondo'),
                    'color_titulo' => $request->input('color_titulo'),
                    'color-iconos' => $request->input('color-iconos'),
                    'subtitulo' => $request->input('subtitulo'),
                    'texto_portada' => $request->input('texto_portada'),
                    'texto_boton' => $request->input('texto_boton'),
                    // 'img_portada' => $request->input('img_portada'), //
                    'opacidad_img_portada' => $request->input('opacidad_img_portada'),
                    'color_subtitulo' => $request->input('color_subtitulo'),
                    'color_cronometro' => $request->input('color_cronometro'),
                    'color-fechas' => $request->input('color-fechas'),
                    'color_parrafo' => $request->input('color_parrafo'),
                    'color_boton' => $request->input('color_boton'),
                    'color_texto_boton' => $request->input('color_texto_boton'),
                    'titulo_informacion' => $request->input('titulo_informacion'),
                    'items_textarea' => $request->input('items_textarea'),
                    'color_fondo_body' => $request->input('color_fondo_body'),
                    'color_fondo_secciono' => $request->input('color_fondo_secciono'),
                    'color_titulo_seccion' => $request->input('color_titulo_seccion'),
                    'color_texto_seccion' => $request->input('color_texto_seccion'),

                ];

                // Convertir los datos del formulario a JSON
                $jsonData = json_encode($formData);

                // Guardar los datos en la base de datos
                $landingPage = new LandingPage();
                $landingPage->title = $request->input('titulo_evento');
                $landingPage->content = $jsonData; // Asignar la cadena JSON al campo content
                $landingPage->save(); // Guardar el registro primero para obtener el ID asignado

                // Generar los nombres de archivo usando el ID asignado
                $logoEvento = $landingPage->id . "_logo." . pathinfo($request->file('imagen_logo')->getClientOriginalName(), PATHINFO_EXTENSION);
                $portadaEvento = $landingPage->id . "_portada." . pathinfo($request->file('img_portada')->getClientOriginalName(), PATHINFO_EXTENSION);

                // Guardar las imágenes con los nuevos nombres
                if ($request->hasFile('imagen_logo')) {
                    $landingPage->img_logo = $request->file('imagen_logo')->storeAs('eventos/img', $logoEvento, 'public');
                }

                if ($request->hasFile('img_portada')) {
                    $landingPage->imgPortada_logo = $request->file('img_portada')->storeAs('eventos/img', $portadaEvento, 'public');
                }

                $landingPage->save(); // Guardar el registro actualizado con las rutas de las imágenes


                DB::commit();

                return response()->json([
                    'mensaje' => 'Evento guardado con éxito',
                    'idnotificacion' => 1,
                ]);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json([
                    'mensaje' => 'Error al guardar ',
                    'idnotificacion' => 2
                ]);
            }
        } else {
            return redirect()->to('/');
        }
    }

    //función que regresa el json para llenar los cards de cada evento nuevo en el dashboard
    public function obtenerEventos()
    {
        try {
            // Recuperar todos los eventos de la base de datos
            $eventos = LandingPage::all();

            // Crear un array para almacenar los datos de cada evento
            $datosEventos = [];

            // Iterar sobre cada evento para obtener los datos necesarios
            foreach ($eventos as $evento) {
                // Decodificar el contenido JSON de cada evento y obtener el título y la URL de la imagen de portada
                $contenidoEvento = json_decode($evento->content, true);
                $tituloEvento = $contenidoEvento['titulo_evento'];
                $urlImagenPortada = Storage::url($evento->imgPortada_logo);


                // Agregar el título del evento, la URL de la imagen de portada y la fecha y hora del evento al array de datos de eventos como un objeto JSON
                $datosEvento = [
                    'id' => $evento->id, // Agregar el ID del evento
                    'titulo_evento' => $tituloEvento,
                    'url_imagen_portada' => $urlImagenPortada,

                ];
                $datosEventos[] = $datosEvento;
            }
            // Devolver los datos de los eventos en formato JSON
            return response()->json($datosEventos);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener los eventos'], 500);
        }
    }

    //vista con evento público
    public function ladingPublica()
    {

        // Obtener el registro más reciente de la base de datos
        $landingPage = LandingPage::latest()->first();

        // Convertir el contenido JSON en un array asociativo
        $landingPageData = json_decode($landingPage->content, true);

        // Obtener la fecha y hora actual
        $fechaActual = now();

        // Verificar si la fecha y hora del evento han pasado
        $fechaEvento = $landingPageData['fecha_evento'];
        $horaEvento = $landingPageData['hora_evento'];
        $titulo = $landingPageData['titulo_evento'];
        $fechaHoraEvento = Carbon::parse($fechaEvento . ' ' . $horaEvento);

        $eventoPaso = false;
        if ($fechaHoraEvento->lt($fechaActual)) {
            $eventoPaso = true;
        }

        // Generar la URL del evento concatenando el título
        $urlEvento = route('evento.evento', ['titulo' => Str::slug($titulo)]);

        // Pasar tanto el modelo LandingPage como el contenido JSON a la vista
        return view('publico.index', [
            'landingPage' => $landingPage,
            'landingPageData' => $landingPageData,
            'fecha_evento' => $fechaEvento,
            'hora_evento' => $horaEvento,
            'eventoPaso' => $eventoPaso,
            'urlEvento' => $urlEvento
        ]);
    }

    //devulve la vista landing 
    public function editarLanding($id)
    {

        if (Auth::check()) {
            // Obtener el registro más reciente de la base de datos
            $landingPage = LandingPage::find($id);

            // Convertir el contenido JSON en un array asociativo
            $landingPageData = json_decode($landingPage->content, true);

            // Obtener la fecha y hora actual
            $fechaActual = now();

            // Verificar si la fecha y hora del evento han pasado
            $fechaEvento = $landingPageData['fecha_evento'];
            $horaEvento = $landingPageData['hora_evento'];
            $fechaHoraEvento = Carbon::parse($fechaEvento . ' ' . $horaEvento);

            $eventoPaso = false;
            if ($fechaHoraEvento->lt($fechaActual)) {
                $eventoPaso = true;
            }

            // Pasar tanto el modelo LandingPage como el contenido JSON a la vista
            return view('public.editLanding', [
                'landingPage' => $landingPage,
                'landingPageData' => $landingPageData,
                'fecha_evento' => $fechaEvento,
                'hora_evento' => $horaEvento,
                'eventoPaso' => $eventoPaso
            ]);
        } else {
            return redirect()->to('/');
        }
    }

    //devulve la vista forEditPage
    // public function editarForm($id)
    // {

    //     if (Auth::check()) {
    //         // Obtener el registro más reciente de la base de datos
    //         $landingPage = LandingPage::find($id);

    //         // Convertir el contenido JSON en un array asociativo
    //         $landingPageData = json_decode($landingPage->content, true);

    //         // Pasar tanto el modelo LandingPage como el contenido JSON a la vista
    //         return view('public.formEditPage', [
    //             'landingPage' => $landingPage,
    //             'landingPageData' => $landingPageData
    //         ]);
    //     } else {
    //         return redirect()->to('/');
    //     }
    // }

    //actualiza la landing 
    public function Actualizar(Request $request, $id)
    {
        if (Auth::check()) {
            try {
                DB::beginTransaction();

                // Recopilar los datos del formulario
                $formData = [
                    'titulo_evento' => $request->input('titulo_evento'),
                    'fecha_evento' => $request->input('fecha_evento'),
                    'hora_evento' => $request->input('hora_evento'),
                    'url_whatsapp' => $request->input('url_whatsapp'),
                    'url_facebook' => $request->input('url_facebook'),
                    'color_fondo' => $request->input('color_fondo'),
                    'color_titulo' => $request->input('color_titulo'),
                    'color-iconos' => $request->input('color-iconos'),
                    'subtitulo' => $request->input('subtitulo'),
                    'texto_portada' => $request->input('texto_portada'),
                    'texto_boton' => $request->input('texto_boton'),
                    'opacidad_img_portada' => $request->input('opacidad_img_portada'),
                    'color_subtitulo' => $request->input('color_subtitulo'),
                    'color_cronometro' => $request->input('color_cronometro'),
                    'color-fechas' => $request->input('color-fechas'),
                    'color_parrafo' => $request->input('color_parrafo'),
                    'color_boton' => $request->input('color_boton'),
                    'color_texto_boton' => $request->input('color_texto_boton'),
                    'titulo_informacion' => $request->input('titulo_informacion'),
                    'items_textarea' => $request->input('items_textarea'),
                    'color_fondo_body' => $request->input('color_fondo_body'),
                    'color_fondo_secciono' => $request->input('color_fondo_secciono'),
                    'color_titulo_seccion' => $request->input('color_titulo_seccion'),
                    'color_texto_seccion' => $request->input('color_texto_seccion'),
                ];

                // Convertir los datos del formulario a JSON
                $jsonData = json_encode($formData);

                // Guardar los datos en la base de datos
                $landingPage =  LandingPage::find($id);
                $landingPage->title = $request->input('titulo_evento');
                $landingPage->content = $jsonData;
                $landingPage->save();

                // Verificar y guardar las imágenes si están presentes en la solicitud
                if ($request->hasFile('imagen_logo')) {
                    $logoEvento = $id . "_logo." . $request->file('imagen_logo')->getClientOriginalExtension();
                    $landingPage->img_logo = $request->file('imagen_logo')->storeAs('eventos/img', $logoEvento, 'public');
                }

                if ($request->hasFile('img_portada')) {
                    $portadaEvento = $id . "_portada." . $request->file('img_portada')->getClientOriginalExtension();
                    $landingPage->imgPortada_logo = $request->file('img_portada')->storeAs('eventos/img', $portadaEvento, 'public');
                }
                // dd($landingPage);
                $landingPage->save(); // Guardar el registro actualizado con las rutas de las imágenes

                DB::commit();

                return response()->json([
                    'mensaje' => 'Evento actualizado con éxito',
                    'idnotificacion' => 1,
                ]);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json([
                    'mensaje' => 'Error al actualizar el evento',
                    'idnotificacion' => 2
                ]);
            }
        } else {
            return redirect()->to('/');
        }
    }


    public function eliminarLanding($id)
    {
        if (Auth::check()) {
            try {
                // Obtener el registro más reciente de la base de datos
                $landingPage = LandingPage::find($id);
                $landingPage->delete();


                return response()->json([
                    'mensaje' => 'Evento eliminado correctamente.',
                    'idnotificacion' => 1,
                ]);
            } catch (\Exception $e) {
                DB::rollback();
                return response()->json([
                    'mensaje' => 'Ocurrió un error al eliminar',
                    'idnotificacion' => 2
                ]);
            }
        } else {
            return redirect()->to('/');
        }
    }
}
