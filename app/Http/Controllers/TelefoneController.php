<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TelefoneController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function adicionar($id)
    {
        $cliente = \App\Cliente::find($id);
        return view('telefone.adicionar', compact('cliente'));
    }
    
    public function salvar(\App\Http\Requests\TelefoneRequest $request, $id)
    {
        $cliente = \App\Cliente::find($id);
        $telefone = new \App\Telefone;
        $telefone->contato = $request->input('contato');
        $telefone->telefone = $request->input('telefone');
        
        \App\Cliente::find($id)->addTelefone($telefone);
        
        \Session::flash('flash_message',[
                                            'msg'=>'Telefone Adicionado!',
                                            'class'=>'alert alert-success'
                                            ]);
        
        return redirect()->route('cliente.detalhe', $id);
    }
    
    public function editar($id)
    {
        $telefone = \App\Telefone::find($id);
        if(!$telefone)
        {
            \Session::flash('flash_message',[
                                            'msg'=>'Telefone não cadastrado',
                                            'class'=>'alert alert-danger'
                                            ]);
            return redirect()->route('cliente.detalhe', $telefone->cliente->id);
        }
        return view('telefone.editar',compact('telefone'));
    }
    
    public function atualizar(\App\Http\Requests\TelefoneRequest $request,$id)
    {
        $telefone = \App\Telefone::find($id);
        $telefone->update($request->all());
        \Session::flash('flash_message',[
                                        'msg'=>'Telefone atualizado com sucesso!',
                                        'class'=>'alert alert-success'
                                        ]);
        return redirect()->route('cliente.index', $telefone->cliente->id);
    }
    
    public function deletar($id)
    {
        $telefone = \App\Telefone::find($id);
        $telefone->delete();
        
        \Session::flash('flash_message',[
                                        'msg'=>'Cliente deletado com sucesso!',
                                        'class'=>'alert alert-success'
                                        ]);
        return redirect()->route('cliente.detalhe',$telefone->cliente->id);
    }
}
