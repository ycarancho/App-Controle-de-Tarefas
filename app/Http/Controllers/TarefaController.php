<?php

namespace App\Http\Controllers;

use Mail;
use App\Mail\NovaTarefaMail;
use App\Models\Tarefa;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TarefasExport;
use PDF;

class TarefaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_usuario = auth()->user()->id;
        $tarefas = Tarefa::where('user_id', $id_usuario)->paginate(2);
        return view('tarefa.index', ['tarefas' => $tarefas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tarefa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dados = $request->all(['tarefa', 'data_tarefa']);
        $dados['user_id'] = auth()->user()->id;
        $tarefa = Tarefa::create($dados);
        $destinatario = auth()->user()->email;
        Mail::to($destinatario)->send(new NovaTarefaMail($tarefa));
        return redirect()->route('tarefa.show', ['tarefa' => $tarefa->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function show(Tarefa $tarefa)
    {
        return view('tarefa.show', ['tarefa' => $tarefa]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function edit(Tarefa $tarefa)
    {
        $id_usuario = auth()->user()->id;
        if ($tarefa->user_id == $id_usuario) {
            return view('tarefa.edit', ['tarefa' => $tarefa]);
        };

        return view('acesso_negado');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tarefa $tarefa)
    {
        $id_usuario = auth()->user()->id;
        if ($tarefa->user_id == $id_usuario) {
            $tarefa->update($request->all());
            return redirect()->route('tarefa.show', $tarefa->id);
        }

        return view('acesso_negado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tarefa  $tarefa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tarefa $tarefa)
    {
        $id_usuario = auth()->user()->id;
        if ($tarefa->user_id == $id_usuario) {
            $tarefa->delete();
            return redirect()->route('tarefa.index');
        }

        return view('acesso_negado');
    }

    public function exportarTarefasParaExcel($extencao)
    {
        if (in_array($extencao, ['xlsx', 'csv', 'pdf'])) {
            return Excel::download(new TarefasExport, "tarefas_export.$extencao");
        } else {
            return redirect()->route('tarefa.index');
        }
    }

    public function exportarPdf()
    {
        $tarefas = auth()->user()->tarefas()->get();
        $pdf = PDF::loadView('tarefa.pdf', ['tarefas'=> $tarefas]);
        //orientação: landscape(paisagem) portrait(retrato)
        $pdf->setPaper('a4','landscape');
        //return $pdf->download('lista_tarefas.pdf'); <- Baixa o arquivo
        return $pdf->stream('lista_tarefas.pdf'); // <- Abre o arquivo em uma nova aba
    }
}
