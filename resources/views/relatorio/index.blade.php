@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="panel panel-default">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('servico.index')}}">Serviços </a></li>
                    <li class="breadcrumb-item active">Relatórios</li>
                    </ol>
                        
                    <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <form id="formRelatorio" action="{{route('relatorio.exibir', '')}}" method="post">
                        {{csrf_field()}}
                                <span>Informe data inicial e final para visualização no relatório.</span>
                            <div class="form-group row">
                                <div class="col-6">
                                    <input class="form-control" name="dataI" type="date" value="{{$data}}" max="{{$data}}" id="example-datetime-local-input">
                                </div>
                                <div class="col-6">
                                    <input class="form-control" name="dataF" type="date" value="{{$data}}" max="{{$data}}" id="example-datetime-local-input">
                                </div>
                            </div>
                            <h3>Relatórios</h3>
                            <div class="list-group">
                                <a href="#" onclick="gerar(1);" class="list-group-item list-group-item-action">
                                    Relatório de Serviços Prestados
                                </a>
                                <a href="#" onclick="gerar(2);" class="list-group-item list-group-item-action">
                                    Relatório de Serviços Cancelados
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
    function gerar(relatorio)
    {
        var codigo = relatorio;
        document.getElementById("formRelatorio").action += "/"+codigo;
        document.getElementById("formRelatorio").submit();
    }
</script>