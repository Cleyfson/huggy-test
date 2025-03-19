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
            'huggy_id'   => $client->getHuggyId(),
            'name'       => $client->getName(),
            'email'      => $client->getEmail(),
            'phone'      => $client->getPhone(),
            'mobile'     => $client->getMobile(),
            'address'    => $client->getAddress(),
            'state'      => $client->getState(),
            'district'   => $client->getDistrict(),
            'city'       => $client->getCity(),
            'zip_code'   => $client->getZipCode(),
            'photo'      => $client->getPhoto(),
            'birth_date' => $client->getBirthDate(),
            'last_seen'  => $client->getLastSeen(),
            'status'     => $client->getStatus(),
        ]);

        return $client->setId($clientId);
    }
}
