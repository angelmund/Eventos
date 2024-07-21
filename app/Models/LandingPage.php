<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class LandingPage
 * 
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string|null $img_logo
 * @property string|null $imgPortada_logo
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int|null $idUsuario
 * @property int $estado
 * 
 * @property User|null $user
 * @property Collection|InscripcionesEvento[] $inscripciones_eventos
 *
 * @package App\Models
 */
class LandingPage extends Model
{
	protected $table = 'landing_pages';

	protected $casts = [
		'idUsuario' => 'int',
		'estado' => 'int'
	];

	protected $fillable = [
		'title',
		'content',
		'img_logo',
		'imgPortada_logo',
		'idUsuario',
		'estado'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'idUsuario');
	}

	public function inscripciones_eventos()
	{
		return $this->hasMany(InscripcionesEvento::class, 'id_evento');
	}
}
