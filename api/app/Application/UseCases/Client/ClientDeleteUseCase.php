<?php

namespace App\Application\UseCases\Client;

use App\Infra\Services\HuggyService;
use App\Domain\Repositories\ClientRepositoryInterface;
use App\Exceptions\ClientNotFoundException;

class ClientDeleteUseCase
{
    public function __construct(
        private ClientRepositoryInterface $repository,
        private HuggyService $huggyService
    ) {}

    public function execute(int $id): void
    {
        $client = $this->repository->findById($id);

        if (!$client) {
            throw new ClientNotFoundException("Client with ID $id not found.");
        }

        $this->huggyService->deleteContact($client->getHuggyId());
        $this->repository->delete($id);
    }
}
