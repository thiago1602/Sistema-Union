
@extends('adminlte::page')



@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Atualizar Produto</div>

                    <div class="card-body">
                        <form method="post" action="{{ route('produto.update', ['produto' => $produto->id]) }}">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">Produto</label>
                                <input type="text" class="form-control" name="nome" value="{{$produto->nome}}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Preço</label>
                                <input type="number" class="form-control" name="valor" value="{{$produto->valor}}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Data do Cadastro</label>
                                <input type="date" class="form-control" name="data_cadastro" value="{{$produto->data_cadastro}}">
                            </div>

                            <button type="submit" class="btn btn-primary">Atualizar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
