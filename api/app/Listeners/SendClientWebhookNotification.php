<?php

namespace App\Listeners;

use App\Events\ClientRegistered;
use App\Infra\Services\WebhookService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendClientWebhookNotification implements ShouldQueue
{
    use InteractsWithQueue;

    public function __construct(private WebhookService $webhookService) {}

    public function handle(ClientRegistered $event): void
    {
        $client = $event->client;

        $this->webhookService->send([
            'id' => $client->getId(),
            'huggy_id' => $client->getHuggyId(),
            'name' => $client->getName(),
            'email' => $client->getEmail(),
            'phone' => $client->getPhone(),
            'mobile' => $client->getMobile(),
            'address' => $client->getAddress(),
            'state' => $client->getState(),
            'district' => $client->getDistrict(),
            'city' => $client->getCity(),
            'zip_code' => $client->getZipCode(),
            'photo' => $client->getPhoto(),
            'birth_date' => $client->getBirthDate(),
            'last_seen' => $client->getLastSeen(),
            'status' => $client->getStatus(),
        ]);
    }
}
