<?php

namespace App\Infra\Services;

use Twilio\Rest\Client;

class TwilioService
{
    private Client $twilio;

    public function __construct()
    {
        $sid = config('services.twilio.sid');
        $token = config('services.twilio.auth_token');
        $this->twilio = new Client($sid, $token);
    }

    public function makeCall(string $to, string $from): array
    {
        try {
            $call = $this->twilio->calls->create(
                $to,
                $from,
                [
                    'url' => 'https://handler.twilio.com/twiml/EH6d6ab0f8fe67c480bb97b6415eadcc1e'
                ]
            );

            return [
                'sid' => $call->sid,
                'to' => $call->to,
                'from' => $call->from,
                'status' => $call->status,
                'date_created' => $call->dateCreated,
                'date_updated' => $call->dateUpdated,
                'duration' => $call->duration,
                'price' => $call->price,
            ];

        } catch (\Exception $e) {
            throw new \Exception('Erro ao fazer a chamada: ' . $e->getMessage());
        }
    }
}
