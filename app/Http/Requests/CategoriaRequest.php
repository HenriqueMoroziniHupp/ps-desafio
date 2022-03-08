<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoriaRequest extends FormRequest {

    public function rules() {
        return [
            'categoria' => [
                'required', 'string', 'min:3', 'max:255'
            ],
        ];
    }
}
