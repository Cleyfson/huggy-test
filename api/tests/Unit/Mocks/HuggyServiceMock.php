<?php

namespace Tests\Unit\Mocks;

use GuzzleHttp\Client;
use App\Infra\Services\HuggyService;

class HuggyServiceMock extends HuggyService
{
    public function __construct()
    {
        parent::__construct(new Client(), 'https://api.huggy.fake', 'fake-api-token');
    }

    public function createContact(array $data): array
    {
        return [
            [
                'id' => '106210365',
                "name" => "Jane Doe",
                'email' => 'janedoe@example.com',
                'phone' => '1234567890',
                'mobile' => '9876543210',
                'address' => '123 Main St',
                'state' => 'SP',
                'district' => 'Centro',
                "city" => null,
                "zipCode" => null,
                "photo" => "https://c.pzw.io/img/avatar-user-boy.jpg",
                "birthDate" => null,
                "lastSeen" => "2025-03-18 20:47:26",
                "status" => 1
            ]
        ];
    }

    public function updateContact(string $huggyId, array $data): void
    {
        if ($huggyId !== '106210365') {
            throw new Exception("Huggy contact not found");
        }

        return;
    }

    public function deleteContact(string $huggyId): void
    {
        if ($huggyId !== '106210365') {
            throw new Exception("Huggy contact not found");
        }

        return;
    }
}