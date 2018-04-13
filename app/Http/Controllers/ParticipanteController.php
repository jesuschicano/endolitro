<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Participante;

class ParticipanteController extends Controller
{
    public function index()
    {
      $participantes = Participante::all();
      return view('participantes.index', ['participantes' => $participantes]);
    }

    public function create()
    {
      return view('participantes.create');
    }

    public function store(Request $request)
    {
      /* MODO VALIDACIÓN 1: clase validator*/
      /*$data = $request->all();
      $rules = [
        'nombre' => 'required',
        'apellidos' => 'required',
        'email' => 'required|email'
      ];
      $validator = Validator::make($data,$rules);
      if($validator->fails()){
        return redirect()->back()
          ->withErrors($validator->errors())
          ->withInput();
      }*/
      /********************/

      /* MODO VALIDACION 2: método validate() */
      $rules = [
        'nombre' => 'required|min:2',
        'apellidos' => 'required|min:3',
        'email' => 'required|unique:participantes|email|max:191'
      ];
      $this->validate($request,$rules);
      /**************************************/

      /* MODO VALIDACION 3: make:request CreateParticipanteRequest */
        /*
        php artisan make:request CreateParticipanteRequest
        cambiar el método authorized() a true
        poner las reglas en el método rules()
        */
      /***************************************/

      // Crear el nuevo participante
      Participante::create($request->all());
      return redirect()->back()->with('status', 'Borracho registrado satisfactoriamente.');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
      $participante = Participante::find($id);
      return view('participantes.edit', ["participante" => $participante]);
    }

    public function update(Request $request, $id)
    {
      $rules = [
        'nombre' => 'required|min:2',
        'apellidos' => 'required|min:3',
        'email' => 'required|email|max:191'
      ];
      $this->validate($request,$rules);

      $par = Participante::find($id);
      $par->nombre = $request->input('nombre');
      $par->apellidos = $request->input('apellidos');
      $par->email = $request->input('email');
      $par->activo = '1';
      $par->save();

      return redirect('participantes');
    }

    public function actdes(Request $request, $id)
    {
      $participante = Participante::find($id);
      if($participante->activo == '0')
      {
        $participante->activo = '1';
      }
      else
      {
        $participante->activo = '0';
      }
      $participante->save();
      return redirect()->back();
    }

    public function destroy($id)
    {

    }
}
