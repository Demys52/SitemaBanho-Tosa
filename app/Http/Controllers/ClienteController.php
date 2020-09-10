<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $clientes = \App\Cliente::paginate(10);
        return view('cliente.index', compact('clientes'));
    }
    
    public function adicionar()
    {
        return view('cliente.adicionar');
    }
    
    public function detalhe($id)
    {
        $cliente = \App\Cliente::find($id);
        return view('cliente.detalhe', compact('cliente'));
    }
    
    public function salvar(\App\Http\Requests\ClienteRequest $request)
    {
        \App\Cliente::create($request->all());
        \Session::flash('flash_message',[
                                         'msg'=>'Cliente cadastrado com sucesso!',
                                         'class'=>'alert alert-success'
                                         ]);
        return redirect()->route('cliente.adicionar');
    }
    
    public function editar($id)
    {
        $cliente = \App\Cliente::find($id);
        if(!$cliente)
        {
            \Session::flash('flash_message',[
                                            'msg'=>'Cliente não cadastrado! Você foi direcionado para a tela de cadastro',
                                            'class'=>'alert alert-danger'
                                            ]);
            return redirect()->route('cliente.adicionar');
        }
        return view('cliente.editar',compact('cliente'));
    }
    
    public function atualizar(Request $request,$id)
    {
        \App\Cliente::find($id)->update($request->all());
        \Session::flash('flash_message',[
                                        'msg'=>'Cliente atualizado com sucesso!',
                                        'class'=>'alert alert-success'
                                        ]);
        return redirect()->route('cliente.index');
    }
    
    public function deletar($id)
    {
        $cliente = \App\Cliente::find($id);
        
        if(!$cliente->deletarPets_Telefones())
        {
            \Session::flash('flash_message',[
                                            'msg'=>'Cliente não pôde ser deletado!',
                                            'class'=>'alert alert-danger'
                                            ]);
            return redirect()->route('cliente.index');
        }
        $cliente->delete();
        
        \Session::flash('flash_message',[
                                        'msg'=>'Cliente com sucesso!',
                                        'class'=>'alert alert-success'
                                        ]);
        return redirect()->route('cliente.index');
    }
}
