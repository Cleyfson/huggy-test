<?php
namespace Tests\Unit\Mocks;

use App\Domain\Entities\Client;
use App\Domain\Repositories\ClientRepositoryInterface;

class ClientRepositoryMock implements ClientRepositoryInterface
{
    private array $clients = [];

    public function create(Client $client): Client
    {
        $client->setId(count($this->clients) + 1);
        $this->clients[$client->getId()] = $client;
        return $client;
    }

    public function findById(int $id): ?Client
    {
        return $this->clients[$id] ?? null;
    }

    public function update(Client $client): void
    {
        if (isset($this->clients[$client->getId()])) {
            $this->clients[$client->getId()] = $client;
        }
       
        return;
    }

    public function findAll(): array
    {
        return array_values($this->clients);
    }

    public function delete(int $id): void
    {
        unset($this->clients[$id]);
    }
}