<?php

namespace Tests\Unit\Application\UseCases\Client;

use PHPUnit\Framework\TestCase;
use App\Application\UseCases\Client\ClientUpdateUseCase;
use App\Domain\Entities\Client;
use Tests\Unit\Mocks\ClientRepositoryMock;
use Tests\Unit\Mocks\HuggyServiceMock;
use App\Exceptions\ClientNotFoundException;

class ClientUpdateUseCaseTest extends TestCase
{
    public function test_execute_updates_client_successfully()
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

        $updateData = [
            'name' => 'Jane Doe',
            'email' => 'janedoe@example.com',
            'phone' => '1234567890',
            'mobile' => '9876543210',
            'address' => '123 Main St',
            'state' => 'SP',
            'district' => 'Centro',
        ];

        $useCase = new ClientUpdateUseCase($clientRepository, $huggyService);
        $updatedClient = $useCase->execute(1, $updateData);

        $this->assertInstanceOf(Client::class, $updatedClient);
        $this->assertEquals('Jane Doe', $updatedClient->getName());
        $this->assertEquals('janedoe@example.com', $updatedClient->getEmail());
        $this->assertEquals('1234567890', $updatedClient->getPhone());
        $this->assertEquals('9876543210', $updatedClient->getMobile());
        $this->assertEquals('123 Main St', $updatedClient->getAddress());
        $this->assertEquals('SP', $updatedClient->getState());
        $this->assertEquals('Centro', $updatedClient->getDistrict());
        $this->assertEquals('106210365', $updatedClient->getHuggyId());
    }

    public function test_execute_throws_exception_when_client_not_found()
    {
        $clientRepository = new ClientRepositoryMock();
        $huggyService = new HuggyServiceMock();
        $useCase = new ClientUpdateUseCase($clientRepository, $huggyService);

        $this->expectException(ClientNotFoundException::class);
        $this->expectExceptionMessage("Client with ID 99 not found.");

        $updateData = [
            'name' => 'Jane Doe',
            'email' => 'janedoe@example.com',
            'phone' => '1234567890',
            'mobile' => '9876543210',
            'address' => '123 Main St',
            'state' => 'SP',
            'district' => 'Centro',
        ];

        $useCase->execute(99, $updateData);
    }
}
