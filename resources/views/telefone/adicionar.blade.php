@extends('layouts.app')

@section('content') 
    
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="panel panel-default">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('cliente.index')}}">Clientes </a></li>
                        <li class="breadcrumb-item"><a href="{{route('cliente.detalhe',$cliente->id)}}">Detalhe </a></li>
                        <li class="breadcrumb-item active">Adicionar</li>
                    </ol>
                        
                    <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <form action="{{route('telefone.salvar', $cliente->id)}}" method="post">
                        {{csrf_field()}}
                            <div class="form-group">
                                <label for="contato">Contato</label>
                                <input type="text" name="contato" class="form-control {{ $errors->has('contato') ? 'is-invalid' : 'false'}}" placeholder="Nome do Contato">
                                @if($errors->has('contato'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('contato')}}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="telefone">Telefone</label>
                                <input type="text" name="telefone" class="form-control {{ $errors->has('telefone') ? 'is-invalid' : 'false'}}" placeholder="Numero do Telefone">
                                @if($errors->has('telefone'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('telefone')}}
                                    </div>
                                @endif
                            </div>
                            <button class="btn btn-info">Adicionar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
