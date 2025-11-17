<?php

namespace Database\Seeders;

use App\Enums\UserRolesEnum;
use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients = [
            [
                'name' => 'João Silva',
                'email' => 'joao.silva@eduhub.com',
                'document' => '123.456.789-00',
                'phone' => '(11) 98765-4321',
                'street' => 'Rua das Flores',
                'number' => '100',
                'complement' => 'Apto 101',
                'neighborhood' => 'Jardim Paulista',
                'city' => 'São Paulo',
                'state' => 'SP',
                'zip_code' => '01234-000',
            ],
            [
                'name' => 'Maria Santos',
                'email' => 'maria.santos@eduhub.com',
                'document' => '987.654.321-00',
                'phone' => '(21) 99876-5432',
                'street' => 'Avenida Atlântica',
                'number' => '500',
                'complement' => 'Cobertura',
                'neighborhood' => 'Copacabana',
                'city' => 'Rio de Janeiro',
                'state' => 'RJ',
                'zip_code' => '22021-000',
            ],
            [
                'name' => 'Carlos Oliveira',
                'email' => 'carlos.oliveira@eduhub.com',
                'document' => '456.789.123-00',
                'phone' => '(31) 98765-1234',
                'street' => 'Rua da Bahia',
                'number' => '1500',
                'complement' => null,
                'neighborhood' => 'Centro',
                'city' => 'Belo Horizonte',
                'state' => 'MG',
                'zip_code' => '30160-010',
            ],
        ];

        foreach ($clients as $clientData) {
            // Remove símbolos do documento para usar como senha
            $password = preg_replace('/[^0-9]/', '', $clientData['document']);

            // Cria o usuário
            $user = User::create([
                'name' => $clientData['name'],
                'email' => $clientData['email'],
                'password' => $password,
                'role' => UserRolesEnum::MANAGER,
            ]);

            // Cria o cliente
            Client::create([
                'user_id' => $user->id,
                'street' => $clientData['street'],
                'number' => $clientData['number'],
                'complement' => $clientData['complement'],
                'neighborhood' => $clientData['neighborhood'],
                'city' => $clientData['city'],
                'state' => $clientData['state'],
                'zip_code' => $clientData['zip_code'],
                'document' => $clientData['document'],
                'phone' => $clientData['phone'],
                'is_active' => true,
            ]);
        }
    }
}
