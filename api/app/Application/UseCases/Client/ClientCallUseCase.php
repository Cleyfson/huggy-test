<?php

namespace App\Application\UseCases\Client;

use App\Infra\Services\TwilioService;
use App\Domain\Repositories\ClientRepositoryInterface;

class ClientCallUseCase
{
    public function __construct(
        private ClientRepositoryInterface $repository,
        private TwilioService $TwilioService
    ) {}

    public function execute(int $id): array
    {
        $client = $this->repository->findById($id);

        if (!$client || !$client->getMobile()) {
            throw new \Exception('Cliente não possui número de telefone');
        }

        $phoneNumber = $client->getMobile();
        
        return $this->TwilioService->makeCall($phoneNumber, config('services.twilio.phone_number'));
    }

}
