<?php

namespace App\Application\UseCases\Client;

use App\Domain\Entities\Client;
use App\Domain\Repositories\ClientRepositoryInterface;
use App\Infra\Services\HuggyService;

class RegisterClientUseCase
{
    public function __construct(
        private ClientRepositoryInterface $repository,
        private HuggyService $huggyService,
    ) {}
   
    public function execute(array $data): Client
    {
        $response = $this->huggyService->createContact([
            'name' =>  $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'mobile' => $data['mobile'],
            'address' => $data['address'],
            'state' => $data['state'],
            'district' => $data['district'],
        ]);

        $client = $this->repository->create(new Client(
            id: null,
            huggy_id: $response[0]['id'],
            name: $data['name'],
            email: $data['email'],
            phone: $data['phone'],
            mobile: $data['mobile'],
            address: $data['address'],
            state: $data['state'],
            district: $data['district'],
            city: $response[0]['city'],
            zip_code: $response[0]['zipCode'],
            photo: $response[0]['photo'],
            birth_date: $response[0]['birthDate'],
            last_seen: $response[0]['lastSeen'],
            status: $response[0]['status']
        ));

        return $client;
    }
}
