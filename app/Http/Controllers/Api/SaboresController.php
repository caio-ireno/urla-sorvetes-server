<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sabores;
use App\Models\Sorvete;


class SaboresController extends Controller{

    private $sabores;

    public function __construct(Sabores $sabores){
        $this -> sabores = $sabores;
    }
   
    public function index(Sorvete $sorvete = null){
    if ($sorvete) {
        return $sorvete->sabores;
    } else {
        return Sabores::all();
    }
}

   
    public function store(Request $request)
    {
        return $this-> sabores->create($request ->all());
    }

   
    public function show($id)
    {
        $sabores = Sabores::find($id);
    
        if (!$sabores) {
            return response()->json(['message' => 'Sabor não encontrado'], 404);
        }
    
        return response()->json($sabores, 200);
    }

  
    public function update(Request $request, $id)
    {
        $sabores = Sabores::findOrFail($id);
        $sabores->update($request->all());
        return $sabores;
    }

    public function destroy($id)
    {
        $sabores = Sabores::findOrFail($id);
        return $sabores->delete();
    }
}
