@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('servico.index')}}">Serviços </a></li>
                    <li class="breadcrumb-item active">Adicionar</li>
                </ol>
                <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <form action="{{route('servico.salvar', $cliente->id)}}" method="post">
                        {{csrf_field()}}
                @if ($errors->any())
                <div class="card-group">
                    <div class="card">
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @endif
                <div class="card-group">
                    <div class="card">
                        <div class="card-body">
                        <b>Cliente: </b>{{$cliente->nome}}<br>
                        <b>Endereço: </b>{{$cliente->endereco}}
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                        <select name="pet_id" class="custom-select">
                            <option name="pet_id" selected>Selecione um Pet</option>
                        @foreach($cliente->pets as $pet)
                            <option value="{{$pet->id}}">{{$pet->nome}}</option>
                        @endforeach
                          </select>
                            @if($errors->has('pet_id'))
                                <div class="invalid-feedback">
                                    {{$errors->first('pet_id')}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class=table-responsive-sm>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Serviço</th>
                                <th>Quantidade</th>
                                <th>Valor Unitário</th>
                                <th>Valor</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($servicos as $servico)
                            <tr>
                                <td scope="row">
                                <input type="hidden" name="servico_id[]" value='{{$servico->id}}'>
                                {{$servico->nome}}
                                </td>
                                <td><input type="number" min="0" max="1" onclick="servicoValor();" onkeyup="servicoValor();" name="quantidade[]" value=0 class="form-control"></td>
                                <td><input step="number" name="valor[]" onclick="servicoValor();" onkeyup="servicoValor();" value="{{ number_format($servico->preco, 2, ',', '.') }}" class="form-control"></td>
                                <td><input type="number" name="total[]" class="form-control" readonly></td>
                            </tr>
                        @endforeach
                            <tr>
                                <td colspan="3"><p><b>Valor Total:</b></p></td>
                                <td><input type="number" name="valor_total" class="form-control" readonly></td>
                            </tr>
                            <tr>
                                <td colspan="5"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                            <button  onclick="zerarquantidade();" class="btn btn-info">Salvar</button>
                </form>
                </div>
            </div>        
        </div>
    </div>
</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    function zerarquantidade()
    {
        var count = document.getElementsByName("quantidade[]");
        var x = 0;
        for (var x=0; x<count.length; x++)
        {
            if (count[x].value == "")
            {
                count[x].value = 0;
            }
        }
    }
</script>
<script src="{{ asset('js/servico/preco.js') }}" defer></script>
