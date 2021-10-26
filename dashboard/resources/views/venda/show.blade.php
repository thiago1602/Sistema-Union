
@extends('adminlte::page')



@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $venda->venda }}</div>

                    <div class="card-body">
                        <fieldset disabled>
                            <div class="mb-3">
                                <label class="form-label">Data do cadastro</label>
                                <input type="date" class="form-control" value="{{ $venda->data_cadastro }}">
                            </div>
                        </fieldset>
                        <a href="{{ url()->previous() }}" class="btn btn-primary">Voltar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection



    </div>
    </div>
    </div>
    </div>
    </div>


