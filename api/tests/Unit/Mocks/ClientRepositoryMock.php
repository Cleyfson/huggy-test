<?php
namespace Tests\Unit\Mocks;

use App\Domain\Entities\Client;
use App\Domain\Repositories\ClientRepositoryInterface;

class ClientRepositoryMock implements ClientRepositoryInterface
{
    private array $clients = [];

    public function create(Client $client): Client
    {
        $client->id = count($this->clients) + 1;
        $this->clients[$client->id] = $client;
        return $client;
    }

    public function find(int $id): ?Client
    {
        return $this->clients[$id] ?? null;
    }

    public function update(Client $client): Client
    {
        if (isset($this->clients[$client->id])) {
            $this->clients[$client->id] = $client;
        }
        return $client;
    }

    public function delete(int $id): void
    {
        unset($this->clients[$id]);
    }
}