<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SorveteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'imagem' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'nome' => 'required|string',
            'descricao' => 'required|string',
            'sorvete_id' => 'required|string',
        ];
    }
}
