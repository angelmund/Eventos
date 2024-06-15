<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class InscripcionesEvento
 * 
 * @property int $id
 * @property string $nombre
 * @property string $apellido
 * @property string $correo
 * @property string $empresa
 * @property int $estado
 * @property int $id_evento
 * 
 * @property LandingPage $landing_page
 *
 * @package App\Models
 */
class InscripcionesEvento extends Model
{
	protected $table = 'inscripciones_evento';
	public $timestamps = false;

	protected $casts = [
		'estado' => 'int',
		'id_evento' => 'int'
	];

	protected $fillable = [
		'nombre',
		'apellido',
		'correo',
		'empresa',
		'estado',
		'id_evento'
	];

	public function landing_page()
	{
		return $this->belongsTo(LandingPage::class, 'id_evento');
	}
}
