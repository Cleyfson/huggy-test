<?php

namespace App\Application\UseCases\Client;

use App\Domain\Entities\Client;
use App\Domain\Repositories\ClientRepositoryInterface;
use App\Infra\Services\HuggyService;
use App\Infra\Services\SendEmailService;
use App\Events\ClientRegistered;

class ClientRegisterUseCase
{
    public function __construct(
        private ClientRepositoryInterface $repository,
        private HuggyService $huggyService,
        private SendEmailService $emailService,
    ) {}
   
    public function execute(array $data): Client
    {
        $response = $this->huggyService->createContact([
            'name' =>  $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'mobile' => $data['mobile'],
            'address' => $data['address'],
            'state' => $data['state'],
            'district' => $data['district'],
        ]);

        $client = (new Client())
            ->setId(null)
            ->setHuggyId($response[0]['id'])
            ->setName($data['name'])
            ->setEmail($data['email'])
            ->setPhone($data['phone'])
            ->setMobile($data['mobile'])
            ->setAddress($data['address'])
            ->setState($data['state'])
            ->setDistrict($data['district'])
            ->setCity($response[0]['city'])
            ->setZipCode($response[0]['zipCode'])
            ->setPhoto($response[0]['photo'])
            ->setBirthDate($response[0]['birthDate'])
            ->setLastSeen($response[0]['lastSeen'])
            ->setStatus($response[0]['status']);

        $this->emailService->send(
            to: $client->getEmail(),
            template: 'welcome_email',
            data: [
                'name' => $client->getName(),
                'subject' => 'Bem-vindo ao nosso serviço!',
            ],
            delayMinutes: 30
        );

        event(new ClientRegistered($client));

        return $this->repository->create($client);
    }
}
