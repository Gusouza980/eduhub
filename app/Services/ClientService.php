<?php

namespace App\Services;

use App\Models\Client;

class ClientService
{
    public function createClient(array $data): Client
    {
        dd($data);
        return Client::create($data);
    }
}