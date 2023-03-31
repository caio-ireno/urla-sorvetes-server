<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Historia;


class HistoriaController extends Controller
{
    private $historia;

    public function __construct(Historia $historia){
        $this -> historia = $historia;
    }

    public function index(){
        // Retorna uma lista de todas as historias
        return $this ->historia->get();
    }

    public function show(Historia $historia){
        // Retorna os detalhes de uma historia específica
        return $historia;
    }

    public function store(Request $request){
        // Cria uma nova historia
        return $this-> historia->create($request ->all()); 
      
    }

    public function update(Request $request, Historia $historia){
        // Atualiza os dados de uma historia existente
        $historia->update($request ->all());
        return $historia;
    }

    public function destroy(Historia $historia){
        // Exclui uma historia existente
        return $historia ->delete();
    }
}
