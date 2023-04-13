<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sabores;
use App\Models\Sorvete;
use GuzzleHttp\Client;


class SaboresController extends Controller
{

    private $sabores;

    public function __construct(Sabores $sabores)
    {
        $this->sabores = $sabores;
    }

    public function index(Sorvete $sorvete = null)
    {
        if ($sorvete) {
            return $sorvete->sabores()->paginate(10);
        } else {
            return Sabores::paginate(10);
        }
    }

    public function store(Request $request)
    {
        $file = $request->input('imagem');
        if ($file) {
            //dd($request->input('imagem'));
            try {
                $client = new Client();
                $response = $client->post('https://api.imgbb.com/1/upload', [
                    'multipart' => [
                        [
                            'name' => 'image',
                            'contents' => $request->input('imagem'),
                        ],
                        [
                            'name' => 'key',
                            'contents' => env('IMGBB_API_KEY'),
                        ],
                    ],
                ]);
                //dd($response->getBody());
                $data = json_decode($response->getBody(), true);

                $sabores = new Sabores([
                    'imagem' => $data['data']['url'],
                    'nome' => $request->input('nome'),
                    'descricao' => $request->input('descricao'),
                    'sorvete_id' => $request->input('sorvete_id'),
                ]);
                $sabores->save();

                return response()->json(['message' => 'Sabores criada com sucesso!', 'Sabores' => $sabores], 201);
            } catch (\Exception $e) {
                return response()->json(['message' => 'Erro ao criar sabores: ' . $e->getMessage()], 500);
            }
        }
    }

    public function update(Request $request, Sabores $sabores, $id)
    {
        $sabores = Sabores::find($id);
        if (!$sabores) {
            return response()->json(['message' => 'Registro não encontrado'], 404);
        }
        $file = $request->input('imagem');
        if ($file) {
            try {
                $client = new Client();
                $response = $client->post('https://api.imgbb.com/1/upload', [
                    'multipart' => [
                        [
                            'name' => 'image',
                            'contents' => $request->input('imagem'),
                        ],
                        [
                            'name' => 'key',
                            'contents' => env('IMGBB_API_KEY'),
                        ],
                    ],
                ]);
                $data = json_decode($response->getBody(), true);
                $sabores->update([
                    'imagem' => $data['data']['url'],
                    'nome' => $request->input('nome'),
                    'descricao' => $request->input('descricao'),
                    'sorvete_id' => $request->input('sorvete_id'),
                ]);
                return response()->json(['message' => 'Imagem Sabor atualizada com sucesso!', 'Sabores' => $sabores], 201)->header('Cache-Control', 'no-cache');

            } catch (\Exception $e) {
                return response()->json(['message' => 'Erro ao atualizar sabor: ' . $e->getMessage()], 500);
            }
        }

    }

    public function show($id)
    {
        $sabores = Sabores::find($id);

        if (!$sabores) {
            return response()->json(['message' => 'Sabor não encontrado'], 404);
        }

        return response()->json($sabores, 200);
    }

    public function destroy($id)
    {
        $sabores = Sabores::findOrFail($id);
        return $sabores->delete();
    }
}