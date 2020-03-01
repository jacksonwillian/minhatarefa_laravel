<?php

namespace App\Http\Controllers\Tarefa;

use App\Http\Controllers\Controller;
use App\Models\Tarefa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

#


class TarefaController extends Controller
{
    private $tarefa;
    public function __construct(Tarefa $tarefa)
    {
        $this->tarefa = $tarefa;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagetitulo = ' - Lista de Tarefa';
        $tarefas = $this->tarefa->where('user_id','=', Auth::id())->get();
        return view('tarefa.tarefa', compact('tarefas','pagetitulo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pagetitulo = ' - Cria Tarefa';
        return view('tarefa.cria', compact('pagetitulo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // return $request->all();
        // return $request->only(['campo','campo']);
        // return $request->except(['campo','campo']);
        // return $request->input('titulo');
        $dados = $request->only(['titulo','prioridade','descricao']);
        $dados['situacao'] = 'pendente';
        $dados['user_id'] = Auth::id();
        if (in_array($dados['titulo'], [" ", ""]))
            return redirect()->back()->withInput()->withErrors(['Titulo nao pode ser vazio!']);
        if ( ! in_array($dados['prioridade'], ['alta','baixa','normal']))
            return redirect()->back()->withInput()->withErrors(['Prioridade deve ser normal, alta ou baixa!']);

        $result = $this->tarefa->create($dados);
        return  redirect('/tarefa/#'.$result->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id = 0)
    {
        $pagetitulo = ' - Lista de Tarefa';
        $dado =  $request->input('pesquisa');
        $tarefas = $this->tarefa->where([['titulo','like', '%' . $dado . '%'],['user_id','=', Auth::id()]])->get();
        return view('tarefa.tarefa', compact('tarefas','pagetitulo'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pagetitulo = ' - Edita Tarefa';
        $tarefa = $this->tarefa->find($id);
        if ($tarefa)
        {
            return view('tarefa.edita', compact('id','tarefa','pagetitulo'));
        }

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
        $tarefa = $this->tarefa->find($id);
        $dados = $request->only(['titulo','prioridade','situacao','descricao']);
        $result = $tarefa->update($dados);
        return redirect('/tarefa/#'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->tarefa->destroy($id);
        return redirect('/tarefa/');
    }
}
