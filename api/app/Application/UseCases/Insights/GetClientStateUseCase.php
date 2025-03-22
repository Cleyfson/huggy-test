<?php

namespace App\Application\UseCases\Insights;

use App\Domain\Repositories\ClientRepositoryInterface;

class GetClientStateUseCase
{
    public function __construct(
        private ClientRepositoryInterface $repository,
    ) {}

    public function execute()
    {
        return $this->repository->getClientsByState();
    }
}
