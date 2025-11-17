<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\School;
use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients = Client::all();

        $schoolsData = [
            // Cliente 1 - João Silva (4 escolas)
            [
                'client_index' => 0,
                'schools' => [
                    [
                        'name' => 'Colégio Educação Fundamental',
                        'alias' => 'CEF',
                        'email' => 'contato@cef.edu.br',
                        'cnpj' => '12.345.678/0001-90',
                        'phone' => '(11) 3456-7890',
                        'street' => 'Rua da Educação',
                        'number' => '200',
                        'complement' => null,
                        'neighborhood' => 'Vila Mariana',
                        'city' => 'São Paulo',
                        'state' => 'SP',
                        'zip_code' => '04101-000',
                        'site' => 'https://cef.edu.br',
                        'grade_flow' => ['1º Ano', '2º Ano', '3º Ano', '4º Ano', '5º Ano'],
                    ],
                    [
                        'name' => 'Escola Técnica São Paulo',
                        'alias' => 'ETSP',
                        'email' => 'contato@etsp.edu.br',
                        'cnpj' => '12.345.678/0002-71',
                        'phone' => '(11) 3456-7891',
                        'street' => 'Avenida Paulista',
                        'number' => '1000',
                        'complement' => 'Andar 5',
                        'neighborhood' => 'Bela Vista',
                        'city' => 'São Paulo',
                        'state' => 'SP',
                        'zip_code' => '01310-100',
                        'site' => 'https://etsp.edu.br',
                        'grade_flow' => ['1º Ano EM', '2º Ano EM', '3º Ano EM'],
                    ],
                    [
                        'name' => 'Instituto de Ensino Superior',
                        'alias' => 'IES',
                        'email' => 'contato@ies.edu.br',
                        'cnpj' => '12.345.678/0003-52',
                        'phone' => '(11) 3456-7892',
                        'street' => 'Rua Augusta',
                        'number' => '3000',
                        'complement' => null,
                        'neighborhood' => 'Consolação',
                        'city' => 'São Paulo',
                        'state' => 'SP',
                        'zip_code' => '01305-000',
                        'site' => 'https://ies.edu.br',
                        'grade_flow' => ['6º Ano', '7º Ano', '8º Ano', '9º Ano'],
                    ],
                    [
                        'name' => 'Centro Educacional Infantil',
                        'alias' => 'CEI',
                        'email' => 'contato@cei.edu.br',
                        'cnpj' => '12.345.678/0004-33',
                        'phone' => '(11) 3456-7893',
                        'street' => 'Rua dos Pinheiros',
                        'number' => '800',
                        'complement' => null,
                        'neighborhood' => 'Pinheiros',
                        'city' => 'São Paulo',
                        'state' => 'SP',
                        'zip_code' => '05422-000',
                        'site' => 'https://cei.edu.br',
                        'grade_flow' => ['Maternal', 'Pré I', 'Pré II'],
                    ],
                ],
            ],
            // Cliente 2 - Maria Santos (3 escolas)
            [
                'client_index' => 1,
                'schools' => [
                    [
                        'name' => 'Colégio Carioca',
                        'alias' => 'CC',
                        'email' => 'contato@colegiocarioca.edu.br',
                        'cnpj' => '98.765.432/0001-10',
                        'phone' => '(21) 3456-7890',
                        'street' => 'Avenida Nossa Senhora de Copacabana',
                        'number' => '1200',
                        'complement' => null,
                        'neighborhood' => 'Copacabana',
                        'city' => 'Rio de Janeiro',
                        'state' => 'RJ',
                        'zip_code' => '22070-011',
                        'site' => 'https://colegiocarioca.edu.br',
                        'grade_flow' => ['1º Ano', '2º Ano', '3º Ano', '4º Ano', '5º Ano', '6º Ano', '7º Ano', '8º Ano', '9º Ano'],
                    ],
                    [
                        'name' => 'Escola Rio Educação',
                        'alias' => 'ERE',
                        'email' => 'contato@rioeducacao.edu.br',
                        'cnpj' => '98.765.432/0002-01',
                        'phone' => '(21) 3456-7891',
                        'street' => 'Rua Visconde de Pirajá',
                        'number' => '500',
                        'complement' => 'Loja A',
                        'neighborhood' => 'Ipanema',
                        'city' => 'Rio de Janeiro',
                        'state' => 'RJ',
                        'zip_code' => '22410-002',
                        'site' => 'https://rioeducacao.edu.br',
                        'grade_flow' => ['1º Ano EM', '2º Ano EM', '3º Ano EM'],
                    ],
                    [
                        'name' => 'Centro de Ensino Botafogo',
                        'alias' => 'CEB',
                        'email' => 'contato@ceb.edu.br',
                        'cnpj' => '98.765.432/0003-92',
                        'phone' => '(21) 3456-7892',
                        'street' => 'Rua Voluntários da Pátria',
                        'number' => '300',
                        'complement' => null,
                        'neighborhood' => 'Botafogo',
                        'city' => 'Rio de Janeiro',
                        'state' => 'RJ',
                        'zip_code' => '22270-000',
                        'site' => 'https://ceb.edu.br',
                        'grade_flow' => ['Pré I', 'Pré II', '1º Ano', '2º Ano', '3º Ano', '4º Ano', '5º Ano'],
                    ],
                ],
            ],
            // Cliente 3 - Carlos Oliveira (2 escolas)
            [
                'client_index' => 2,
                'schools' => [
                    [
                        'name' => 'Colégio Mineiro de Excelência',
                        'alias' => 'CME',
                        'email' => 'contato@cme.edu.br',
                        'cnpj' => '45.678.912/0001-34',
                        'phone' => '(31) 3456-7890',
                        'street' => 'Avenida Afonso Pena',
                        'number' => '1500',
                        'complement' => null,
                        'neighborhood' => 'Centro',
                        'city' => 'Belo Horizonte',
                        'state' => 'MG',
                        'zip_code' => '30130-002',
                        'site' => 'https://cme.edu.br',
                        'grade_flow' => ['1º Ano', '2º Ano', '3º Ano', '4º Ano', '5º Ano', '6º Ano', '7º Ano', '8º Ano', '9º Ano', '1º EM', '2º EM', '3º EM'],
                    ],
                    [
                        'name' => 'Escola BH Tech',
                        'alias' => 'BHTECH',
                        'email' => 'contato@bhtech.edu.br',
                        'cnpj' => '45.678.912/0002-25',
                        'phone' => '(31) 3456-7891',
                        'street' => 'Rua Rio de Janeiro',
                        'number' => '800',
                        'complement' => 'Sala 201',
                        'neighborhood' => 'Savassi',
                        'city' => 'Belo Horizonte',
                        'state' => 'MG',
                        'zip_code' => '30160-040',
                        'site' => 'https://bhtech.edu.br',
                        'grade_flow' => ['1º Ano EM', '2º Ano EM', '3º Ano EM'],
                    ],
                ],
            ],
        ];

        foreach ($schoolsData as $clientSchools) {
            $client = $clients[$clientSchools['client_index']];

            foreach ($clientSchools['schools'] as $schoolData) {
                School::create([
                    'client_id' => $client->id,
                    'name' => $schoolData['name'],
                    'alias' => $schoolData['alias'],
                    'email' => $schoolData['email'],
                    'cnpj' => $schoolData['cnpj'],
                    'phone' => $schoolData['phone'],
                    'street' => $schoolData['street'],
                    'number' => $schoolData['number'],
                    'complement' => $schoolData['complement'],
                    'neighborhood' => $schoolData['neighborhood'],
                    'city' => $schoolData['city'],
                    'state' => $schoolData['state'],
                    'zip_code' => $schoolData['zip_code'],
                    'site' => $schoolData['site'],
                    'grade_flow' => $schoolData['grade_flow'],
                    'is_active' => true,
                ]);
            }
        }
    }
}
