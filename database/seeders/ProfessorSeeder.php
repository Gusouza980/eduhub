<?php

namespace Database\Seeders;

use App\Enums\UserRolesEnum;
use App\Models\Professor;
use App\Models\School;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProfessorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schools = School::with('client')->get();

        $professorsData = [
            // Professores para São Paulo
            [
                'name' => 'Lucas Andrade',
                'email' => 'lucas.andrade@eduhub.com',
                'document' => '101.202.303-40',
                'phone' => '(11) 96789-0123',
                'street' => 'Rua Vergueiro',
                'number' => '1500',
                'complement' => 'Apto 201',
                'neighborhood' => 'Paraíso',
                'city' => 'São Paulo',
                'state' => 'SP',
                'zip_code' => '04101-000',
            ],
            [
                'name' => 'Mariana Oliveira',
                'email' => 'mariana.oliveira@eduhub.com',
                'document' => '202.303.404-50',
                'phone' => '(11) 97890-1234',
                'street' => 'Avenida Brigadeiro Luís Antônio',
                'number' => '2000',
                'complement' => null,
                'neighborhood' => 'Bela Vista',
                'city' => 'São Paulo',
                'state' => 'SP',
                'zip_code' => '01318-000',
            ],
            [
                'name' => 'Felipe Santos',
                'email' => 'felipe.santos@eduhub.com',
                'document' => '303.404.505-60',
                'phone' => '(11) 98901-2345',
                'street' => 'Rua Frei Caneca',
                'number' => '800',
                'complement' => 'Conj 45',
                'neighborhood' => 'Consolação',
                'city' => 'São Paulo',
                'state' => 'SP',
                'zip_code' => '01307-002',
            ],
            [
                'name' => 'Beatriz Costa',
                'email' => 'beatriz.costa@eduhub.com',
                'document' => '404.505.606-70',
                'phone' => '(11) 99012-3456',
                'street' => 'Alameda Santos',
                'number' => '1000',
                'complement' => null,
                'neighborhood' => 'Jardins',
                'city' => 'São Paulo',
                'state' => 'SP',
                'zip_code' => '01418-100',
            ],
            [
                'name' => 'Rafael Lima',
                'email' => 'rafael.lima@eduhub.com',
                'document' => '505.606.707-80',
                'phone' => '(11) 99123-4567',
                'street' => 'Rua Haddock Lobo',
                'number' => '600',
                'complement' => 'Apto 72',
                'neighborhood' => 'Cerqueira César',
                'city' => 'São Paulo',
                'state' => 'SP',
                'zip_code' => '01414-000',
            ],
            [
                'name' => 'Amanda Silva',
                'email' => 'amanda.silva@eduhub.com',
                'document' => '606.707.808-90',
                'phone' => '(11) 99234-5678',
                'street' => 'Avenida Angélica',
                'number' => '2500',
                'complement' => null,
                'neighborhood' => 'Consolação',
                'city' => 'São Paulo',
                'state' => 'SP',
                'zip_code' => '01228-200',
            ],
            [
                'name' => 'Bruno Ferreira',
                'email' => 'bruno.ferreira@eduhub.com',
                'document' => '707.808.909-01',
                'phone' => '(11) 99345-6789',
                'street' => 'Rua Oscar Freire',
                'number' => '1200',
                'complement' => 'Loja 3',
                'neighborhood' => 'Pinheiros',
                'city' => 'São Paulo',
                'state' => 'SP',
                'zip_code' => '05409-010',
            ],
            [
                'name' => 'Carolina Mendes',
                'email' => 'carolina.mendes@eduhub.com',
                'document' => '808.909.010-11',
                'phone' => '(11) 99456-7890',
                'street' => 'Rua Girassol',
                'number' => '400',
                'complement' => null,
                'neighborhood' => 'Vila Madalena',
                'city' => 'São Paulo',
                'state' => 'SP',
                'zip_code' => '05433-000',
            ],
            [
                'name' => 'Diego Alves',
                'email' => 'diego.alves@eduhub.com',
                'document' => '909.010.111-22',
                'phone' => '(11) 99567-8901',
                'street' => 'Rua Aspicuelta',
                'number' => '300',
                'complement' => 'Casa 1',
                'neighborhood' => 'Vila Madalena',
                'city' => 'São Paulo',
                'state' => 'SP',
                'zip_code' => '05433-010',
            ],
            [
                'name' => 'Elaine Rodrigues',
                'email' => 'elaine.rodrigues@eduhub.com',
                'document' => '010.111.222-33',
                'phone' => '(11) 99678-9012',
                'street' => 'Rua Harmonia',
                'number' => '800',
                'complement' => 'Apto 91',
                'neighborhood' => 'Vila Madalena',
                'city' => 'São Paulo',
                'state' => 'SP',
                'zip_code' => '05435-000',
            ],
            [
                'name' => 'Fábio Souza',
                'email' => 'fabio.souza@eduhub.com',
                'document' => '111.222.333-45',
                'phone' => '(11) 99789-0123',
                'street' => 'Rua Mourato Coelho',
                'number' => '1500',
                'complement' => null,
                'neighborhood' => 'Pinheiros',
                'city' => 'São Paulo',
                'state' => 'SP',
                'zip_code' => '05417-010',
            ],
            [
                'name' => 'Gabriela Costa',
                'email' => 'gabriela.costa@eduhub.com',
                'document' => '212.323.434-56',
                'phone' => '(11) 99890-1234',
                'street' => 'Rua Teodoro Sampaio',
                'number' => '2000',
                'complement' => 'Sala 105',
                'neighborhood' => 'Pinheiros',
                'city' => 'São Paulo',
                'state' => 'SP',
                'zip_code' => '05405-000',
            ],
            [
                'name' => 'Henrique Lima',
                'email' => 'henrique.lima@eduhub.com',
                'document' => '313.434.545-67',
                'phone' => '(11) 99901-2345',
                'street' => 'Alameda Jaú',
                'number' => '1200',
                'complement' => null,
                'neighborhood' => 'Jardim Paulista',
                'city' => 'São Paulo',
                'state' => 'SP',
                'zip_code' => '01420-001',
            ],
            [
                'name' => 'Isabela Martins',
                'email' => 'isabela.martins@eduhub.com',
                'document' => '414.545.656-78',
                'phone' => '(11) 99012-3457',
                'street' => 'Rua Bela Cintra',
                'number' => '1000',
                'complement' => 'Apto 34',
                'neighborhood' => 'Consolação',
                'city' => 'São Paulo',
                'state' => 'SP',
                'zip_code' => '01415-000',
            ],
            // Professores para Rio de Janeiro
            [
                'name' => 'Jorge Nascimento',
                'email' => 'jorge.nascimento@eduhub.com',
                'document' => '515.656.767-89',
                'phone' => '(21) 96789-0123',
                'street' => 'Rua Duvivier',
                'number' => '50',
                'complement' => null,
                'neighborhood' => 'Copacabana',
                'city' => 'Rio de Janeiro',
                'state' => 'RJ',
                'zip_code' => '22020-020',
            ],
            [
                'name' => 'Kátia Pereira',
                'email' => 'katia.pereira@eduhub.com',
                'document' => '616.767.878-90',
                'phone' => '(21) 97890-1234',
                'street' => 'Avenida Vieira Souto',
                'number' => '100',
                'complement' => 'Cobertura',
                'neighborhood' => 'Ipanema',
                'city' => 'Rio de Janeiro',
                'state' => 'RJ',
                'zip_code' => '22420-000',
            ],
            [
                'name' => 'Leonardo Barbosa',
                'email' => 'leonardo.barbosa@eduhub.com',
                'document' => '717.878.989-01',
                'phone' => '(21) 98901-2345',
                'street' => 'Rua Farme de Amoedo',
                'number' => '300',
                'complement' => 'Apto 501',
                'neighborhood' => 'Ipanema',
                'city' => 'Rio de Janeiro',
                'state' => 'RJ',
                'zip_code' => '22420-020',
            ],
            [
                'name' => 'Mônica Carvalho',
                'email' => 'monica.carvalho@eduhub.com',
                'document' => '818.989.090-12',
                'phone' => '(21) 99012-3456',
                'street' => 'Rua Garcia D\'Ávila',
                'number' => '200',
                'complement' => null,
                'neighborhood' => 'Ipanema',
                'city' => 'Rio de Janeiro',
                'state' => 'RJ',
                'zip_code' => '22421-010',
            ],
            [
                'name' => 'Natália Ferreira',
                'email' => 'natalia.ferreira@eduhub.com',
                'document' => '919.090.101-23',
                'phone' => '(21) 99123-4567',
                'street' => 'Rua Ministro Alfredo Valadão',
                'number' => '50',
                'complement' => 'Casa 2',
                'neighborhood' => 'Copacabana',
                'city' => 'Rio de Janeiro',
                'state' => 'RJ',
                'zip_code' => '22021-000',
            ],
            [
                'name' => 'Otávio Silva',
                'email' => 'otavio.silva@eduhub.com',
                'document' => '020.101.212-34',
                'phone' => '(21) 99234-5678',
                'street' => 'Rua República do Peru',
                'number' => '300',
                'complement' => null,
                'neighborhood' => 'Copacabana',
                'city' => 'Rio de Janeiro',
                'state' => 'RJ',
                'zip_code' => '22021-040',
            ],
            [
                'name' => 'Paula Santos',
                'email' => 'paula.santos@eduhub.com',
                'document' => '121.212.323-45',
                'phone' => '(21) 99345-6789',
                'street' => 'Rua General Artigas',
                'number' => '100',
                'complement' => 'Apto 1002',
                'neighborhood' => 'Leblon',
                'city' => 'Rio de Janeiro',
                'state' => 'RJ',
                'zip_code' => '22441-050',
            ],
            [
                'name' => 'Quirino Almeida',
                'email' => 'quirino.almeida@eduhub.com',
                'document' => '222.323.434-56',
                'phone' => '(21) 99456-7890',
                'street' => 'Rua Bambina',
                'number' => '150',
                'complement' => null,
                'neighborhood' => 'Botafogo',
                'city' => 'Rio de Janeiro',
                'state' => 'RJ',
                'zip_code' => '22251-050',
            ],
            [
                'name' => 'Renata Oliveira',
                'email' => 'renata.oliveira@eduhub.com',
                'document' => '323.434.545-67',
                'phone' => '(21) 99567-8901',
                'street' => 'Rua General Polidoro',
                'number' => '200',
                'complement' => 'Casa 5',
                'neighborhood' => 'Botafogo',
                'city' => 'Rio de Janeiro',
                'state' => 'RJ',
                'zip_code' => '22280-001',
            ],
            [
                'name' => 'Sérgio Costa',
                'email' => 'sergio.costa@eduhub.com',
                'document' => '424.545.656-78',
                'phone' => '(21) 99678-9012',
                'street' => 'Rua Real Grandeza',
                'number' => '400',
                'complement' => 'Apto 203',
                'neighborhood' => 'Botafogo',
                'city' => 'Rio de Janeiro',
                'state' => 'RJ',
                'zip_code' => '22281-030',
            ],
            // Professores para Belo Horizonte
            [
                'name' => 'Tânia Rodrigues',
                'email' => 'tania.rodrigues@eduhub.com',
                'document' => '525.656.767-89',
                'phone' => '(31) 96789-0123',
                'street' => 'Avenida Amazonas',
                'number' => '1500',
                'complement' => null,
                'neighborhood' => 'Centro',
                'city' => 'Belo Horizonte',
                'state' => 'MG',
                'zip_code' => '30180-001',
            ],
            [
                'name' => 'Ulisses Mendes',
                'email' => 'ulisses.mendes@eduhub.com',
                'document' => '626.767.878-90',
                'phone' => '(31) 97890-1234',
                'street' => 'Rua Espírito Santo',
                'number' => '800',
                'complement' => 'Sala 301',
                'neighborhood' => 'Centro',
                'city' => 'Belo Horizonte',
                'state' => 'MG',
                'zip_code' => '30160-030',
            ],
            [
                'name' => 'Valéria Lima',
                'email' => 'valeria.lima@eduhub.com',
                'document' => '727.878.989-01',
                'phone' => '(31) 98901-2345',
                'street' => 'Rua Tamoios',
                'number' => '300',
                'complement' => null,
                'neighborhood' => 'Centro',
                'city' => 'Belo Horizonte',
                'state' => 'MG',
                'zip_code' => '30120-050',
            ],
            [
                'name' => 'Wagner Santos',
                'email' => 'wagner.santos@eduhub.com',
                'document' => '828.989.090-12',
                'phone' => '(31) 99012-3456',
                'street' => 'Avenida Bias Fortes',
                'number' => '500',
                'complement' => 'Apto 405',
                'neighborhood' => 'Lourdes',
                'city' => 'Belo Horizonte',
                'state' => 'MG',
                'zip_code' => '30170-010',
            ],
            [
                'name' => 'Xuxa Pereira',
                'email' => 'xuxa.pereira@eduhub.com',
                'document' => '929.090.101-23',
                'phone' => '(31) 99123-4567',
                'street' => 'Rua Paraíba',
                'number' => '1200',
                'complement' => null,
                'neighborhood' => 'Savassi',
                'city' => 'Belo Horizonte',
                'state' => 'MG',
                'zip_code' => '30130-141',
            ],
            [
                'name' => 'Yuri Oliveira',
                'email' => 'yuri.oliveira@eduhub.com',
                'document' => '030.101.212-34',
                'phone' => '(31) 99234-5678',
                'street' => 'Rua Pernambuco',
                'number' => '800',
                'complement' => 'Conj 12',
                'neighborhood' => 'Savassi',
                'city' => 'Belo Horizonte',
                'state' => 'MG',
                'zip_code' => '30130-150',
            ],
            [
                'name' => 'Zilda Martins',
                'email' => 'zilda.martins@eduhub.com',
                'document' => '131.212.323-45',
                'phone' => '(31) 99345-6789',
                'street' => 'Avenida Getúlio Vargas',
                'number' => '2000',
                'complement' => null,
                'neighborhood' => 'Savassi',
                'city' => 'Belo Horizonte',
                'state' => 'MG',
                'zip_code' => '30112-020',
            ],
        ];

        // Distribui professores pelas escolas
        // 4 escolas SP: 4, 3, 4, 3 professores = 14 professores
        // 3 escolas RJ: 4, 3, 3 professores = 10 professores
        // 2 escolas MG: 4, 3 professores = 7 professores

        $schoolProfessorMapping = [
            0 => [0, 1, 2, 3],          // Escola 1 SP - 4 professores
            1 => [4, 5, 6],             // Escola 2 SP - 3 professores
            2 => [7, 8, 9, 10],         // Escola 3 SP - 4 professores
            3 => [11, 12, 13],          // Escola 4 SP - 3 professores
            4 => [14, 15, 16, 17],      // Escola 5 RJ - 4 professores
            5 => [18, 19, 20],          // Escola 6 RJ - 3 professores
            6 => [21, 22, 23],          // Escola 7 RJ - 3 professores
            7 => [24, 25, 26, 27],      // Escola 8 MG - 4 professores
            8 => [28, 29, 30],          // Escola 9 MG - 3 professores
        ];

        foreach ($schoolProfessorMapping as $schoolIndex => $professorIndices) {
            $school = $schools[$schoolIndex];

            foreach ($professorIndices as $professorIndex) {
                $professorData = $professorsData[$professorIndex];

                // Remove símbolos do documento para usar como senha
                $password = preg_replace('/[^0-9]/', '', $professorData['document']);

                // Cria o usuário
                $user = User::create([
                    'name' => $professorData['name'],
                    'email' => $professorData['email'],
                    'password' => $password,
                    'role' => UserRolesEnum::TEACHER,
                ]);

                // Cria o professor
                $professor = Professor::create([
                    'client_id' => $school->client_id,
                    'user_id' => $user->id,
                    'street' => $professorData['street'],
                    'number' => $professorData['number'],
                    'complement' => $professorData['complement'],
                    'neighborhood' => $professorData['neighborhood'],
                    'city' => $professorData['city'],
                    'state' => $professorData['state'],
                    'zip_code' => $professorData['zip_code'],
                    'document' => $professorData['document'],
                    'phone' => $professorData['phone'],
                    'is_active' => true,
                ]);

                // Associa o professor à escola através da tabela pivot
                $professor->schools()->attach($school->id);
            }
        }
    }
}
