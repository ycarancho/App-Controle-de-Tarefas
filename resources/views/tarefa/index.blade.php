@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                                Tarefas
                            </div>
                            <div class="col-6">
                                <div class="float-right">
                                    <a href="{{ route('tarefa.create') }}" class="mr-3"> Novo</a>
                                    <a href="{{ route('tarefa.export', ['extencao'=>'xlsx']) }}" class="mr-3"> Export XLSX</a>
                                    <a href="{{ route('tarefa.export', ['extencao'=>'csv']) }}" class="mr-3"> CSV</a>
                                    <a href="{{ route('tarefa.export', ['extencao'=>'pdf']) }}" class="mr-3"> PDF</a>
                                    <a href="{{ route('tarefa.exportar') }}" target="_blank" class=""> PDF V2</a>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Tarefa</th>
                                    <th scope="col">Data Limite</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tarefas as $tarefa => $item)
                                    <tr>
                                        <th scope="row">{{ $item['id'] }}</th>
                                        <td>{{ $item['tarefa'] }}</td>
                                        <td>{{ date('d/m/Y', strtotime($item['data_tarefa'])) }}</td>
                                        <td><a href="{{ route('tarefa.edit', $item['id']) }}">Editar</a></td>
                                        <td>
                                            <form id="form_{{ $item['id'] }}"
                                                action="{{ route('tarefa.destroy', ['tarefa' => $item['id']]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <a href="#"
                                                onclick="document.getElementById('form_{{ $item['id'] }}').submit()">Excluir</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <nav>
                            <ul class="pagination">
                                <li class="page-item"><a class="page-link"
                                        href="{{ $tarefas->previousPageUrl() }}">Anterior</a></li>
                                @for ($i = 1; $i <= $tarefas->lastPage(); $i++)
                                    <li class="page-item {{ $tarefas->currentPage() == $i ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $tarefas->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor
                                <li class="page-item"><a class="page-link" href="{{ $tarefas->nextPageUrl() }}">Proxima</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
