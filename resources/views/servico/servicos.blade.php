@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('servico.index')}}">Serviços </a></li>
                    <li class="breadcrumb-item active">Serviços</li>
                </ol>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('servico.servicos')}}">Hoje</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('servico.servicos', 'filtro=mes')}}">Mês</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('servico.servicos', 'filtro=todos')}}">Todos</a>
                    </li>
                </ul>
                <form id="formPagamento" action="{{route('servico.acertar')}}" method="post">
                        {{csrf_field()}}
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Pedido</th>
                                <th>Feito por</th>
                                <th>Cliente</th>
                                <th>TOTAL</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(count($servicos) > 0)
                            @foreach($servicos as $servico)
                                @php
                                $total[] = 0;
                                $cancelado[] = 0;
                                $receber[] = 0;
                                if($servico->status == 'F')
                                {
                                    $total[] = $servico->valor;
                                    $status = "table-success";
                                }
                                elseif($servico->status == 'C')
                                {
                                    $cancelado[] = $servico->valor;
                                    $status = "table-danger";
                                }
                                else
                                {
                                    $receber[] = $servico->valor;
                                    $status = "table-warning";
                                }
                                @endphp
                                <tr class="{{$status}}">
                                    <th scope="row">{{$servico->id}}
                                    <input type="hidden" name="id[]" readonly value="{{$servico->id}}"> 
                                    </th>
                                    @if($usuario = auth()->user()::find($servico->usuario_id))
                                    <th scope="row">{{$usuario->name}}</th>
                                    @endif
                                    <th scope="row">{{$servico->cliente($servico->cliente_id)->nome}}</th>
                                    <th scope="row">{{number_format($servico->valor, 2, ',', '.')}}</th>
                                </tr>
                                
                                @foreach($servico->servicos_itens as $itens)
                                <tr>
                                    <td>Animal: {{$servico->pet($itens->pet_id)->nome}}</td>
                                @foreach($listas as $lista)
                                    @if($lista->id == $itens->item_servico)
                                    <td>Serviço: {{$lista->nome}}</td>
                                    @endif
                                @endforeach
                                    <td>Desconto: {{number_format($itens->valor_desconto, 2, ',', '.')}}</td>
                                    <td>Valor: {{number_format($itens->valor_unidade, 2, ',', '.')}}</td>
                                </tr>
                                @endforeach
                            @endforeach
                            <tr>
                                <td colspan=3><b>Valor Total Recebido:</b></td>
                                <td><b>{{number_format(array_sum($total), 2, ',', '.')}}</b></td>
                            </tr>
                            <tr>
                                <td colspan=3><b>Valor Cancelado:</b></td>
                                <td><b>{{number_format(array_sum($cancelado), 2, ',', '.')}}</b></td>
                            </tr>
                            <tr>
                                <td colspan=3><b>Valor a Receber:</b></td>
                                <td><b>{{number_format(array_sum($receber), 2, ',', '.')}}</b></td>
                            </tr>
                        @else
                            <tr>
                                <td colspan=4>Não Possui Serviços no Periodo Selecionado</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection