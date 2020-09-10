@extends('layouts.app')

@push('scripts')
<script src="{{ asset('js/mask/mask.js') }}" defer></script>
@endpush
@stack('scripts')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('servico.index')}}">Serviços </a></li>
                    <li class="breadcrumb-item"><a href="{{route('servico.finalizar')}}">Aberto</a></li>
                    <li class="breadcrumb-item active">Pagamento</li>
                </ol>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                <form id="formPagamento" action="{{route('servico.acertar')}}" method="post">
                        {{csrf_field()}}
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Pedido</th>
                                <th>Usuario</th>
                                <th>Cliente</th>
                                <th>TOTAL</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($servicos as $servico)
                            <tr>
                                <th scope="row">{{$servico->id}}
                                <input type="hidden" name="id[]" readonly value="{{$servico->id}}"> 
                                </th>
                                @if($usuario = auth()->user()::find($servico->usuario_id))
                                <th scope="row">{{$usuario->name}}</th>
                                @endif
                                <th scope="row">{{$servico->cliente($servico->cliente_id)->nome}}</th>
                                <th scope="row">{{$servico->valor}}</th>
                            </tr>
                            @if($total[] = $servico->valor)
                            @endif
                        @endforeach
                            <tr>
                                <td colspan=3><b>Valor Total:</b></td>
                                <td>{{number_format(array_sum($total), 2, ',', '.')}}<div id="total"></div></td>
                            </tr>
                        </tbody>
                    </table>
                    <div id="pagamento" class="card">
                        @foreach($pagamentos as $pagamento)        
                        <ul id="lista" class="nav nav-pills nav-fill">
                            <li class="nav-item">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputGroupSelect01">Forma de Pagamento</label>
                                    </div>
                                    <select name="formadepagamento[]" id="formadepagamento" class="custom-select" id="inputGroupSelect01">
                                        <option value="{{$pagamento->id}}">{{$pagamento->tipo}}</option>
                                    </select>
                                </div>
                            </li>
                            @if($pagamento->id != 2)
                            <li class="nav-item">
                                <div id="parcelas" class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">Parcelas</span>
                                    </div>
                                        <input type=hidden name="parcela[]" value="0">
                                        <label id="parcela" class="form-control" aria-label="Amount (to the nearest dollar)">0</label>
                                </div>
                            </li>
                            @endif
                            @if($pagamento->id == 2)
                            <li class="nav-item">
                                <div id="parcelas" class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">Parcelas</span>
                                    </div>
                                        <input type="number" class="form-control" min="1" max="12" name="parcela[]" value="1">
                                </div>
                            </li>
                            @endif
                            <li class="nav-item">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text">R$</span>
                                    </div>
                                    <input type="text" name="pago[]" class="money form-control" onkeyup="valorInformado();" value="" aria-label="Amount (to the nearest dollar)">
                                </div>
                            </li>
                        </ul>
                        @endforeach
                        <div class="input-group-prepend">
                        <span class="input-group-text">Valor Total Informado: </span>
                            <span class="total input-group-text">0,00</span>
                        </div>
                    </div>
                    <input type="button" onclick="salvar();" class="btn btn-info" value="Finalizar">
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
function valorInformado()
{
    $(".total").each(function() {
    total = 0;
        valor = document.getElementsByName("pago[]");
        for (var x = 0; x < valor.length; x++)
        {
            valorFloat = parseFloat(valor[x].value);
            if (!isNaN(valorFloat))
            total += valorFloat;
        }
        
        var valorAtual = this.innerHTML;
        var valorFinal = total; // Faz o calculo aqui. 
        this.innerHTML = valorFinal; // Atualiza o valor calculado.
    });    
}
    function salvar()
    {
        total = 0;
        valor = document.getElementsByName("pago[]");
        for (var x = 0; x < valor.length; x++)
        {
            valorFloat = parseFloat(valor[x].value);
            if (!isNaN(valorFloat))
            total += valorFloat;
        }
        if (total == '{{array_sum($total)}}')
        {
            document.getElementById("formPagamento").submit();
        }
        else
        {
            alert('Valor informado '+total+' diferente de {{array_sum($total)}}')
        }
    }
</script>