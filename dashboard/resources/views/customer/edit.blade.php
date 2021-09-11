
@extends('adminlte::page')



@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Atualizar Cliente</div>

                    <div class="card-body">
                        <form method="post" action="{{ route('customers.update', ['customers' => $customers->id]) }}">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">Nome</label>
                                <input type="text" class="form-control" name="name" value="{{$customers->name}}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="text" class="form-control" name="email" value="{{$customers->email}}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Cpf</label>
                                <input type="text" class="form-control" name="cpf" value="{{$customers->cpf}}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Data do Cadastro</label>
                                <input type="date" class="form-control" name="data_cadastro" value="{{$customers->data_cadastro}}">
                            </div>

                            <button type="submit" class="btn btn-primary">Atualizar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
