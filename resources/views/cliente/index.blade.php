@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">Clientes</li>
                </ol>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p><a class="btn btn-info" href="{{route('cliente.adicionar')}}">Adicionar</a></p>
                    <div class=table-responsive-sm>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Nome</th>
                                    <th>Endereço</th>
                                    <th>Numero</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($clientes as $cliente)
                                <tr>
                                    <th scope="row">{{$cliente->id}}</th>
                                    <td>{{$cliente->nome}}</td>
                                    <td>{{$cliente->endereco}}</td>
                                    <td>{{$cliente->numero}}</td>
                                    <td>
                                        <a class="btn btn-default" href="{{route('cliente.editar',$cliente->id)}}">Editar</a>
                                        <a class="btn btn-default" href="{{route('cliente.detalhe',$cliente->id)}}">Detalhe</a>
                                        <a class="btn btn-danger" href="javascript:(confirm('Deseja excluir o cliente?')? window.location.href='{{route('cliente.deletar',$cliente->id)}}': console.log(false))">Deletar</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            
                        </table>
                    </div>
                    <div align="center">
                        {!! $clientes->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
