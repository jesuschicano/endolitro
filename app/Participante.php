<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participante extends Model
{
  protected $table = 'participantes';

  protected $fillable = [
    'nombre', 'apellidos', 'email'
  ];

  public function concursos(){
    return $this->belongsToMany('App\Concurso', 'concurso_participante', 'participante_id', 'concurso_id');
  }
}
