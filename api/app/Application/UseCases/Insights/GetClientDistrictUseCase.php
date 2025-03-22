<?php

namespace App\Application\UseCases\Insights;

use App\Domain\Repositories\ClientRepositoryInterface;

class GetClientDistrictUseCase
{
    public function __construct(
        private ClientRepositoryInterface $repository,
    ) {}

    public function execute()
    {
        return $this->repository->getClientsByDistrict();
    }
}
