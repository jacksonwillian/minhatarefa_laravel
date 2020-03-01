@extends('layouts.app')

@section('content')
<div id="containertarefa" class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h5> Cria Tarefa </h5>
            <br>
             <form class="form" method="POST" action="{{ route('tarefa.store') }}"> {{-- ou url('/tarefa') --}}
                @csrf

                @if ($errors->all())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger" role="alert">
                            {{ $error }}
                        </div>
                    @endforeach
                @endif

                <label for="titulo"> Título </label>
                <br>
                <input class="form-control" type="text" name="titulo" value="{{old('titulo')}}">
                <br>
                <label for="prioridade"> Prioridade </label>
                <br>
                <select class="form-control" name="prioridade">

                    @php
                        $options = array( ["value" => "normal","text" => "Normal"],["value" => "alta","text" => "Alta"], [ "value" => "baixa","text" => "Baixa"]);
                    @endphp

                    @foreach ( $options as $option)
                        <option @if(old('prioridade')==$option['value']) {{'selected="selected"'}} @endif value="{{ $option['value'] }}"> {{ $option['text'] }} </option>
                    @endforeach

                </select>
                <br>
                <label for="descricao"> Descricao </label>
                <br>
                <textarea class="form-control" name="descricao" >{{old('descricao')}}</textarea>
                <br><br>
                <button type="submit" style="float:right; margin-left:3px;" class="btn btn-primary"> Criar </button>
                <a  href={{ url('/tarefa') }} style="float:right; margin-left:3px;" class="btn btn-primary"> Voltar </a>
            </form>
        </div>
    </div>
</div>
@endsection


@push('scripts')
    <link href="{{ asset('css/personalizacao.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endpush
