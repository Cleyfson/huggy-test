<?php

namespace App\Infra\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use App\Exceptions\HuggyApiException;

class HuggyService
{
    protected Client $client;
    protected string $apiUrl;
    protected string $apiToken;

    public function __construct(Client $client, string $apiUrl, string $apiToken)
    {
        $this->client = $client;
        $this->apiUrl = $apiUrl;
        $this->apiToken = $apiToken;
    }

    private function getHeaders(): array
    {
        return [
            'Authorization' => 'Bearer ' . $this->apiToken,
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ];
    }

    public function getContacts(): array
    {
        try {
            $response = $this->client->get($this->apiUrl . '/contacts', [
                'headers' => $this->getHeaders(),
            ]);

            return json_decode($response->getBody(), true);
        } catch (GuzzleException $e) {
            throw new HuggyApiException('Failed to fetch contacts from Huggy API: ' . $e->getMessage());
        }
    }

    public function createContact(array $data): array
    {
        try {
            $response = $this->client->post($this->apiUrl . '/contacts', [
                'headers' => $this->getHeaders(),
                'json' => $data,
            ]);

            return json_decode($response->getBody(), true);
        } catch (GuzzleException $e) {
            throw new HuggyApiException('Failed to create contact in Huggy API: ' . $e->getMessage());
        }
    }
}