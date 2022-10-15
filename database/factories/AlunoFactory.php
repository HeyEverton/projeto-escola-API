<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Aluno>
 */
class AlunoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nome' => $this->faker->name,
            'aluno_foto' => Uuid::uuid6() . '.jpg',
            'cpf_aluno' => fake()->randomNumber(5, true),
            'email' => fake()->unique()->safeEmail(),
            'sexo' => 'M',
            'nacionalidade' => 'BR',
            'escolaridade' => 'MC',
            'data_nasc' => $this->faker->date('Y-m-d'),
            'observacao' => $this->faker->name,
            'whatsapp' => '868776876',
            'tel_contato' => '8356873684',
            'nome_rua' => $this->faker->name,
            'numero_residencia' => '123',
            'cep' => $this->faker->postcode(),
            'bairro' => $this->faker->name,
            'estado' => 'SP',
            'cidade' => $this->faker->name,
        ];
    }
}
