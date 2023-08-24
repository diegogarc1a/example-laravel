<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCurso;
use App\Models\Curso;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    public function index()
    {
        $cursos = Curso::orderBy('id','desc')->paginate();

        return view('cursos.index',compact('cursos'));
    }

    public function create()
    {
        return view('cursos.create');
    }

    public function store(StoreCurso $request){

        $curso = new Curso();

        $curso->name = $request->name;
        $curso->description = $request->description;
        $curso->categoria = $request->categoria;
        $curso->save();
        return redirect()->route('cursos.show', $curso->id);
    }

    public function show($id)
    {
        //Una forma de hacerlo
        // return view('cursos.show', array('id' => $id));

        //otra de forma de hacerlo
        $curso = Curso::find($id);

        return view('cursos.show', compact('curso'));
    }

    // public function edit($id){
    //     $curso = Curso::find($id);

    //     return $curso;
    // }

    //Forma mas corta de hacerlo
    public function edit(Curso $curso){
        return view('cursos.edit', compact('curso'));
    }

    public function update(Curso $curso, Request $request){

        $request->validate([
            'name' => 'required|max:25',
            'description' => 'required|min:10',
            'categoria' => 'required'
        ]);


        $curso->name = $request->name;
        $curso->description = $request->description;
        $curso->categoria = $request->categoria;
        $curso->save();
        return redirect()->route('cursos.show', $curso->id);
    }
}
