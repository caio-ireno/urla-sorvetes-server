<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sorvete;

class SorveteController extends Controller{

    private $sorvete;

    public function __construct(Sorvete $sorvete){
        $this -> sorvete = $sorvete;
    }
   
    public function index(){
        return $this ->sorvete::with('sabores')->get();
    }

   
    public function store(Request $request){
        return $this-> sorvete->create($request ->all());
    }

   
    public function show(Sorvete $sorvete){
        return $sorvete;
    }

  
    public function update(Request $request, Sorvete $sorvete){
        $sorvete->update($request ->all());
        return $sorvete;
    }

    public function destroy(Sorvete $sorvete){
        return $sorvete ->delete();
    }
}
