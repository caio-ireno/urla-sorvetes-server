<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Loja;


class LojaController extends Controller
{

    private $loja;

    public function __construct(Loja $loja){
        $this -> loja = $loja;
    }

    public function index(){
        // Retorna uma lista de todas as lojas
        return $this ->loja->get();
    }

    public function show($id){
        // Retorna os detalhes de uma loja específica
        return $loja;
    }

    public function store(Request $request){
        // Cria uma nova loja
        return $this-> loja->create($request ->all()); 
      
    }

    public function update(Request $request, $id){
        // Atualiza os dados de uma loja existente
        $loja->update($request ->all());
        return $loja;
    }

    public function destroy($id){
        // Exclui uma loja existente
        return $loja ->delete();
    }
}
