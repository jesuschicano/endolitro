<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Concurso extends Model
{
  protected $table = 'concursos';

  protected $fillable = [
    'nombre', 'inicio', 'fin'
  ];

  public function participantes(){
    return $this->belongsToMany('App\Participante', 'concurso_participante', 'concurso_id', 'participante_id')->withPivot('puntuacion');
  }
}
