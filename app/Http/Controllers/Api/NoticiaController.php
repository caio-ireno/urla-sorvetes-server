<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ImageRequest;

use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Noticia;
use GuzzleHttp\Client;

use App\Http\Requests\ImageResquest;

class NoticiaController extends Controller
{

    private $noticia;

    public function __construct(Noticia $noticia)
    {
        $this->noticia = $noticia;
    }

    public function index()
    {
        // Retorna uma lista de todas as Noticias
        return $this->noticia->get();
    }

    public function show(Noticia $noticia)
    {
        // Retorna os detalhes de uma Noticia específica
        return $noticia;
    }

    public function store(Request $request)
    {
        $file = $request->input('imgNoticia');
        if ($file) {
            //dd($request->input('imgNoticia'));
            try {
                $client = new Client();
                $response = $client->post('https://api.imgbb.com/1/upload', [
                    'multipart' => [
                        [
                            'name' => 'image',
                            'contents' => $request->input('imgNoticia'),
                        ],
                        [
                            'name' => 'key',
                            'contents' => env('IMGBB_API_KEY'),
                        ],
                    ],
                ]);
                //dd($response->getBody());
                $data = json_decode($response->getBody(), true);
                $noticia = new Noticia([
                    'imgNoticia' => $data['data']['url'],
                    'nomeNoticia' => $request->input('nomeNoticia'),
                ]);
                $noticia->save();

                return response()->json(['message' => 'Noticia criada com sucesso!', 'noticia' => $noticia], 201);
            } catch (\Exception $e) {
                return response()->json(['message' => 'Erro ao criar notícia: ' . $e->getMessage()], 500);
            }
        }
    }

    public function update(Request $request, Noticia $noticia)
    {
        $file = $request->input('imgNoticia');
        if ($file) {
            try {
                $client = new Client();
                $response = $client->post('https://api.imgbb.com/1/upload', [
                    'multipart' => [
                        [
                            'name' => 'image',
                            'contents' => $request->input('imgNoticia'),
                        ],
                        [
                            'name' => 'key',
                            'contents' => env('IMGBB_API_KEY'),
                        ],
                    ],
                ]);
                $data = json_decode($response->getBody(), true);
                $noticia->update([
                    'imgNoticia' => $data['data']['url'],
                    'nomeNoticia' => $request->input('nomeNoticia'),
                ]);
                return response()->json(['message' => 'Noticia atualizada com sucesso!', 'noticia' => $noticia], 201);
            } catch (\Exception $e) {
                return response()->json(['message' => 'Erro ao atualizar notícia: ' . $e->getMessage()], 500);
            }
        }
    }

    public function destroy(Noticia $noticia)
    {
        // Exclui uma Noticia existente
        return $noticia->delete();
    }
}