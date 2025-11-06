<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    protected $table = 'alumnos';

    protected $fillable = ['nombre', 'apellidos', 'telefono', 'correo', 'fecha_nacimiento', 'nota_media', 'experiencia', 'formacion', 'habilidades', 'pdf', 'fotografia'];

    public function getFotoUrl()
    {
        if ($this->fotografia) {
            return asset('storage/' . $this->fotografia);
        }
        return asset('assets/img/sin_foto.png');
    }

    public function getPdfUrl()
    {
        if ($this->pdf) {
            return asset('storage/' . $this->pdf);
        }
        return null;
    }
}
