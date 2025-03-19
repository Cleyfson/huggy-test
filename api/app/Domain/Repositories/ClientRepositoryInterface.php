<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Client;

interface ClientRepositoryInterface
{
    public function create(Client $client): Client;
    public function findById(int $id): ?Client;
    public function update(Client $client): void;
    public function delete(int $id): void;
    public function findAll(): array; 
}
