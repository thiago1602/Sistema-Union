@extends('adminlte::page')

@section('title')
    <title>Clientes</title>

@section('body')
    <br>

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Editar Cliente</div>

    <form method="POST" action="{{ route('customers.storeImport') }}" enctype="multipart/form-data">
        @method('POST')
        @csrf
        <div class="mb-3">
            <label class="form-label">@lang('platform.customer.form.file')</label>
            <input type="file" name="file" class="form-control @error('file') is-invalid @enderror" value="{{old('file')}}">
            @if ($errors->has('file'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('file') }}</strong>
                </span>
            @endif
        </div>
        <div class="d-grid gap-2">
            <button class="btn btn-outline btn-primary" type="submit">@lang('platform.generic.action.submit')</button>
            <a href="{{route('customers.index')}}" class="btn btn-dark">@lang('platform.customer.message.return')</a>
        </div>
    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
