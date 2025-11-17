<?php

namespace Database\Seeders;

use App\Enums\Student\StudentShiftEnum;
use App\Models\Grade;
use App\Models\GradeClass;
use App\Models\School;
use Illuminate\Database\Seeder;

class GradeClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schools = School::all();
        $grades = Grade::all();
        $currentYear = date('Y');

        // Turmas (A, B, C)
        $classNames = ['A', 'B', 'C'];

        // Turnos disponíveis
        $shifts = [
            StudentShiftEnum::Morning,
            StudentShiftEnum::Afternoon,
        ];

        // Para cada escola, cria turmas para as grades do seu grade_flow
        foreach ($schools as $school) {
            $gradeFlow = $school->grade_flow ?? [];

            foreach ($grades as $grade) {
                // Verifica se a grade está no grade_flow da escola
                if (in_array($grade->name, $gradeFlow)) {
                    // Determina quantas turmas criar baseado no tamanho da escola
                    // Escolas maiores terão mais turmas
                    $numClasses = rand(1, 3);

                    for ($i = 0; $i < $numClasses; $i++) {
                        // Alterna entre turnos: turmas pares manhã, ímpares tarde
                        $shift = $shifts[$i % 2];

                        GradeClass::create([
                            'school_id' => $school->id,
                            'grade_id' => $grade->id,
                            'name' => $classNames[$i],
                            'year' => $currentYear,
                            'shift' => $shift,
                            'is_active' => true,
                        ]);
                    }
                }
            }
        }
    }
}
