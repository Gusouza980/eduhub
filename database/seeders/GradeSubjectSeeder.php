<?php

namespace Database\Seeders;

use App\Models\Grade;
use App\Models\GradeSubject;
use App\Models\School;
use Illuminate\Database\Seeder;

class GradeSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schools = School::with('client.subjects')->get();
        $grades = Grade::all();

        // Para cada escola, associa as disciplinas do cliente com as grades do grade_flow
        foreach ($schools as $school) {
            $gradeFlow = $school->grade_flow ?? [];
            $subjects = $school->client->subjects;

            foreach ($grades as $grade) {
                // Verifica se a grade está no grade_flow da escola
                if (in_array($grade->name, $gradeFlow)) {
                    $gradeName = strtolower($grade->name);

                    // Filtra disciplinas apropriadas para cada série
                    foreach ($subjects as $subject) {
                        $shouldAddSubject = false;
                        $subjectName = strtolower($subject->name);

                        // Educação Infantil
                        if (stripos($gradeName, 'maternal') !== false || stripos($gradeName, 'pré') !== false) {
                            $infantilSubjects = ['linguagem', 'matemática', 'natureza', 'artes', 'música', 'educação física'];
                            foreach ($infantilSubjects as $inf) {
                                if (stripos($subjectName, $inf) !== false) {
                                    $shouldAddSubject = true;
                                    break;
                                }
                            }
                        }
                        // Fundamental I (1º ao 5º ano)
                        elseif (preg_match('/[1-5]º\s*ano/i', $gradeName)) {
                            $fundISubjects = ['português', 'matemática', 'ciências', 'história', 'geografia', 'artes', 'educação física', 'inglês'];
                            foreach ($fundISubjects as $fund) {
                                if (stripos($subjectName, $fund) !== false) {
                                    $shouldAddSubject = true;
                                    break;
                                }
                            }
                        }
                        // Fundamental II (6º ao 9º ano)
                        elseif (preg_match('/[6-9]º\s*ano/i', $gradeName)) {
                            $fundIISubjects = ['português', 'matemática', 'ciências', 'história', 'geografia', 'artes', 'educação física', 'inglês', 'religioso'];
                            foreach ($fundIISubjects as $fund) {
                                if (stripos($subjectName, $fund) !== false) {
                                    $shouldAddSubject = true;
                                    break;
                                }
                            }
                        }
                        // Ensino Médio
                        elseif (stripos($gradeName, 'EM') !== false) {
                            // Todas as disciplinas do ensino médio
                            $shouldAddSubject = true;
                        }

                        if ($shouldAddSubject) {
                            GradeSubject::create([
                                'school_id' => $school->id,
                                'grade_id' => $grade->id,
                                'subject_id' => $subject->id,
                                'is_active' => true,
                            ]);
                        }
                    }
                }
            }
        }
    }
}
