@extends('layouts.app')

@section('content')
<div id="containertarefa" class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h5> Edita Tarefa </h5>
            <br>
             <form class="form" method="POST" action="{{ route('tarefa.update', $tarefa->id) }}">
                @csrf

                @method('PATCH')

                @if ($errors->all())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger" role="alert">
                            {{ $error }}
                        </div>
                    @endforeach
                @endif

                <label for="titulo"> Título </label>
                <br>
                <input class="form-control" type="text" name="titulo" value="{{ $tarefa->titulo}}">
                <br>
                <label for="prioridade"> Prioridade </label>
                <br>
                <select class="form-control" name="prioridade">

                    @php
                        $optionsPrioridade = array( ["value" => "normal","text" => "Normal"],["value" => "alta","text" => "Alta"], [ "value" => "baixa","text" => "Baixa"]);
                    @endphp

                    @foreach ( $optionsPrioridade as $option)
                        <option @if( $tarefa->prioridade==$option['value']) {{'selected="selected"'}} @endif value="{{ $option['value'] }}"> {{ $option['text'] }} </option>
                    @endforeach

                </select>
                <br>
                <label for="situacao"> Situação </label>
                <br>
                <select class="form-control" name="situacao">

                    @php
                        $optionsSituacao = array( ["value" => "pendente","text" => "Pendente"],["value" => "concluido","text" => "Concluido"]);
                    @endphp

                    @foreach ( $optionsSituacao as $option)
                        <option @if($tarefa->situacao==$option['value']) {{'selected="selected"'}} @endif value="{{ $option['value'] }}"> {{ $option['text'] }} </option>
                    @endforeach

                </select>
                <br>
                <label for="descricao"> Descrição </label>
                <br>
                <textarea class="form-control" name="descricao" >{{$tarefa->descricao}}</textarea>
                <br><br>
                <button style="float:right; margin-left:3px;" id="submitEditar" type="submit" class="btn btn-primary"> Editar </button>
                <a  href="#" style="float:right; margin-left:3px;" class="btn btn-primary" onclick="clicaButton('submitExcluir')"> Excluir </a>
                <a  href={{ url('/tarefa') }} style="float:right; margin-left:3px;" class="btn btn-primary"> Voltar </a>


            </form>

            <form class="form" method="POST" action="{{ route('tarefa.destroy', $tarefa->id) }}" style="display:none;">
                @csrf

                @method('DELETE')

                <button id="submitExcluir" type="submit" class="btn btn-primary"> Excluir </button>
            </form>
        </div>
    </div>
</div>
@endsection


@push('scripts')
    <script>
        function clicaButton(idName){ document.getElementById(idName).click(); }
    </script>
    <link href="{{ asset('css/personalizacao.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endpush
