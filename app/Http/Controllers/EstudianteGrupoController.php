<?php

namespace App\Http\Controllers;

use App\Models\EstudianteGrupo;
use Illuminate\Http\Request;

class EstudianteGrupoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = EstudianteGrupo::query();

        if($request->has('estudiante_id') && is_numeric($request->estudiante_id)){
            $query->where('estudiante_id', '=', $request->estudiante_id);
        }

        if($request->has('grupo_id') && is_numeric($request->grupo_id)){
            $query->where('grupo_id', '=', $request->grupo_id);
        }

        $estudianteGrupos = $query->with('estudiantes', 'grupos')->orderBy('id', 'desc')->simplePaginate(10);
        $estudianteGrupos = $query->orderBy('id', 'desc')->simplePaginate(10);

        $estudiante = Estudiante::all();
        return view('estudiante_grupos.index', compact('estudianteGrupos','estudiantes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $estudiante = Estudiante::all();
        $grupo = Grupo::all();
        return view('estudiante_grupos.create',compact('estudiantes','grupos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $estudianteGrupo = EstudianteGrupo::create($request->all());
        return redirect()->route('estudiante_grupos.index')->with('success', 'Estudiante grupo creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $estudianteGrupo = EstudianteGrupo::find($id);

        if (!$estudianteGrupo) {
            return abort(404);
        }

        return view('estudiante_grupos.show', compact('estudianteGrupo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $estudianteGrupo = EstudianteGrupo::find($id);

        if (!$estudianteGrupo) {
            return abort(404);
        }

        $estudiante = Estudiante::all();
        $grupo = Grupo::all();
        return view('estudiante_grupos.edit', compact('estudianteGrupo','estudiantes','grupos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $estudianteGrupo = EstudianteGrupo::find($id);

        if (!$estudianteGrupo) {
            return abort(404);
        }

        $estudianteGrupo->estudiante_id = $request->estudiante_id;
        $estudianteGrupo->grupo_id = $request->grupo_id;

        $estudianteGrupo->save();

        return redirect()->route('estudiante_grupos.index')->with('success', 'Estudiante grupo actualizado correctamente.');
    }

    public function delete($id)
    {
        $estudianteGrupo = EstudianteGrupo::find($id);

        if (!$estudianteGrupo) {
            return abort(404);
        }
        return view('estudiante_grupos.delete', compact('estudianteGrupo'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $estudianteGrupo = EstudianteGrupo::find($id);

        if (!$estudianteGrupo) {
            return abort(404);
        }

        $estudianteGrupo->delete();

        return redirect()->route('estudiante_grupos.index')->with('success', 'Docente grupo eliminado correctamente.');
    
    }
}
