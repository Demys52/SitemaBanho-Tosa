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
                        <form action="{{route('pet.salvar', $cliente->id)}}" method="post">
                        {{csrf_field()}}
                            <div class="form-group">
                                <label for="nome">Nome</label>
                                <input type="text" name="nome" class="form-control {{ $errors->has('nome') ? 'is-invalid' : 'false'}}" placeholder="Nome do Animal">
                                @if($errors->has('nome'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('nome')}}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="raca">Raça</label>
                                <input type="text" name="raca" class="form-control {{ $errors->has('raca') ? 'is-invalid' : 'false'}}" placeholder="Raça ou SRD">
                                @if($errors->has('raca'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('raca')}}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="porte">Porte</label>
                                <input type="text" name="porte" class="form-control {{ $errors->has('porte') ? 'is-invalid' : 'false'}}" placeholder="Porte do Animal">
                                @if($errors->has('porte'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('porte')}}
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
