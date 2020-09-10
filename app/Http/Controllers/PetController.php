<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function adicionar($id)
    {
        $cliente = \App\Cliente::find($id);
        return view('pet.adicionar', compact('cliente'));
    }
    
    public function salvar(\App\Http\Requests\PetRequest $request, $id)
    {
        $cliente = \App\Cliente::find($id);
        $pet = new \App\Pet;
        $pet->nome = $request->input('nome');
        $pet->raca = $request->input('raca');
        $pet->porte = $request->input('porte');
        
        \App\Cliente::find($id)->addPet($pet);
        
        \Session::flash('flash_message',[
                                            'msg'=>'Pet Adicionado!',
                                            'class'=>'alert alert-success'
                                            ]);
        
        return redirect()->route('cliente.detalhe', $id);
    }
    
    public function atualizar(\App\Http\Requests\PetRequest $request,$id)
    {
        $pet = \App\Pet::find($id);
        $pet->update($request->all());
        \Session::flash('flash_message',[
                                        'msg'=>'Pet atualizado com sucesso!',
                                        'class'=>'alert alert-success'
                                        ]);
        return redirect()->route('cliente.index', $pet->cliente->id);
    }
    
    public function editar($id)
    {
        $pet = \App\Pet::find($id);
        if(!$pet)
        {
            \Session::flash('flash_message',[
                                            'msg'=>'Pet não cadastrado',
                                            'class'=>'alert alert-danger'
                                            ]);
            return redirect()->route('cliente.detalhe', $pet->cliente->id);
        }
        return view('pet.editar',compact('pet'));
    }
    
    public function deletar($id)
    {
        $pet = \App\Pet::find($id);
        $pet->delete();
        
        \Session::flash('flash_message',[
                                        'msg'=>'Cliente deletado com sucesso!',
                                        'class'=>'alert alert-success'
                                        ]);
        return redirect()->route('cliente.detalhe',$pet->cliente->id);
    }
}
