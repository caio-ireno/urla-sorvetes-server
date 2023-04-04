<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
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

    public function show(Loja $loja){
        // Retorna os detalhes de uma loja específica
        return $loja;
    }

    public function store(Request $request){
        $file = $request->file('imgLoja');
        // dd($file);
        if ($file) {
           try{ 
            $client = new Client();
            $response = $client->post('https://api.imgbb.com/1/upload', [
                'multipart' => [
                    [
                        'name' => 'image',
                        'contents' => fopen($request->file('imgLoja')->getPathname(), 'r'),
                    ],
                    [
                        'name' => 'key',
                        'contents' => env('IMGBB_API_KEY'),
                    ],
                ],
            ]);
            $data = json_decode($response->getBody(), true);
            $loja = new Loja([
                'imgLoja' => $data['data']['url'],
                'nomeLoja' => $request->input('nomeLoja'),
                'endereço' => $request->input('endereço'),
                'telefone' => $request->input('telefone'),
                'rota' => $request->input('rota'),
            ]);
            $loja->save();
            
            return response()->json(['message' => 'Loja criada com sucesso!', 'loja' => $loja], 201);
        }
            catch(\Exception $e){
                return response()->json(['message' => 'Erro ao criar loja: '.$e->getMessage()], 500);
            }

        }
      
    }

    public function update(Request $request, Loja $loja){
        // Atualiza os dados de uma loja existente
        $loja->update($request ->all());
        return $loja;
    }

    public function destroy(Loja $loja){
        // Exclui uma loja existente
        return $loja ->delete();
    }
}
