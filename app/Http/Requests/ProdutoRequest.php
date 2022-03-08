<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdutoRequest extends FormRequest {

    public function rules() {
        return [
            'nome' => [
                'required', 'string', 'min:3', 'max:255'
            ],
            'preco' => [
                'required', 'numeric', 'min:1', 'max:10000'
            ],
            'descricao' => [
                'required', 'string', 'min:3', 'max:3000'
            ],
            'quantidade' => [
                'required', 'numeric', 'min:1', 'max:500'
            ],
            'imagem' => [
                'required', 'mimes:jpg,png,jpeg,svg'
            ],
            'categoria_id' => [
                'required', 'numeric'
            ],
        ];
    }
}
