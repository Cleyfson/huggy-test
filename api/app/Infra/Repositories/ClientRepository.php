<?php

namespace App\Infra\Repositories;

use App\Domain\Repositories\ClientRepositoryInterface;
use App\Domain\Entities\Client;
use Illuminate\Support\Facades\DB;

class ClientRepository implements ClientRepositoryInterface
{
    public function create(Client $client): Client
    {
        $clientId = DB::table('clients')->insertGetId([
            'huggy_id' => $client->name,
            'name' => $client->name,
            'email' => $client->email,
            'phone' => $client->phone,
            'mobile' => $client->mobile,
            'address' => $client->address,
            'state' => $client->state,
            'district' => $client->district,
            'city' => $client->city,
            'zip_code' => $client->zip_code,
            'photo' => $client->photo,
            'birth_date' => $client->birth_date,
            'last_seen' => $client->last_seen,
            'status' => $client->status
        ]);

        $client->id = $clientId;

        return $client;
    }
}
