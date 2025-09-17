<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Suppliers;

class SuppliersFactory extends Factory
{
    protected $model = Suppliers::class;

    public function definition(): array
    {
        return [
            'tipo' => $this->faker->randomElement(['F', 'J']),
            'name' => $this->faker->company(),
            'cpf_cnpj' => $this->faker->numerify('##############'),
            'telefone' => $this->faker->numerify('###########'),
            // NÃO coloque type_id
        ];
    }
}
