@extends('layouts.app')
@section('title')
    <title>Vendas</title>
@endsection
@section('body')
    <br>
    <div class="mb-3">
        <a href="{{route('venda.index')}}" class="btn btn-dark">@lang('platform.venda.message.return')</a>
    </div>
    <h3>@lang('platform.venda.import')</h3>
    <form method="POST" action="{{ route('venda.storeImport') }}" enctype="multipart/form-data">
        @method('POST')
        @csrf
        <div class="mb-3">
            <label class="form-label">@lang('platform.venda.form.file')</label>
            <input type="file" name="file" class="form-control @error('file') is-invalid @enderror" value="{{old('file')}}">
            @if ($errors->has('file'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('file') }}</strong>
                </span>
            @endif
        </div>
        <div class="d-grid gap-2">
            <button class="btn btn-outline btn-primary" type="submit">@lang('platform.generic.action.submit')</button>
        </div>
    </form>
@endsection
