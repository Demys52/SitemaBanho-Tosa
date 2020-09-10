<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RelatorioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $data = date('Y-m-d');
        return view('relatorio.index', compact('data'));
    }
    
    public function exibir(Request $request, $id)
    {
        $dataI = str_replace("-","/",$request->input("dataI"));
        $dataI = $dataI." 00:00:00";
        $dataF = str_replace("-","/",$request->input("dataF"));
        $dataF = $dataF." 23:59:59";
        switch ($id)
        {
            case 1:
                $servicos = \App\Servico::whereBetween('data_hora_finalizado', array($dataI, $dataF))->where('status', 'F')->get();
                foreach ($servicos as $servico)
                {
                    foreach ($servico->servicos_itens as $tipo)
                    {
                        //dd($tipo->item_servico);
                        dd($servicos->servicos_listas());
                    }
                }
                
                break;
            case 2:
                $servicos = \App\Servico::whereBetween('data_hora_cancelado', array($dataI, $dataF))->where('status', 'C')->get();
                dd($servicos);
                break;
            default:
                \Session::flash('flash_message',[
                                            'msg'=>'Relatório não existe ou ainda não criado, Contacte o desenvolvedor!',
                                            'class'=>'alert alert-danger'
                                            ]);
                $data = date('Y-m-d');
                return view('relatorio.index', compact('data'));
        }
        
        return view('relatorio.exibir', compact('data'));
    }
}
