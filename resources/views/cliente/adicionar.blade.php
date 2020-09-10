@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="panel panel-default">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('cliente.index')}}">Clientes </a></li>
                        <li class="breadcrumb-item active">Adicionar</li>
                    </ol>
                        
                    <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <form action="{{route('cliente.salvar')}}" method="post">
                        {{csrf_field()}}
                            <div class="form-group">
                                <label for="nome">Nome</label>
                                <input type="text" name="nome" class="form-control {{ $errors->has('nome') ? 'is-invalid' : 'false'}}" placeholder="Nome do Cliente">
                                @if($errors->has('nome'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('nome')}}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="endereco">Endereço</label>
                                <input type="text" name="endereco" class="form-control {{ $errors->has('endereco') ? 'is-invalid' : 'false'}}" placeholder="Endereço do Cliente">
                                @if($errors->has('endereco'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('endereco')}}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="numero">Numero</label>
                                <input type="number" name="numero" class="form-control {{ $errors->has('numero') ? 'is-invalid' : 'false'}}" placeholder="Endereço do Cliente">
                                @if($errors->has('numero'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('numero')}}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="email">E-mail</label>
                                <input type="text" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : 'false'}}" placeholder="E-mail do Cliente">
                                @if($errors->has('email'))
                                    <div class="invalid-feedback">
                                        {{$errors->first('email')}}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="observacao">Observações</label>
                                <textarea class="form-control" aria-label="With textarea" name="observacao" placeholder="Observacões"></textarea>
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
