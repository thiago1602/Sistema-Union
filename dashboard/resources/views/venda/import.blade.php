@extends('adminlte::page')

@section('content')


    <title> Importar</title>
<body>
<section style="padding-top: 60px;">
    <div class="row">
        <div class="col-md-6 offset-3">
            <div class="card-header">
                Importar
            </div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data" action="{{route('venda.import')}}">
                    @csrf
                    <div class="form-group">
                        <label for="file">CSV</label>
                        <input type="file" name="file" class="form-control" />
                    </div>
                    <button type="submit" class="btn btn-primary">Importar</button>
                </form>
            </div>
        </div>
    </div>

</section>
</body>
@endsection
