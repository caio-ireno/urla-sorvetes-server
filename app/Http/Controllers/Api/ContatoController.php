<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contato;
use Illuminate\Http\Request;

class ContatoController extends Controller
{
    private $contato;

    public function __construct(Contato $contato){
        $this -> contato = $contato;
    }

    public function index(){
        // Retorna uma lista de todas as contatos
        return $this ->contato->get();
    }

    public function show(Contato $contato){
        // Retorna os detalhes de uma contato específica
        return $contato;
    }

    public function store(Request $request)
    {
        return $this-> contato->create($request ->all()); 
    
    }

    public function update(Request $request, Contato $contato)
    {
        $contato->update($request ->all());
        return $contato;
    }
    
    
    public function destroy(Contato $contato){
        // Exclui uma contato existente
        return $contato ->delete();
    }
        //
    
}
