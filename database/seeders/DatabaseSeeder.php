<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            GradeSeeder::class,
            ClientSeeder::class,
            SchoolSeeder::class,
            CoordinatorSeeder::class,
            ProfessorSeeder::class,
            SubjectSeeder::class,
            GradeClassSeeder::class,
            GradeSubjectSeeder::class,
            CidSeeder::class,
            StudentSeeder::class,
        ]);
    }
}
