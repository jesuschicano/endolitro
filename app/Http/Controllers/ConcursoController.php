<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Concurso;
use App\Participante;
use PDF;

class ConcursoController extends Controller
{
    public function index()
    {
      $concursos = Concurso::where('abierto', '=', '1')->get();
      return view('concursos.listado-activo', ['concursos' => $concursos]);
    }

    public function historial()
    {
      $concursos = Concurso::where('abierto', '0')->get();
      return view('concursos.historial', ['concursos' => $concursos]);
    }

    public function create()
    {
      return view('concursos.create');
    }

    public function store(Request $request)
    {
      $rules = [
        'nombre' => 'required|min:3',
        'inicio' => 'required',
        'fin' => 'required'
      ];
      $this->validate($request,$rules);

      Concurso::create($request->all());
      $request->session()->flash('status', 'Concurso creado satisfactoriamente');

      // recoger el concurso recién creado
      $last_concurso = Concurso::where('abierto', '=', '1')->orderBy('created_at', 'DESC')->first();

      return redirect('concursos/'.$last_concurso->id.'/edit');
    }

    public function show($id)
    {
      $concurso = Concurso::find($id);
      return view('concursos.ver', ['concurso' => $concurso]);
    }

    public function edit($id)
    {
      $concurso = Concurso::where([
        ['abierto','=','1'],
        ['id','=',$id]
        ])->firstOrFail();

      $participantes = Participante::where('activo','=','1')->get();

      return view('concursos.edit', [
        'concurso' => $concurso,
        'participantes' => $participantes]
      );
    }

    public function update(Request $request, $id)
    {
      $rules = [
        'nombre' => 'required|min:3',
        'inicio' => 'required',
        'fin' => 'required'
      ];
      $this->validate($request,$rules);

      // ACTUALIZACION
      $concurso = Concurso::find($id);

      $busqueda = $concurso->participantes()->where('participante_id', '=', $request->input('participante'))->get();

      if( $busqueda->count() == 0 )
      {
        // Si no encuentra el participante.ID lo guarda
        $concurso->participantes()->attach($request->input('participante'));

        $concurso->nombre = $request->input('nombre');
        $concurso->inicio = $request->input('inicio');
        $concurso->fin = $request->input('fin');
        $concurso->save();

        return redirect('concursos/'.$id.'/edit');
      }else{
        return redirect('concursos/'.$id.'/edit')->with('status', 'No puedes agregar un concursante ya inscrito.');
      }
    }

    public function addPoints($concurso_id, $participante_id, $puntos)
    {
      // primero buscamos el concurso
      $concurso = Concurso::find($concurso_id);
      // recogemos la puntuación que tiene en ese instante
      $old = $concurso->participantes()->where('participante_id',$participante_id)->first()->pivot->puntuacion;
      // actualizamos la puntuación (pivot)
      $concurso->participantes()->updateExistingPivot($participante_id, ['puntuacion'=>$puntos+$old]);

      return redirect('concursos/'.$concurso_id.'/edit')->with('status', 'Se ha aumentado la puntuación.');
    }

    public function cerrar($id)
    {
      $c = Concurso::find($id);
      $c->abierto = 0;
      $c->save();

      return redirect('concursos');
    }

    public function destroy($id)
    {
        //
    }

    public function print($concurso_id)
    {
      // Preparación de los datos que se van a imprimir
      // Sabiendo el concurso finalizado que es por ID
      $concurso = Concurso::find($concurso_id);
      $result = $concurso->participantes()
                        ->orderBy('puntuacion', 'desc')
                        ->get();

      // ruta de la vista
      $vistaurl = 'pdf.clasificacion_final';

      // generación de la vista
      $pdf = PDF::loadview($vistaurl, compact(['concurso','result']) );

      // nombre del fichero sin espacios
      $temp_name = str_replace(' ', '_', $concurso->nombre);

      // Se lanza la descarga del fichero
      return $pdf->download('clasificacion_'.$temp_name.'.pdf');
    }
}
