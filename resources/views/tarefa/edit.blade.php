@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Tarefa</div>

                    <div class="card-body">
                        <form method="POST" action="{{route('tarefa.update', $tarefa->id)}}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label">Tarefa</label>
                                <input type="text" class="form-control" name="tarefa" value="{{$tarefa->tarefa}}">
                            </div>
                            <div class="mb-3">
                                <label  class="form-label">Data Limite</label>
                                <input type="date" class="form-control" name="data_tarefa" value="{{$tarefa->data_tarefa}}">
                            </div>
                            <button type="submit" class="btn btn-primary">Atualizar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
