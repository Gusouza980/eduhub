<?php

namespace Database\Seeders;

use App\Enums\UserRolesEnum;
use App\Models\Coordinator;
use App\Models\School;
use App\Models\User;
use Illuminate\Database\Seeder;

class CoordinatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schools = School::with('client')->get();

        $coordinatorsData = [
            [
                'name' => 'Ana Paula Costa',
                'email' => 'ana.costa@eduhub.com',
                'document' => '111.222.333-44',
                'phone' => '(11) 91234-5678',
                'street' => 'Rua das Acácias',
                'number' => '45',
                'complement' => 'Casa 2',
                'neighborhood' => 'Mooca',
                'city' => 'São Paulo',
                'state' => 'SP',
                'zip_code' => '03104-000',
            ],
            [
                'name' => 'Roberto Lima',
                'email' => 'roberto.lima@eduhub.com',
                'document' => '222.333.444-55',
                'phone' => '(11) 92345-6789',
                'street' => 'Avenida Ibirapuera',
                'number' => '2500',
                'complement' => null,
                'neighborhood' => 'Moema',
                'city' => 'São Paulo',
                'state' => 'SP',
                'zip_code' => '04029-200',
            ],
            [
                'name' => 'Fernanda Souza',
                'email' => 'fernanda.souza@eduhub.com',
                'document' => '333.444.555-66',
                'phone' => '(11) 93456-7890',
                'street' => 'Rua dos Três Irmãos',
                'number' => '800',
                'complement' => 'Apto 52',
                'neighborhood' => 'Vila Progredior',
                'city' => 'São Paulo',
                'state' => 'SP',
                'zip_code' => '05615-010',
            ],
            [
                'name' => 'Juliana Ferreira',
                'email' => 'juliana.ferreira@eduhub.com',
                'document' => '444.555.666-77',
                'phone' => '(11) 94567-8901',
                'street' => 'Rua Cardeal Arcoverde',
                'number' => '1200',
                'complement' => null,
                'neighborhood' => 'Pinheiros',
                'city' => 'São Paulo',
                'state' => 'SP',
                'zip_code' => '05407-001',
            ],
            [
                'name' => 'Marcos Pereira',
                'email' => 'marcos.pereira@eduhub.com',
                'document' => '555.666.777-88',
                'phone' => '(11) 95678-9012',
                'street' => 'Avenida Rebouças',
                'number' => '3500',
                'complement' => 'Conj 101',
                'neighborhood' => 'Pinheiros',
                'city' => 'São Paulo',
                'state' => 'SP',
                'zip_code' => '05401-300',
            ],
            [
                'name' => 'Patrícia Alves',
                'email' => 'patricia.alves@eduhub.com',
                'document' => '666.777.888-99',
                'phone' => '(21) 91234-5678',
                'street' => 'Rua Barata Ribeiro',
                'number' => '600',
                'complement' => 'Apto 803',
                'neighborhood' => 'Copacabana',
                'city' => 'Rio de Janeiro',
                'state' => 'RJ',
                'zip_code' => '22040-001',
            ],
            [
                'name' => 'Ricardo Martins',
                'email' => 'ricardo.martins@eduhub.com',
                'document' => '777.888.999-00',
                'phone' => '(21) 92345-6789',
                'street' => 'Rua Prudente de Morais',
                'number' => '1200',
                'complement' => null,
                'neighborhood' => 'Ipanema',
                'city' => 'Rio de Janeiro',
                'state' => 'RJ',
                'zip_code' => '22420-041',
            ],
            [
                'name' => 'Carla Mendes',
                'email' => 'carla.mendes@eduhub.com',
                'document' => '888.999.000-11',
                'phone' => '(21) 93456-7890',
                'street' => 'Rua São Clemente',
                'number' => '400',
                'complement' => 'Casa 3',
                'neighborhood' => 'Botafogo',
                'city' => 'Rio de Janeiro',
                'state' => 'RJ',
                'zip_code' => '22260-000',
            ],
            [
                'name' => 'Pedro Henrique Silva',
                'email' => 'pedro.silva@eduhub.com',
                'document' => '999.000.111-22',
                'phone' => '(31) 91234-5678',
                'street' => 'Rua dos Tupinambás',
                'number' => '500',
                'complement' => null,
                'neighborhood' => 'Centro',
                'city' => 'Belo Horizonte',
                'state' => 'MG',
                'zip_code' => '30120-070',
            ],
            [
                'name' => 'Luciana Rodrigues',
                'email' => 'luciana.rodrigues@eduhub.com',
                'document' => '000.111.222-33',
                'phone' => '(31) 92345-6789',
                'street' => 'Rua da Bahia',
                'number' => '800',
                'complement' => 'Sala 15',
                'neighborhood' => 'Centro',
                'city' => 'Belo Horizonte',
                'state' => 'MG',
                'zip_code' => '30160-011',
            ],
        ];

        // Distribui coordenadores pelas escolas
        // Escolas 1-4: São Paulo (5 coordenadores: 2, 1, 1, 1)
        // Escolas 5-7: Rio de Janeiro (3 coordenadores: 1, 1, 1)
        // Escolas 8-9: Belo Horizonte (2 coordenadores: 1, 1)

        $schoolCoordinatorMapping = [
            0 => [0, 1], // Escola 1 - 2 coordenadores
            1 => [2],    // Escola 2 - 1 coordenador
            2 => [3],    // Escola 3 - 1 coordenador
            3 => [4],    // Escola 4 - 1 coordenador
            4 => [5],    // Escola 5 - 1 coordenador
            5 => [6],    // Escola 6 - 1 coordenador
            6 => [7],    // Escola 7 - 1 coordenador
            7 => [8],    // Escola 8 - 1 coordenador
            8 => [9],    // Escola 9 - 1 coordenador
        ];

        foreach ($schoolCoordinatorMapping as $schoolIndex => $coordinatorIndices) {
            $school = $schools[$schoolIndex];

            foreach ($coordinatorIndices as $coordinatorIndex) {
                $coordinatorData = $coordinatorsData[$coordinatorIndex];

                // Remove símbolos do documento para usar como senha
                $password = preg_replace('/[^0-9]/', '', $coordinatorData['document']);

                // Cria o usuário
                $user = User::create([
                    'name' => $coordinatorData['name'],
                    'email' => $coordinatorData['email'],
                    'password' => $password,
                    'role' => UserRolesEnum::COORDINATOR,
                ]);

                // Cria o coordenador
                Coordinator::create([
                    'client_id' => $school->client_id,
                    'user_id' => $user->id,
                    'school_id' => $school->id,
                    'street' => $coordinatorData['street'],
                    'number' => $coordinatorData['number'],
                    'complement' => $coordinatorData['complement'],
                    'neighborhood' => $coordinatorData['neighborhood'],
                    'city' => $coordinatorData['city'],
                    'state' => $coordinatorData['state'],
                    'zip_code' => $coordinatorData['zip_code'],
                    'document' => $coordinatorData['document'],
                    'phone' => $coordinatorData['phone'],
                    'is_active' => true,
                ]);
            }
        }
    }
}
