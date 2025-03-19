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

    public function updateContact(string $huggyId, array $data): void
    {
        try {
            $response = $this->client->put($this->apiUrl . '/contacts/' . $huggyId, [
                'headers' => $this->getHeaders(),
                'json' => $data,
            ]);

        } catch (GuzzleException $e) {
            throw new HuggyApiException('Failed to update contact in Huggy API: ' . $e->getMessage());
        }
    }

    public function deleteContact(string $huggyId): void
    {
        try {
            $response = $this->client->delete($this->apiUrl . '/contacts/' . $huggyId, [
                'headers' => $this->getHeaders(),
            ]);

        } catch (GuzzleException $e) {
            throw new HuggyApiException('Failed to delete contact in Huggy API: ' . $e->getMessage());
        }
    }

    public function getContact(string $huggyId): array
    {
        try {
            $response = $this->client->get($this->apiUrl . '/contacts/' . $huggyId, [
                'headers' => $this->getHeaders(),
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            throw new HuggyApiException("Error fetching Huggy contact: " . $e->getMessage());
        }
    }
}