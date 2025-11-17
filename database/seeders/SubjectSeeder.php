<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients = Client::with('schools')->get();

        // Disciplinas comuns do ensino básico brasileiro
        $subjects = [
            // Educação Infantil
            'infantil' => [
                'Linguagem Oral e Escrita',
                'Matemática',
                'Natureza e Sociedade',
                'Artes',
                'Música',
                'Educação Física',
            ],
            // Ensino Fundamental I (1º ao 5º ano)
            'fundamental_i' => [
                'Língua Portuguesa',
                'Matemática',
                'Ciências',
                'História',
                'Geografia',
                'Artes',
                'Educação Física',
                'Inglês',
            ],
            // Ensino Fundamental II (6º ao 9º ano)
            'fundamental_ii' => [
                'Língua Portuguesa',
                'Matemática',
                'Ciências',
                'História',
                'Geografia',
                'Artes',
                'Educação Física',
                'Inglês',
                'Ensino Religioso',
            ],
            // Ensino Médio
            'medio' => [
                'Língua Portuguesa',
                'Literatura',
                'Matemática',
                'Física',
                'Química',
                'Biologia',
                'História',
                'Geografia',
                'Filosofia',
                'Sociologia',
                'Artes',
                'Educação Física',
                'Inglês',
                'Espanhol',
            ],
        ];

        // Para cada cliente, analisa as escolas dele para determinar quais disciplinas criar
        foreach ($clients as $client) {
            $subjectsToCreate = [];

            // Analisa o grade_flow de todas as escolas do cliente
            foreach ($client->schools as $school) {
                $gradeFlow = $school->grade_flow ?? [];

                // Determina quais disciplinas são necessárias baseado no grade_flow
                $hasInfantil = ! empty(array_filter($gradeFlow, function ($grade) {
                    return stripos($grade, 'maternal') !== false ||
                           stripos($grade, 'pré') !== false;
                }));

                $hasFundamentalI = ! empty(array_filter($gradeFlow, function ($grade) {
                    return preg_match('/[1-5]º\s*ano/i', $grade);
                }));

                $hasFundamentalII = ! empty(array_filter($gradeFlow, function ($grade) {
                    return preg_match('/[6-9]º\s*ano/i', $grade);
                }));

                $hasMedio = ! empty(array_filter($gradeFlow, function ($grade) {
                    return stripos($grade, 'EM') !== false ||
                           preg_match('/[1-3]º\s*(ano\s*)?EM/i', $grade);
                }));

                // Adiciona disciplinas baseadas no tipo de ensino
                if ($hasInfantil) {
                    $subjectsToCreate = array_merge($subjectsToCreate, $subjects['infantil']);
                }
                if ($hasFundamentalI) {
                    $subjectsToCreate = array_merge($subjectsToCreate, $subjects['fundamental_i']);
                }
                if ($hasFundamentalII) {
                    $subjectsToCreate = array_merge($subjectsToCreate, $subjects['fundamental_ii']);
                }
                if ($hasMedio) {
                    $subjectsToCreate = array_merge($subjectsToCreate, $subjects['medio']);
                }
            }

            // Remove duplicatas
            $subjectsToCreate = array_unique($subjectsToCreate);

            // Cria as disciplinas para o cliente
            foreach ($subjectsToCreate as $subjectName) {
                Subject::create([
                    'client_id' => $client->id,
                    'name' => $subjectName,
                    'is_active' => true,
                ]);
            }
        }
    }
}
