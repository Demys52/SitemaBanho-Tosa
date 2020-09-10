@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">Serviços</li>
                </ol>
                <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif 
                <div class="form-group">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('servico.finalizar')}}">Serviços em aberto</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('servico.servicos')}}">Consultar Serviços</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('relatorio.index')}}">Relatórios</a>
                        </li>
                    </ul>
                        <br>
                    <span><h4>Informe o Cliente para Adicionar um Serviço</h4></span>
                    <input type="text" class="form-control" id="mySearch" onkeyup="myFunction();" placeholder="Digite o nome do Cliente ou Pet" title="Digite o nome do Cliente ou Pet">
                    <ul id="myMenu" style="list-style-type:none;padding:0;">
                    @foreach($clientes as $cliente)
                        <li style="display: none;"><a class="list-group-item list-group-item-action list-group-item-light" href="{{route('servico.adicionar',$cliente->id)}}">
                        <p><b>Cliente:</b>
                            {{$cliente->nome}}<br>
                            {{$cliente->endereco}}<br>
                            Contatos: 
                        @foreach($cliente->telefones as $contato)
                            {{$contato->titulo}}
                        @endforeach
                        </p>
                        <b>Pets:</b>
                        @foreach($cliente->pets as $pet)
                            {{$pet->nome}} -
                            {{$pet->raca}}<br>
                        @endforeach
                        </a></li>
                    @endforeach
                    </ul>
                </div>
                </div>
            </div>        
        </div>
    </div>
</div>
@endsection
<script src="{{ asset('js/cliente/filtro.js') }}" defer></script>