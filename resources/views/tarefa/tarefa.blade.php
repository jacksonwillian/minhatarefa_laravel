@extends('layouts.app')

@section('content')
<div id="containertarefa" class="container" >
    <div class="row justify-content-center">
        <div class="col-md-8">

            <form style="margin-bottom:10px;" class="form"  action="{{ route('tarefa.show',0)}}" method="GET">
                <input name="pesquisa" style="display:none;top:64px; width:90%; margin: auto;  max-width:430px;" id="barraPesquisa" class="form-control fixed-top" type="search"><br>
                <button id="botaoPesquisa"  style="display:none" class="form-control" type="submit"></button>
            </form>

                @forelse ($tarefas as $tarefa)
                    <div class="tarefa" class="card">
                        <div class="card-header {{ $tarefa->prioridade }}">
                            {{$tarefa->titulo}}
                            <a href="{{ route('tarefa.edit', $tarefa->id) }}"> <i class="material-icons" style="color:gray; font-size:14px;  padding-right:10px; padding-bottom:10px; margin-left: 5px; float:right">create</i> </a>
                        </div>
                        <div  class="card-body {{ $tarefa->prioridade }}">
                        {{$tarefa->descricao}} <br>
                        <span style="font-size:10px;">({{$tarefa->situacao}})</span>
                        </div>
                    </div>
                @empty
                    <h6 style="text-align: center;"> Não foi encontrado nenhuma tarefa! </h6>
                @endforelse

        </div>
    </div>

    <div id="botoes">
        <ul id="myicones">
            <li><a href="#barraPesquisa" onclick="showBarraPesq();" > <i class="material-icons" style="font-size:36px">search</i>  </a></li>
            <li><a href="{{ route('tarefa.create') }}"> <i class="material-icons" style="font-size:32px">add_circle_outline</i> </a></li>
        </ul>
    </div>

</div>
@endsection

@push('scripts')
    <script>

        function showBarraPesq(){

            var input = document.getElementById("barraPesquisa");
            if(input.style.display === "none"){
                input.style.display = "block";
            }else{
                input.style.display = "none";
            }

        };

        var input = document.getElementById("barraPesquisa");
        input.addEventListener("keyup", function(event) {
            if (event.keyCode === 13) {
                event.preventDefault();
                document.getElementById("botaoPesquisa").click();
            }
        });


    </script>
    <link href="{{ asset('css/personalizacao.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
@endpush
