<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class ServicoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $clientes = \App\Cliente::all();
        return view('servico.index', compact('clientes'));
    }
    
    public function adicionar($id)
    {
        $cliente = \App\Cliente::find($id);
        $servicos = \App\ServicosListas::all();
        if(!$cliente)
        {
            \Session::flash('flash_message',[
                                            'msg'=>'Cliente não cadastrado! Você foi direcionado para a tela de cadastro',
                                            'class'=>'alert alert-danger'
                                            ]);
            return redirect()->route('cliente.adicionar');
        }
        return view('servico.adicionar', compact('cliente','servicos'));
    }
    
    public function incluir($id)
    {
        $servico = \App\Servico::find($id);
        $cliente = \App\Cliente::find($servico->cliente_id);
        $servicos = \App\ServicosListas::all();
        if(!$cliente)
        {
            \Session::flash('flash_message',[
                                            'msg'=>'Serviço não localizado.',
                                            'class'=>'alert alert-danger'
                                            ]);
            return redirect()->route('servico.adicionar');
        }
        return view('servico.incluir', compact('servicos','cliente','servico'));
    }
    
    public function deletar($id)
    {
        $servico = \App\Servico::find($id);
        $servico->status = 'C';
        $servico->cancelado = auth()->user()->id;
        $servico->data_hora_cancelado = date('Y/m/d H:i:s');
        $servico->save();
        
        \Session::flash('flash_message',[
                                        'msg'=>'Servico Cancelado!',
                                        'class'=>'alert alert-success'
                                        ]);
        return redirect()->route('servico.finalizar');
    }
    
    public function finalizar()
    {
        $servicos = \App\Servico::all()->where('status', 'E');
        if(count($servicos) ==0)
        {
            \Session::flash('flash_message',[
                                            'msg'=>'Não consta Serviço em Aberto',
                                            'class'=>'alert alert-success'
                                            ]);
            return redirect()->route('servico.index');
        }
        $listas = \App\ServicosListas::all();
        return view('servico.finalizar', compact('servicos', 'listas'));
    }
    
    public function pagamento(Request $request)
    {
        if(Arr::has($request, 'servico'))
        {
            $pagamentos = \App\Formasdepagamentos::all();
            foreach($request->servico as $id)
            {
                $servicos[] = \App\Servico::find($id);
            }
            if(Arr::has($request, 'OrdemDeServico'))
            {
                $OSs = $request->OrdemDeServico;
            }
            else
            $OSs = array();
            return view('servico.pagamento', compact('servicos','pagamentos', 'OSs'));
        }
        \Session::flash('flash_message',[
                                            'msg'=>'Algo deu errado tente de novo',
                                            'class'=>'alert alert-danger'
                                            ]);
        return redirect()->route('servico.finalizar');
    }
    
    public function salvar(\App\Http\Requests\ServicoRequest $request, $id)
    {
        if(array_sum($request->input("quantidade")) < 1)
        {
            \Session::flash('flash_message',[
                                            'msg'=>'Pedido não cadastrado, verifique a quantidade',
                                            'class'=>'alert alert-danger'
                                            ]);
            return redirect()->route('servico.adicionar', $id);
        }
        $servicos = new \App\Servico;
        $servicos->usuario_id = auth()->user()->id;
        $servicos->cliente_id = $id;
        $servicos->status = "E";
        
        //calculo total
        $total = 0.00;
        for($x=0; $x < count($request->input("quantidade")); $x++)
        {
            $quantidade = $request->input("quantidade")[$x];
            $valor = (float)$request->input("valor")[$x];
            if(is_numeric($quantidade) && is_numeric($valor))
            {
                $total += $quantidade * $valor;
                $unidade[] = $quantidade * $valor;
            }
            else
            {
                $unidade[] = false;
            }
        }
        $servicos->valor = $total;
        
        $servicos->save();
        
        
        $servico_id = \App\Servico::find($servicos->id);
        if(!$servico_id)
        {
            \Session::flash('flash_message',[
                                            'msg'=>'Serviço não encontrado!',
                                            'class'=>'alert alert-danger'
                                            ]);
            return redirect()->route('servico.adicionar', $id);
        }
        for($x=0; $x < count($unidade); $x++)
        {
            if($unidade[$x] !== false && !empty($request->input("quantidade")[$x]))
            {
                $itens_servico = new \App\ItensServicos;
                $itens_servico->servico_id = $servicos->id;
                $itens_servico->pet_id = $request->input("pet_id");
                $itens_servico->item_servico = ($x+1);
                $itens_servico->quantidade = $request->input("quantidade")[$x];
                $itens_servico->valor_unidade = (float)$request->input("valor")[$x];
                $itens_servico->valor_desconto = 0.00;
                $itens_servico->valor_total = $unidade[$x];
                
                \App\Servico::find($servicos->id)->salvar_Itens_Servicos($itens_servico);
            }
        }
        \Session::flash('flash_message',[
                                            'msg'=>'Serviço adicionado',
                                            'class'=>'alert alert-success'
                                            ]);
            return redirect()->route('servico.incluir', $servicos->id);
    }
    public function incluirServico(\App\Http\Requests\ServicoRequest $request, $id)
    {
        if(array_sum($request->input("quantidade")) < 1)
        {
            \Session::flash('flash_message',[
                                            'msg'=>'Pedido não cadastrado, verifique a quantidade',
                                            'class'=>'alert alert-danger'
                                            ]);
            return redirect()->route('servico.incluir', $id);
        }
        $servicos = \App\Servico::find($id);
        $servicos->alterado = auth()->user()->id;
        
        //calculo total
        $total = $servicos->valor;
        for($x=0; $x < count($request->input("quantidade")); $x++)
        {
            $quantidade = $request->input("quantidade")[$x];
            $valor = (float)$request->input("valor")[$x];
            if(is_numeric($quantidade) && is_numeric($valor))
            {
                $total += $quantidade * $valor;
                $unidade[] = $quantidade * $valor;
            }
            else
            {
                $unidade[] = false;
            }
        }
        $servicos->valor = $total;
        $servicos->data_hora_alterado = date('Y/m/d H:i:s');
        
        $servicos->save();
        
        
        $servico_id = \App\Servico::find($servicos->id);
        if(!$servico_id)
        {
            \Session::flash('flash_message',[
                                            'msg'=>'Serviço não encontrado!',
                                            'class'=>'alert alert-danger'
                                            ]);
            return redirect()->route('servico.incluir', $id);
        }
        for($x=0; $x < count($unidade); $x++)
        {
            if($unidade[$x] !== false && !empty($request->input("quantidade")[$x]))
            {
                $itens_servico = new \App\ItensServicos;
                $itens_servico->servico_id = $servicos->id;
                $itens_servico->pet_id = $request->input("pet_id");
                $itens_servico->item_servico = ($x+1);
                $itens_servico->quantidade = $request->input("quantidade")[$x];
                $itens_servico->valor_unidade = (float)$request->input("valor")[$x];
                $itens_servico->valor_desconto = 0.00;
                $itens_servico->valor_total = $unidade[$x];
                
                \App\Servico::find($servicos->id)->salvar_Itens_Servicos($itens_servico);
            }
        }
        \Session::flash('flash_message',[
                                            'msg'=>'Serviço adicionado',
                                            'class'=>'alert alert-success'
                                            ]);
            return redirect()->route('servico.incluir', $id);
    }
    
    public function acertar(Request $request)
    {
        $servico_id = $request->input("id");
        $servico = \App\Servico::find($servico_id);
        //dd(($servico[0]->valor));
        if($servico[0]->valor != array_sum($request->input("pago")))
        {
            \Session::flash('flash_message',[
                                            'msg'=>'Valor do Serviço diverge do Valor informado!',
                                            'class'=>'alert alert-danger'
                                            ]);
            return redirect()->route('servico.finalizar');
        }
        if(count($servico_id) == 1)
        {
            $formadepagamento = $request->input("formadepagamento");
            //dd($request->input("parcela"));
            for($x=0; $x < count($formadepagamento); $x++)
            {
                if(!empty($request->input("pago")[$x]))
                {
                    $pagamentos = new \App\Pagamento;
                    $pagamentos->id_servico = $request->input("id")[0];
                    $pagamentos->id_formadepagamento = $request->input("formadepagamento")[$x];
                    if($request->has("parcela"))
                    {
                        $pagamentos->parcela = $request->input("parcela")[$x];
                    }
                    $pagamentos->valor = (float)$request->input("pago")[$x];
                    $pagamentos->save();
                }
            }
            
        }
        $usuario = auth()->user()->id;
        $affected = DB::table('servicos')
              ->where('id', $servico_id)
              ->update(['status' => 'F']);
              
        $affected = DB::table('servicos')
              ->where('id', $servico_id)
              ->update(['finalizado' => '1']);
              
        $affected = DB::table('servicos')
              ->where('id', $servico_id)
              ->update(['data_hora_finalizado' => date('Y/m/d H:i:s')]);
        
        \Session::flash('flash_message',[
                                            'msg'=>'Serviço Finalizado!',
                                            'class'=>'alert alert-success'
                                            ]);
        return redirect()->route('servico.index');
    }
    
    public function servicos(Request $request)
    {
        $filtro = $request['filtro'];
        if(!$filtro)
        {
            $date = date('Y-m-d');
            $servicosBD = DB::table('servicos')
                  ->where('created_at', 'LIKE', "$date%")
                  ->orderBy('status')
                  ->get();
            foreach($servicosBD as $servicoBD)
            {
                $servicos[] = \App\Servico::find($servicoBD->id);
            }
            if(!isset($servicos))
            {
                $servicos = array();
            }
        }
        else
        {
            if($filtro == "todos")
            {
                $query = \App\Servico::all();
                $servicos = $query->sortBy('status');
            }
            elseif($filtro == "mes")
            {
                        $data_incio = mktime(0, 0, 0, date('m') , 1 , date('Y'));
                        $data_fim = mktime(23, 59, 59, date('m'), date("t"), date('Y'));
                        $start = date('Y/m/d H:i:s',$data_incio);
                        $end = date('Y/m/d H:i:s',$data_fim);
                $servicos = \App\Servico::whereBetween('created_at', array($start, $end))->get();
            }
        }
        $listas = \App\ServicosListas::all();
        return view('servico.servicos', compact('servicos', 'listas'));
    }
}
