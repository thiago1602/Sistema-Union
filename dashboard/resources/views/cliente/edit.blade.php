
@extends('adminlte::page')



@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Atualizar Cliente</div>

                    <div class="card-body">
                        <form method="post" action="{{ route('cliente.update', ['cliente' => $cliente->id]) }}">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">Nome</label>
                                <input type="text" class="form-control" name="nome" value="{{$cliente->nome}}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="text" class="form-control" name="email" value="{{$cliente->email}}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Data do Cadastro</label>
                                <input type="date" class="form-control" name="data_cadastro" value="{{$cliente->data_cadastro}}">
                            </div>

                            <button type="submit" class="btn btn-primary">Atualizar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
