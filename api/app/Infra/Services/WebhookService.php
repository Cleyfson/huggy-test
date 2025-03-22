<?php

namespace App\Infra\Services;

use Illuminate\Support\Facades\Http;
use Throwable;

class WebhookService
{
    public function __construct(private $webhookUrl = null)
    {
        $this->webhookUrl = $this->webhookUrl ?: config('services.webhook.url');
    }

    public function send(array $data): void
    {
        try {
            Http::post($this->webhookUrl, $data);
        } catch (Throwable $e) {
            \Log::error('Falha ao enviar webhook: ' . $e->getMessage());
        }
    }
}
