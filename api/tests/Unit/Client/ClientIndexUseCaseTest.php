<?php

namespace Tests\Unit\Application\UseCases\Client;

use PHPUnit\Framework\TestCase;
use App\Application\UseCases\Client\ClientIndexUseCase;
use App\Domain\Entities\Client;
use Tests\Unit\Mocks\ClientRepositoryMock;
use Tests\Unit\Mocks\HuggyServiceMock;

class ClientIndexUseCaseTest extends TestCase
{
    public function test_execute_returns_all_clients()
    {
        $clientRepository = new ClientRepositoryMock();
        $huggyService = new HuggyServiceMock();

        $client1 = (new Client())
            ->setId(1)
            ->setHuggyId('106210365')
            ->setName('John Doe')
            ->setEmail('johndoe@example.com')
            ->setPhone('999999999')
            ->setMobile('888888888')
            ->setAddress('Old Address')
            ->setState('RJ')
            ->setDistrict('Bairro Antigo');
        
        $client2 = (new Client())
            ->setId(2)
            ->setHuggyId('106210366')
            ->setName('Jane Smith')
            ->setEmail('janesmith@example.com')
            ->setPhone('9988776655')
            ->setMobile('8877665544')
            ->setAddress('New Address')
            ->setState('SP')
            ->setDistrict('Centro');

        $clientRepository->create($client1);
        $clientRepository->create($client2);

        $useCase = new ClientIndexUseCase($clientRepository, $huggyService);
        $clients = $useCase->execute();

        $this->assertIsArray($clients);
        $this->assertCount(2, $clients);

        $this->assertEquals('John Doe', $clients[0]->getName());
        $this->assertEquals('johndoe@example.com', $clients[0]->getEmail());
        $this->assertEquals('999999999', $clients[0]->getPhone());
        $this->assertEquals('888888888', $clients[0]->getMobile());
        $this->assertEquals('Old Address', $clients[0]->getAddress());
        $this->assertEquals('RJ', $clients[0]->getState());
        $this->assertEquals('Bairro Antigo', $clients[0]->getDistrict());

        $this->assertEquals('Jane Smith', $clients[1]->getName());
        $this->assertEquals('janesmith@example.com', $clients[1]->getEmail());
        $this->assertEquals('9988776655', $clients[1]->getPhone());
        $this->assertEquals('8877665544', $clients[1]->getMobile());
        $this->assertEquals('New Address', $clients[1]->getAddress());
        $this->assertEquals('SP', $clients[1]->getState());
        $this->assertEquals('Centro', $clients[1]->getDistrict());
    }

    public function test_execute_returns_empty_array_when_no_clients()
    {
        $clientRepository = new ClientRepositoryMock();
        $huggyService = new HuggyServiceMock();

        $useCase = new ClientIndexUseCase($clientRepository, $huggyService);
        $clients = $useCase->execute();

        $this->assertIsArray($clients);
        $this->assertCount(0, $clients);
    }
}
