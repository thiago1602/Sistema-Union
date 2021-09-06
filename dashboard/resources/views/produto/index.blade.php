
@extends('adminlte::page')



@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                        Produtos
                            </div>
                            <div class="col-6">
                                <div class="float-right">
                        <a href="{{route('produto.create')}}" class="mr-3">Novo</a> </div>
                        <a href="{{route('produto.exportacao')}}">XLSX</a> </div>
                    </div>
                    </div>
                    </div>
                </div>
                    <div class="card-body">

                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Produto</th>
                                <th scope="col">Data Cadastro</th>
                                <th scope="col">Valor</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($produto as $key => $p)
                            <tr>
                                <th scope="row">{{$p['id']}}</th>
                                <td>{{$p['nome']}}</td>
                                <td>{{date ('d/m/Y', strtotime($p['data_cadastro']))}}</td>
                                <td>{{$p['valor']}}</td>
                                <td><a href="{{route('produto.edit', $p['id'])}}">Editar</a>
                                <form id="form_{{$p['id']}}" method="post" action="{{route('produto.destroy', ['produto' => $p['id']])}}">
                                      @method('DELETE')
                                @csrf
                                </form>
                                <td><a href="#" onclick="document.getElementById('form_{{$p['id']}}').submit()">Excluir</a> </td>
                            </tr>

                            @endforeach
                            </tbody>
                        </table>

                        <nav>
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="{{$produto->previousPageUrl()}}" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>

                                @for($i = 1; $i <= $produto->lastPage(); $i++)
                                <li class="page-item {{$produto->currentPage() == $i ? 'active' : ''}}">
                                    <a class="page-link" href="{{$produto->url($i)}}">{{$i}}</a>
                                </li>
                                @endfor
                                <li class="page-item">
                                    <a class="page-link" href="{{$produto->nextPageUrl()}}" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                </div>
            </div>
        </div>
    </div>
@endsection
