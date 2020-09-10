@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('cliente.index')}}">Clientes </a></li>
                        <li class="breadcrumb-item active">Detalhe</li>
                    </ol>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p><b>Cliente: </b>{{$cliente->nome}}</p>
                    <p><b>Endereço: </b>{{$cliente->endereco}}</p>
                    <p><b>Email: </b>{{$cliente->email}}</p>
                    
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th colspan="4" class="blockquote text-center"><h3>Pets</h3></th>
                            </tr>
                            <tr>
                                <th></th>
                                <th>Nome</th>
                                <th>Raça</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($cliente->pets as $pet)
                            <tr>
                                <th scope="row">{{$pet->id}}</th>
                                <td>{{$pet->nome}}</td>
                                <td>{{$pet->raca}}</td>
                                <td>
                                    <a class="btn btn-default" href="{{route('pet.editar', $pet->id)}}">Editar</a>
                                    <a class="btn btn-danger" href="javascript:(confirm('Deseja excluir o Pet?')? window.location.href='{{route('pet.deletar', $pet->id)}}': false)">Deletar</a>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <th colspan="4"><p><a class="btn btn-info" href="{{route('pet.adicionar', $cliente->id)}}">Adicionar Pet</a></p></th>
                        </tr>
                        <tr>
                                <th colspan="4" class="blockquote text-center"><h3>Telefones</h2></th>
                            </tr>
                        <tr>
                            <th></th>
                            <th>Nome</th>
                            <th>Número</th>
                            <th>Ação</th>
                        </tr>
                        @foreach($cliente->telefones as $telefone)
                            <tr>
                                <th scope="row">{{$telefone->id}}</th>
                                <td>{{$telefone->contato}}</td>
                                <td>{{$telefone->telefone}}</td>
                                <td>
                                    <a class="btn btn-default" href="{{route('telefone.editar', $telefone->id)}}">Editar</a>
                                    <a class="btn btn-danger" href="javascript:(confirm('Deseja excluir o telefone?')? window.location.href='{{route('telefone.deletar', $telefone->id)}}': false)">Deletar</a>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <th colspan="4"><p><a class="btn btn-info" href="{{route('telefone.adicionar', $cliente->id)}}">Adicionar Telefone</a></p></th>
                        </tr>
                        </tbody>
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
