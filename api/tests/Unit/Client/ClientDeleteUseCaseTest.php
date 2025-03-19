<?php

namespace Tests\Unit\Application\UseCases\Client;

use PHPUnit\Framework\TestCase;
use App\Application\UseCases\Client\ClientDeleteUseCase;
use App\Domain\Entities\Client;
use Tests\Unit\Mocks\ClientRepositoryMock;
use Tests\Unit\Mocks\HuggyServiceMock;
use App\Exceptions\ClientNotFoundException;

class ClientDeleteUseCaseTest extends TestCase
{
    public function test_execute_deletes_client_successfully()
    {
        $clientRepository = new ClientRepositoryMock();
        $huggyService = new HuggyServiceMock();

        $client = (new Client())
            ->setId(1)
            ->setHuggyId('106210365')
            ->setName('John Doe')
            ->setEmail('johndoe@example.com')
            ->setPhone('999999999')
            ->setMobile('888888888')
            ->setAddress('Old Address')
            ->setState('RJ')
            ->setDistrict('Bairro Antigo');

        $clientRepository->create($client);
        $deletedClient = $clientRepository->findById(1);
        $this->assertNotNull($deletedClient);

        $deleteUseCase = new ClientDeleteUseCase($clientRepository, $huggyService);
        $deleteUseCase->execute(1);

        $deletedClient = $clientRepository->findById(1);
        $this->assertNull($deletedClient);
    }

    public function test_execute_throws_exception_when_client_not_found()
    {
        $clientRepository = new ClientRepositoryMock();
        $huggyService = new HuggyServiceMock();
        $useCase = new ClientDeleteUseCase($clientRepository, $huggyService);

        $this->expectException(ClientNotFoundException::class);
        $this->expectExceptionMessage("Client with ID 99 not found.");

        $useCase->execute(99);
    }
}
