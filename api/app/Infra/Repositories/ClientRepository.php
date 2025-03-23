<?php

namespace App\Infra\Repositories;

use App\Domain\Repositories\ClientRepositoryInterface;
use App\Domain\Entities\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class ClientRepository implements ClientRepositoryInterface
{
    const REDIS_KEY_DISTRICT = 'clients_by_district';
    const REDIS_KEY_STATE = 'clients_by_state';
    const REDIS_EXPIRATION = 3600;

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

    public function findById(int $id): ?Client
    {
        $data = DB::table('clients')->find($id);
    
        if (!$data) {
            return null;
        }
    
        return (new Client())
            ->setId($data->id)
            ->setHuggyId($data->huggy_id)
            ->setName($data->name)
            ->setEmail($data->email)
            ->setPhone($data->phone)
            ->setMobile($data->mobile)
            ->setAddress($data->address)
            ->setState($data->state)
            ->setDistrict($data->district)
            ->setCity($data->city)
            ->setZipCode($data->zip_code)
            ->setPhoto($data->photo)
            ->setBirthDate($data->birth_date)
            ->setLastSeen($data->last_seen)
            ->setStatus($data->status);
    }

    public function update(Client $client): void
    {
        DB::table('clients')
            ->updateOrInsert(
                ['id' => $client->getId()],
                [
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
                ]
            );
    }

    public function findAll(): array
    {
        $clients = DB::table('clients')->get();

        if ($clients->isEmpty()) {
            return [];
        }

        return $clients->map(function ($data) {
            return (new Client())
                ->setId($data->id)
                ->setHuggyId($data->huggy_id)
                ->setName($data->name)
                ->setEmail($data->email)
                ->setPhone($data->phone)
                ->setMobile($data->mobile)
                ->setAddress($data->address)
                ->setState($data->state)
                ->setDistrict($data->district)
                ->setCity($data->city)
                ->setZipCode($data->zip_code)
                ->setPhoto($data->photo)
                ->setBirthDate($data->birth_date)
                ->setLastSeen($data->last_seen)
                ->setStatus($data->status);
        })->toArray();
    }

    public function delete(int $id): void
    {
        DB::table('clients')->where('id', $id)->delete();
    }

    public function getClientsByDistrict(): array
    {
        $data = Redis::get(self::REDIS_KEY_DISTRICT);
        
        if ($data) {
            return json_decode($data, true);
        }
    
        $data = DB::table('clients')
            ->select('district', DB::raw('count(*) as total'))
            ->groupBy('district')
            ->get()
            ->toArray();
    
        Redis::setex(self::REDIS_KEY_DISTRICT, self::REDIS_EXPIRATION, json_encode($data));
    
        return $data;
    }
    
    public function getClientsByState(): array
    {
        $data = Redis::get(self::REDIS_KEY_STATE);
        
        if ($data) {
            return json_decode($data, true);
        }
    
        $data = DB::table('clients')
            ->select('state', DB::raw('count(*) as total'))
            ->groupBy('state')
            ->get()
            ->toArray();
    
        Redis::setex(self::REDIS_KEY_STATE, self::REDIS_EXPIRATION, json_encode($data));
    
        return $data;
    }
}
