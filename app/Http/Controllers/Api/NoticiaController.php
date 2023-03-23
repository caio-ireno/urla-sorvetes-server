<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Noticia;


class NoticiaController extends Controller
{

    private $noticia;

    public function __construct(Noticia $noticia){
        $this -> noticia = $noticia;
    }

    public function index(){
        // Retorna uma lista de todas as Noticias
        return $this ->noticia->get();
    }

    public function show($id){
        // Retorna os detalhes de uma Noticia específica
        return $noticia;
    }

    public function store(Request $request){
        // Cria uma nova Noticia
        return $this-> noticia->create($request ->all()); 
    }

    public function update(Request $request, $id){
        // Atualiza os dados de uma Noticia existente
        $noticia->update($request ->all());
        return $noticia;
    }

    public function destroy($id){
        // Exclui uma Noticia existente
        return $noticia ->delete();
    }
}
