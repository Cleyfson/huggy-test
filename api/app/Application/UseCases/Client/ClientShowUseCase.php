<?php

namespace App\Application\UseCases\Client;

use App\Domain\Repositories\ClientRepositoryInterface;
use App\Infra\Services\HuggyService;
use App\Exceptions\ClientNotFoundException;

class ClientShowUseCase
{
    public function __construct(
        private ClientRepositoryInterface $repository,
        private HuggyService $huggyService
    ) {}

    public function execute(int $id)
    {
        $client = $this->repository->findById($id);

        if (!$client) {
            throw new ClientNotFoundException("Client with ID {$id} not found.");
        }

        // $huggyClient = $this->huggyService->getContact($client->getHuggyId());

        return $client;
    }
}
