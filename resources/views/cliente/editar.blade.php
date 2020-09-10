@extends('layouts.app')

@section('content')
    
   
    
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="panel panel-default">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('cliente.index')}}">Clientes </a></li>
                        <li class="breadcrumb-item active">Editar</li>
                    </ol>
                        
                    <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <form action="{{route('cliente.atualizar',$cliente->id)}}" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="_method" value="put">
                            <div class="form-group">
                                <label for="nome">Nome</label>
                                <input type="text" name="nome" class="form-control" placeholder="Nome do Cliente" value="{{$cliente->nome}}">
                            </div>
                            <div class="form-group">
                                <label for="endereco">Endereço</label>
                                <input type="text" name="endereco" class="form-control" placeholder="Endereço do Cliente" value="{{$cliente->endereco}}">
                            </div>
                            <div class="form-group">
                                <label for="numero">Numero</label>
                                <input type="number" name="numero" class="form-control" placeholder="Numero da Casa" value="{{$cliente->numero}}">
                            </div>
                            <div class="form-group">
                                <label for="email">E-mail</label>
                                <input type="text" name="email" class="form-control" placeholder="E-mail do Cliente" value="{{$cliente->email}}">
                            </div>
                            <div class="form-group">
                                <label for="observacao">Observações</label>
                                <textarea class="form-control" aria-label="With textarea" name="observacao" placeholder="Observacões">{{$cliente->observacao}}</textarea>
                            </div>
                            <button class="btn btn-info">Atualizar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
