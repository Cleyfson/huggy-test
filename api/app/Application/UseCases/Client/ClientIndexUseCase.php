<?php

namespace App\Application\UseCases\Client;

use App\Domain\Repositories\ClientRepositoryInterface;

class ClientIndexUseCase
{
    public function __construct(
        private ClientRepositoryInterface $repository,
    ) {}

    public function execute()
    {
        return $this->repository->findAll();
    }
}
