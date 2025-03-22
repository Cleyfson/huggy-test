<?php

namespace Tests\Unit\Application\UseCases\Client;

use Tests\TestCase;
use App\Application\UseCases\Client\ClientRegisterUseCase;
use App\Domain\Entities\Client;
use App\Infra\Services\SendEmailService;
use App\Events\ClientRegistered;
use Tests\Unit\Mocks\ClientRepositoryMock;
use Tests\Unit\Mocks\HuggyServiceMock;
use Illuminate\Support\Facades\Event;

class ClientRegisterUseCaseTest extends TestCase
{
    public function test_execute_creates_client_successfully_and_sends_email_and_dispatches_event()
    {
        Event::fake();
        $emailServiceMock = $this->createMock(SendEmailService::class);
        $emailServiceMock->expects($this->once())
            ->method('send')
            ->with(
                $this->equalTo('janedoe@example.com'),
                $this->equalTo('welcome_email'),
                $this->arrayHasKey('name'),
                $this->greaterThan(0)
            );

        $huggyServiceMock = new HuggyServiceMock();
        $repositoryMock = new ClientRepositoryMock();

        $inputData = [
            'name' => 'Jane Doe',
            'email' => 'janedoe@example.com',
            'phone' => '1234567890',
            'mobile' => '9876543210',
            'address' => '123 Main St',
            'state' => 'SP',
            'district' => 'Centro',
        ];

        $useCase = new ClientRegisterUseCase($repositoryMock, $huggyServiceMock, $emailServiceMock);
        $client = $useCase->execute($inputData);

        $this->assertInstanceOf(Client::class, $client);
        $this->assertEquals('Jane Doe', $client->getName());
        $this->assertEquals('janedoe@example.com', $client->getEmail());

        Event::assertDispatched(ClientRegistered::class, function ($event) use ($client) {
            return $event->client->getEmail() === $client->getEmail();
        });
    }
}
