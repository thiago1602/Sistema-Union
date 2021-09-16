

@extends('adminlte::page')

@section('content')


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                                Clientes
                            </div>
                            <div class="col-6">
                                <div class="float-right">
                                    <a href="{{route('customers.create')}}" class="mr-3"><button class="btn btn-primary" type="submit">Novo</button></a>
                                    <a href="{{route('customers.report', ['extensao' => 'xlsx'])}}" class="mr-3"><button class="btn btn-primary" type="submit">XLSX</button></a>
                                <a href="{{route('customers.report', ['extensao' => 'csv'])}}" class="mr-3"><button class="btn btn-primary" type="submit">CSV</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">

                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Email</th>
                        <th scope="col">Cpf</th>
                        <th scope="col">Data do Cadastro</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($customers as $key => $c)
                        <tr>
                            <th scope="row">{{$c['id']}}</th>
                            <td>{{$c['name']}}</td>
                            <td>{{$c['email']}}</td>
                            <td>{{$c['cpf']}}</td>
                            <td>{{date ('d/m/Y', strtotime($c['data_cadastro']))}}</td>
                            <td><a href="{{route('customers.edit', $c['id'])}}"><button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                                        <i class="fa fa-lg fa-fw fa-pen"></i>
                                    </button></a>
                                <form id="form_{{$c['id']}}" method="post" action="{{route('customers.destroy', ['customer' => $c['id']])}}">
                                    @method('DELETE')
                                    @csrf
                                </form>
                            <td><a href="#" onclick="document.getElementById('form_{{$c['id']}}').submit()"><button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                                        <i class="fa fa-lg fa-fw fa-trash"></i>
                                    </button></a> </td>
                        </tr>

                    @endforeach
                    </tbody>
                </table>

                <nav>
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="{{$customers->previousPageUrl()}}" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>

                        @for($i = 1; $i <= $customers->lastPage(); $i++)
                            <li class="page-item {{$customers->currentPage() == $i ? 'active' : ''}}">
                                <a class="page-link" href="{{$customers->url($i)}}">{{$i}}</a>
                            </li>
                        @endfor
                        <li class="page-item">
                            <a class="page-link" href="{{$customers->nextPageUrl()}}" aria-label="Next">
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
