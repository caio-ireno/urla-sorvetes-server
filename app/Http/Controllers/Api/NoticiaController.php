<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Noticia;
use GuzzleHttp\Client;



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

    public function show( Noticia $noticia){
        // Retorna os detalhes de uma Noticia específica
        return $noticia;
    }

    public function store(Request $request){
        // Cria uma nova Noticia
        $client = new Client();
        $response = $client->post('https://api.imgbb.com/1/upload', [
            'multipart' => [
                [
                    'name' => 'image',
                    'contents' => fopen($request->file('imgNoticia')->getPathname(), 'r'),
                ],
                [
                    'name' => 'key',
                    'contents' => env('IMGBB_API_KEY'),
                ],
            ],
        ]);
        $data = json_decode($response->getBody(), true);
        $noticia = new Noticia([
            'imgNoticia' => $data['data']['url'],
            'nomeNoticia' => $request->input('nomeNoticia'),
        ]);
        $noticia->save();
        return response()->json(['message' => 'Noticia criada com sucesso!', 'noticia' => $noticia], 201);
    }

    public function update(Request $request,  Noticia $noticia){
        // Atualiza os dados de uma Noticia existente
        if ($request->hasFile('imgNoticia')) {
            $client = new Client();
            $response = $client->post('https://api.imgbb.com/1/upload', [
                'multipart' => [
                    [
                        'name' => 'image',
                        'contents' => fopen($request->file('imgNoticia')->getPathname(), 'r'),
                    ],
                    [
                        'name' => 'key',
                        'contents' => env('IMGBB_API_KEY'),
                    ],
                ],
            ]);
            $data = json_decode($response->getBody(), true);
            $noticia->imgNoticia = $data['data']['url'];
        }
        $noticia->nomeNoticia = $request->input('nomeNoticia');
        $noticia->save();
        return response()->json(['message' => 'Noticia atualizada com sucesso!', 'noticia' => $noticia], 200);
    }

    public function destroy(Noticia $noticia){
        // Exclui uma Noticia existente
        return $noticia ->delete();
    }
}
