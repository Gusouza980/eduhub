<?php

namespace Database\Factories;

use App\Enums\Student\AutonomyEnum;
use App\Enums\Student\LearningProfileEnum;
use App\Enums\Student\LiteracyStageEnum;
use App\Enums\Student\SocializationEnum;
use App\Enums\Student\StudentShiftEnum;
use App\Enums\Student\SupportLevelEnum;
use App\Enums\Student\VerbalCommunicationEnum;
use App\Models\Client;
use App\Models\Grade;
use App\Models\School;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Nomes brasileiros para estudantes
        $firstNames = [
            'João', 'Maria', 'Pedro', 'Ana', 'Lucas', 'Julia', 'Gabriel', 'Beatriz',
            'Rafael', 'Laura', 'Felipe', 'Isabella', 'Matheus', 'Sophia', 'Bruno',
            'Alice', 'Guilherme', 'Manuela', 'Thiago', 'Valentina', 'Gustavo', 'Helena',
            'Diego', 'Luiza', 'Rodrigo', 'Nicole', 'Leonardo', 'Isadora', 'Daniel', 'Lívia',
        ];

        $lastNames = [
            'Silva', 'Santos', 'Oliveira', 'Souza', 'Lima', 'Costa', 'Ferreira', 'Rodrigues',
            'Almeida', 'Nascimento', 'Pereira', 'Carvalho', 'Ribeiro', 'Martins', 'Araujo',
            'Rocha', 'Mendes', 'Barbosa', 'Cardoso', 'Correia',
        ];

        $firstName = fake()->randomElement($firstNames);
        $lastName = fake()->randomElement($lastNames);
        $middleName = fake()->randomElement($lastNames);

        return [
            'client_id' => Client::inRandomOrder()->first()?->id,
            'full_name' => "{$firstName} {$middleName} {$lastName}",
            'birth_date' => fake()->dateTimeBetween('-12 years', '-5 years'),
            'school_id' => School::inRandomOrder()->first()?->id,
            'grade_id' => Grade::inRandomOrder()->first()?->id,
            'shift' => fake()->randomElement(StudentShiftEnum::cases()),
            'support_level' => fake()->randomElement(SupportLevelEnum::cases()),
            'literacy_stage' => fake()->randomElement(LiteracyStageEnum::cases()),
            'socialization' => fake()->randomElement(SocializationEnum::cases()),
            'verbal_communication' => fake()->randomElement(VerbalCommunicationEnum::cases()),
            'autonomy' => fake()->randomElement(AutonomyEnum::cases()),
            'concentration_time' => fake()->numberBetween(5, 60), // 5 a 60 minutos
            'learning_profile' => fake()->randomElement(LearningProfileEnum::cases()),
            'other_relevant_info' => fake()->optional(0.3)->sentence(10),
        ];
    }

    /**
     * Estado para estudantes com autismo
     */
    public function withAutism(): static
    {
        return $this->state(fn (array $attributes) => [
            'support_level' => fake()->randomElement([
                SupportLevelEnum::Moderate,
                SupportLevelEnum::High,
            ]),
            'verbal_communication' => fake()->randomElement([
                VerbalCommunicationEnum::UsesCoherentWords,
                VerbalCommunicationEnum::DisconnectedSpeech,
                VerbalCommunicationEnum::Averbal,
            ]),
            'socialization' => fake()->randomElement([
                SocializationEnum::FewConflicts,
                SocializationEnum::ManyConflicts,
            ]),
            'concentration_time' => fake()->numberBetween(5, 25),
        ]);
    }

    /**
     * Estado para estudantes com TDAH
     */
    public function withADHD(): static
    {
        return $this->state(fn (array $attributes) => [
            'support_level' => SupportLevelEnum::Low,
            'concentration_time' => fake()->numberBetween(5, 15),
            'autonomy' => fake()->randomElement([
                AutonomyEnum::DoesIfDirected,
                AutonomyEnum::OnlyWithSupport,
            ]),
        ]);
    }

    /**
     * Estado para estudantes com dislexia
     */
    public function withDyslexia(): static
    {
        return $this->state(fn (array $attributes) => [
            'literacy_stage' => fake()->randomElement([
                LiteracyStageEnum::PreSyllabic,
                LiteracyStageEnum::Syllabic,
            ]),
            'support_level' => SupportLevelEnum::Low,
            'learning_profile' => fake()->randomElement([
                LearningProfileEnum::Visual,
                LearningProfileEnum::Kinesthetic,
            ]),
        ]);
    }

    /**
     * Estado para estudantes com suporte baixo
     */
    public function lowSupport(): static
    {
        return $this->state(fn (array $attributes) => [
            'support_level' => SupportLevelEnum::Low,
            'autonomy' => fake()->randomElement([
                AutonomyEnum::DoesAlone,
                AutonomyEnum::DoesIfDirected,
            ]),
            'socialization' => fake()->randomElement([
                SocializationEnum::Normal,
                SocializationEnum::FewConflicts,
            ]),
        ]);
    }

    /**
     * Estado para estudantes com suporte alto
     */
    public function highSupport(): static
    {
        return $this->state(fn (array $attributes) => [
            'support_level' => SupportLevelEnum::High,
            'autonomy' => fake()->randomElement([
                AutonomyEnum::OnlyWithSupport,
                AutonomyEnum::DoesNot,
            ]),
            'concentration_time' => fake()->numberBetween(5, 15),
        ]);
    }
}
