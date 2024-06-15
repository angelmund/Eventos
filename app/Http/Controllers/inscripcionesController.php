<?php

namespace App\Http\Controllers;

use App\Models\InscripcionesEvento;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\LandingPage;
use App\Mail\EnviarCorreo;
use Illuminate\Support\Facades\Mail;
// Generar el código QR en el servidor
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class inscripcionesController extends Controller
{
    public function nuevaInscripcionYCorreo(Request $request)
    {
        // Guardar datos
        try {
            DB::beginTransaction();
            // Crear instancia de InscripcionesEvento y guardar datos
            $inscripcion = new InscripcionesEvento();
            $inscripcion->nombre = $request->input('nombreRegistro');
            $inscripcion->apellido = $request->input('apellidoRegistro');
            $inscripcion->telefono = $request->input('telefonoRegistro');
            $inscripcion->correo = $request->input('emailRegistro');
            $inscripcion->empresa = $request->input('empresaRegistro');
            $inscripcion->id_evento = $request->input('id');
            $inscripcion->estado = 1;
            $inscripcion->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'mensaje' => 'Ocurrió un error al inscribirse.' . $e->getMessage(),
                'idnotificacion' => 2
            ]);
        }
        // Obtener el ID del registro guardado
        $idInscripcion = $inscripcion->id;
        // Obtener el registro 
        $landingPage = LandingPage::find($request->input('id'));

        // Convertir el contenido JSON en un array asociativo
        $landingPageData = json_decode($landingPage->content, true);

        // Obtener la ruta de la imagen del código QR
        // $qrImagePath = public_path('qrcode.png');

        // Generar el código QR con el ID de la inscripción como contenido y guardarlo en la ruta especificada
        // Generar el código QR con el ID de la inscripción como contenido y fondo transparente
        // Generar el código QR con estilo personalizado
        $qrCode = QrCode::size(200)
            ->backgroundColor(255, 255, 255) // Fondo blanco
            ->color(0, 0, 0) // Color negro para los elementos del código QR
            ->generate($idInscripcion, '../public/qrcodes/qrcode.svg');
        


        // dd($qrCode);
        // Envío de correo
        try {
            // Enviar el correo electrónico con la imagen del código QR adjunta
            $datosCorreo = [
                'nombre' => $request->input('nombreRegistro'),
                'apellido' => $request->input('apellidoRegistro'),
                'telefono' => $request->input('telefonoRegistro'),
                'correo' => $request->input('emailRegistro'),
                'empresa' => $request->input('empresaRegistro'),
                'id' => $idInscripcion, // Pasar solo el ID
                'landinPage' => $landingPageData,
                'qrCode' => $qrCode, // Pasar la ruta de la imagen del código QR
            ];

            Mail::to($request->input('emailRegistro'))->send(new EnviarCorreo($datosCorreo));
        } catch (\Exception $e) {
            return response()->json([
                'mensaje' => 'Ocurrió un error al enviar el correo.' . $e->getMessage(),
                'idnotificacion' => 3
            ]);
        }

        // Respuesta de éxito
        return response()->json([
            'mensaje' => '¡Registro exitoso! Por favor, verifica tu correo electrónico para continuar.',
            'idnotificacion' => 1,
        ]);
    }
}
