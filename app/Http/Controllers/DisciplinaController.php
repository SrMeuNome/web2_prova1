<?php

namespace App\Http\Controllers;

use App\Models\Disciplina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DisciplinaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $disciplina = new Disciplina();
        $disciplinas = Disciplina::all();
        return view('disciplina.index', [
            "disciplina" => $disciplina,
            "disciplinas" => $disciplinas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validacao = $request->validate(
            [
                'nome' => 'required',
                'total-faltas' => 'required',
                'maximo-faltas' => 'required'
            ],
            [
                'nome.required' => 'O campo Nome é obrigatório.',
                'total-faltas.required' => 'O campo Total de Faltas é obrigatório.',
                'maximo-faltas.required' => 'o campo Máximo de Faltas é obrigatório.'
            ]
        );

        if ($request->post('id') == '') {
            $disciplina = new Disciplina();
        } else {
            $disciplina = Disciplina::find($request->post('id'));
        }

        $disciplina->nome = $request->post('nome');
        $disciplina->total_faltas = $request->post('total-faltas');
        $disciplina->maximo_faltas = $request->post('maximo-faltas');
        $disciplina->save();
        $request->session()->flash('salvar', 'Disciplina salva com sucesso!');
        return redirect('/disciplina');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $disciplina = Disciplina::find($id);
        $disciplinas = Disciplina::all();
        return view('disciplina.index', [
            "disciplina" => $disciplina,
            "disciplinas" => $disciplinas
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $disciplina = Disciplina::find($id);
        $faltas = intval($disciplina->total_faltas) + 1;
        DB::table('disciplina')
            ->where('id', '=', $id)
            ->update(['total_faltas' => $faltas]);
        return redirect('/disciplina');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Disciplina::destroy($id);
        $request->session()->flash('excluir', "Disciplina excluída com sucesso!");
        return redirect('/disciplina');
    }
}
