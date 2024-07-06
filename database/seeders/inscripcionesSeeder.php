<?php

namespace Database\Seeders;

use App\Models\LandingPage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class inscripcionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $formData = [
            'titulo_evento' => 'Evento de Prueba',
            'fecha_evento' => '2023-12-31',
            'hora_evento' => '18:00',
            'url_whatsapp' => 'https://wa.me/1234567890',
            'url_facebook' => 'https://facebook.com/evento',
            'color_fondo' => '#FFFFFF',
            'color_titulo' => '#000000',
            'color-iconos' => '#FF0000',
            'subtitulo' => 'Subtítulo de Prueba',
            'texto_portada' => 'Texto de portada de prueba',
            'texto_boton' => 'Texto del botón de prueba',
            'opacidad_img_portada' => '0.5',
            'color_subtitulo' => '#00FF00',
            'color_cronometro' => '#0000FF',
            'color-fechas' => '#FFFF00',
            'color_parrafo' => '#FF00FF',
            'color_boton' => '#00FFFF',
            'color_texto_boton' => '#FFFFFF',
            'titulo_informacion' => 'Título de Información de Prueba',
            'items_textarea' => 'Item 1, Item 2, Item 3',
            'color_fondo_body' => '#F0F0F0',
            'color_fondo_secciono' => '#F8F8F8',
            'color_titulo_seccion' => '#C0C0C0',
            'color_texto_seccion' => '#A0A0A0',
        ];

        // Convertir los datos del formulario a JSON
        $jsonData = json_encode($formData);

        // Guardar los datos en la base de datos
        $landingPage = new LandingPage();
        $landingPage->title = $formData['titulo_evento'];
        $landingPage->content = $jsonData; // Asignar la cadena JSON al campo content
        $landingPage->save(); // Guardar el registro
    }
}
