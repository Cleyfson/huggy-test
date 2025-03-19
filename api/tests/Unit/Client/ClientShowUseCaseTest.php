<?php

namespace Tests\Unit\Application\UseCases\Client;

use PHPUnit\Framework\TestCase;
use App\Application\UseCases\Client\ClientShowUseCase;
use App\Domain\Entities\Client;
use Tests\Unit\Mocks\ClientRepositoryMock;
use Tests\Unit\Mocks\HuggyServiceMock;
use App\Exceptions\ClientNotFoundException;

class ClientShowUseCaseTest extends TestCase
{
    public function test_execute_shows_client_successfully()
    {
        $clientRepository = new ClientRepositoryMock();
        $huggyService = new HuggyServiceMock();

        $client = (new Client())
            ->setId(1)
            ->setHuggyId('106210365')
            ->setName('Jane Doe')
            ->setEmail('janedoe@example.com')
            ->setPhone('1234567890')
            ->setMobile('9876543210')
            ->setAddress('123 Main St')
            ->setState('SP')
            ->setDistrict('Centro')
            ->setPhoto('https://c.pzw.io/img/avatar-user-boy.jpg');

        $clientRepository->create($client);

        $useCase = new ClientShowUseCase($clientRepository, $huggyService);
        $clientData = $useCase->execute(1);

        $this->assertInstanceOf(Client::class, $clientData);
        $this->assertEquals('Jane Doe', $clientData->getName());
        $this->assertEquals('janedoe@example.com', $clientData->getEmail());
        $this->assertEquals('1234567890', $clientData->getPhone());
        $this->assertEquals('9876543210', $clientData->getMobile());
        $this->assertEquals('123 Main St', $clientData->getAddress());
        $this->assertEquals('SP', $clientData->getState());
        $this->assertEquals('Centro', $clientData->getDistrict());
        $this->assertEquals('https://c.pzw.io/img/avatar-user-boy.jpg', $clientData->getPhoto());
    }

    public function test_execute_throws_exception_when_client_not_found()
    {
        $clientRepository = new ClientRepositoryMock();
        $huggyService = new HuggyServiceMock();
        $useCase = new ClientShowUseCase($clientRepository, $huggyService);

        $this->expectException(ClientNotFoundException::class);
        $this->expectExceptionMessage("Client with ID 99 not found.");

        $useCase->execute(99);
    }
}
