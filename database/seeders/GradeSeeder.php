<?php

namespace Database\Seeders;

use App\Models\Grade;
use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Grades universais do sistema brasileiro de ensino
        // Serão usadas por todos os clientes/escolas
        $grades = [
            // Educação Infantil
            'Maternal',
            'Pré I',
            'Pré II',

            // Ensino Fundamental I (1º ao 5º ano)
            '1º Ano',
            '2º Ano',
            '3º Ano',
            '4º Ano',
            '5º Ano',

            // Ensino Fundamental II (6º ao 9º ano)
            '6º Ano',
            '7º Ano',
            '8º Ano',
            '9º Ano',

            // Ensino Médio
            '1º Ano EM',
            '2º Ano EM',
            '3º Ano EM',
        ];

        // Cria as grades universais
        foreach ($grades as $gradeName) {
            Grade::create([
                'name' => $gradeName,
                'is_active' => true,
            ]);
        }
    }
}
