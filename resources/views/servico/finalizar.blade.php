@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('servico.index')}}">Serviços </a></li>
                    <li class="breadcrumb-item active">Aberto</li>
                </ol>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                <form action="{{route('servico.pagamento')}}" method="post">
                        {{csrf_field()}}
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Pedido</th>
                                <th>Usuario</th>
                                <th>Cliente</th>
                                <th>TOTAL</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                        
                        @foreach($servicos as $servico)
                            <tr>
                                <th scope="row"><input type="radio" name="servico[]" value="{{$servico->id}}"></th>
                                @if($usuario = auth()->user()::find($servico->usuario_id))
                                <th scope="row">{{$usuario->name}}</th>
                                @endif
                                <th scope="row">{{$servico->cliente($servico->cliente_id)->nome}}</th>
                                <th scope="row">{{number_format($servico->valor, 2, ',', '.')}}</th>
                                <td>
                                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#multiCollapse{{$servico->id}}" aria-expanded="false" aria-controls="multiCollapseExample2">Detalhar</button>
                                    <a class="btn btn-info" href="{{ route("servico.incluir",$servico->id) }}">Adicionar</a>
                                    <a class="btn btn-danger" href="javascript:(confirm('Deseja Cancelar o serviço?')? window.location.href='{{route('servico.deletar',$servico->id)}}': console.log(false))">Cancelar</a>
                                </td>
                            </tr>
                            @foreach($servico->servicos_itens as $itens)
                            <tr class="collapse multi-collapse" id="multiCollapse{{$servico->id}}">
                                <td>Quantidade: {{$itens->quantidade}}</td>
                                @foreach($listas as $lista)
                                        @if($lista->id == $itens->item_servico)
                                        <td>Serviço: {{$lista->nome}}</td>
                                        @endif
                                @endforeach
                                <td>Valor: {{number_format($itens->valor_unidade, 2, ',', '.')}}</td>
                                <td>Total: {{number_format($itens->valor_total, 2, ',', '.')}}</td>
                            </tr>
                            @endforeach
                            @if($total[] = $servico->valor)
                            @endif
                        @endforeach
                            <tr>
                                <td colspan=3></td>
                                <td colspan=2>Valor Total: <b>{{number_format(array_sum($total), 2, ',', '.')}}</b><div id="total"></div></td>
                            </tr>
                        </tbody>
                    </table>
                    <button class="btn btn-info">Encerrar</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection