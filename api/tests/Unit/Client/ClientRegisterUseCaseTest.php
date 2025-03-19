<?php

namespace Tests\Unit\Application\UseCases\Client;

use PHPUnit\Framework\TestCase;
use App\Application\UseCases\Client\ClientRegisterUseCase;
use App\Domain\Entities\Client;
use Tests\Unit\Mocks\ClientRepositoryMock;
use Tests\Unit\Mocks\HuggyServiceMock;

class ClientRegisterUseCaseTest extends TestCase
{
    public function test_execute_creates_client_successfully()
    {
        $inputData = [
            'name' => 'Jane Doe',
            'email' => 'janedoe@example.com',
            'phone' => '1234567890',
            'mobile' => '9876543210',
            'address' => '123 Main St',
            'state' => 'SP',
            'district' => 'Centro',
        ];

        $useCase = new ClientRegisterUseCase(new ClientRepositoryMock(), new HuggyServiceMock());

        $client = $useCase->execute($inputData);

        $this->assertInstanceOf(Client::class, $client);
        $this->assertEquals('Jane Doe', $client->getName());
        $this->assertEquals('janedoe@example.com', $client->getEmail());
        $this->assertEquals('106210365', $client->getHuggyId());
    }
}