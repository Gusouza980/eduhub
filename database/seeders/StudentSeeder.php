<?php

namespace Database\Seeders;

use App\Models\Cid;
use App\Models\Client;
use App\Models\School;
use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buscar alguns CIDs comuns para vincular aos estudantes
        $autismCids = $this->getAutismCids();
        $adhdCids = $this->getAdhdCids();
        $dyslexiaCids = $this->getDyslexiaCids();
        $downSyndromeCids = $this->getDownSyndromeCids();

        // Para cada escola, criar estudantes
        $schools = School::all();

        foreach ($schools as $school) {
            $client = Client::find($school->client_id);

            // Criar entre 15 e 25 estudantes por escola
            $numberOfStudents = rand(15, 25);

            for ($i = 0; $i < $numberOfStudents; $i++) {
                // Decidir o tipo de perfil do estudante
                $profileType = $this->getRandomProfileType();

                /** @var Student $student */
                $student = match ($profileType) {
                    'autism' => Student::factory()
                        ->withAutism()
                        ->create([
                            'client_id' => $client->id,
                            'school_id' => $school->id,
                        ]),
                    'adhd' => Student::factory()
                        ->withADHD()
                        ->create([
                            'client_id' => $client->id,
                            'school_id' => $school->id,
                        ]),
                    'dyslexia' => Student::factory()
                        ->withDyslexia()
                        ->create([
                            'client_id' => $client->id,
                            'school_id' => $school->id,
                        ]),
                    'low_support' => Student::factory()
                        ->lowSupport()
                        ->create([
                            'client_id' => $client->id,
                            'school_id' => $school->id,
                        ]),
                    'high_support' => Student::factory()
                        ->highSupport()
                        ->create([
                            'client_id' => $client->id,
                            'school_id' => $school->id,
                        ]),
                    default => Student::factory()->create([
                        'client_id' => $client->id,
                        'school_id' => $school->id,
                    ]),
                };

                // Vincular CIDs apropriados ao estudante
                $this->attachCidsToStudent($student, $profileType, [
                    'autism' => $autismCids,
                    'adhd' => $adhdCids,
                    'dyslexia' => $dyslexiaCids,
                    'down' => $downSyndromeCids,
                ]);
            }
        }
    }

    /**
     * Retorna um tipo de perfil aleatório para o estudante
     */
    private function getRandomProfileType(): string
    {
        $profiles = [
            'autism' => 20, // 20% chance
            'adhd' => 15, // 15% chance
            'dyslexia' => 10, // 10% chance
            'low_support' => 25, // 25% chance
            'high_support' => 10, // 10% chance
            'general' => 20, // 20% chance
        ];

        $random = rand(1, 100);
        $cumulative = 0;

        foreach ($profiles as $profile => $percentage) {
            $cumulative += $percentage;
            if ($random <= $cumulative) {
                return $profile;
            }
        }

        return 'general';
    }

    /**
     * Vincula CIDs ao estudante baseado no perfil
     */
    private function attachCidsToStudent(Student $student, string $profileType, array $cidCollections): void
    {
        $cidsToAttach = [];

        switch ($profileType) {
            case 'autism':
                // 1-2 CIDs de autismo
                $cidsToAttach = $cidCollections['autism']->random(rand(1, min(2, $cidCollections['autism']->count())));
                break;

            case 'adhd':
                // 1 CID de TDAH
                $cidsToAttach = $cidCollections['adhd']->random(1);
                break;

            case 'dyslexia':
                // 1 CID de dislexia
                $cidsToAttach = $cidCollections['dyslexia']->random(1);
                break;

            case 'down':
                // 1 CID de síndrome de Down
                $cidsToAttach = $cidCollections['down']->random(1);
                break;

            default:
                // Para outros perfis, pode não ter CID ou ter 1 aleatório
                if (rand(1, 100) <= 30) { // 30% chance de ter um CID
                    $allCids = $cidCollections['autism']
                        ->concat($cidCollections['adhd'])
                        ->concat($cidCollections['dyslexia']);

                    if ($allCids->isNotEmpty()) {
                        $cidsToAttach = $allCids->random(1);
                    }
                }
                break;
        }

        if (! empty($cidsToAttach)) {
            $student->cids()->attach($cidsToAttach->pluck('id')->toArray());
        }
    }

    /**
     * Busca CIDs relacionados ao autismo
     */
    private function getAutismCids()
    {
        return Cid::where('code', 'LIKE', 'F84%')
            ->orWhere('name', 'LIKE', '%autis%')
            ->get();
    }

    /**
     * Busca CIDs relacionados ao TDAH
     */
    private function getAdhdCids()
    {
        return Cid::where('code', 'LIKE', 'F90%')
            ->orWhere('name', 'LIKE', '%hiperatividade%')
            ->orWhere('name', 'LIKE', '%atenção%')
            ->get();
    }

    /**
     * Busca CIDs relacionados à dislexia
     */
    private function getDyslexiaCids()
    {
        return Cid::where('code', 'LIKE', 'F81%')
            ->orWhere('name', 'LIKE', '%dislexia%')
            ->orWhere('name', 'LIKE', '%leitura%')
            ->get();
    }

    /**
     * Busca CIDs relacionados à síndrome de Down
     */
    private function getDownSyndromeCids()
    {
        return Cid::where('code', 'LIKE', 'Q90%')
            ->orWhere('name', 'LIKE', '%down%')
            ->get();
    }
}
