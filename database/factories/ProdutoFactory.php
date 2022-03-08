<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produto>
 */
class ProdutoFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition() {
        return [
            'nome' => $this->faker->name(),
            'preco' => $this->faker->numberBetween(1, 50),
            'descricao' => $this->faker->text(),
            'quantidade' => $this->faker->numberBetween(1, 10),
            'imagem' => '',
            'categoria_id' => $this->faker->unique()->numberBetween(1, 10)
        ];
    }
}
