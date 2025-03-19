<?php

namespace App\Application\UseCases\Client;

use App\Domain\Entities\Client;
use App\Domain\Repositories\ClientRepositoryInterface;
use App\Infra\Services\HuggyService;
use App\Exceptions\ClientNotFoundException;

class ClientUpdateUseCase
{
    public function __construct(
        private ClientRepositoryInterface $repository,
        private HuggyService $huggyService,
    ) {}
   
    public function execute(int $id, array $data): Client
    {
        $client = $this->repository->findById($id);

        if (!$client) {
            throw new ClientNotFoundException("Client with ID $id not found.");
        }

        $huggyData = [
            'name' => $data['name'] ?? $client->getName(),
            'email' => $data['email'] ?? $client->getEmail(),
            'phone' => $data['phone'] ?? $client->getPhone(),
            'mobile' => $data['mobile'] ?? $client->getMobile(),
            'address' => $data['address'] ?? $client->getAddress(),
            'state' => $data['state'] ?? $client->getState(),
            'district' => $data['district'] ?? $client->getDistrict()
        ];

        // $this->huggyService->updateContact($client->getHuggyId(), $huggyData);

        $client->setName($huggyData['name']);
        $client->setEmail($huggyData['email']);
        $client->setPhone($huggyData['phone']);
        $client->setMobile($huggyData['mobile']);
        $client->setAddress($huggyData['address']);
        $client->setState($huggyData['address']);
        $client->setDistrict($huggyData['address']);

        $this->repository->update($client);

        return $client;
    }
}
