<?php

namespace App\Events;

use App\Domain\Entities\Client;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ClientRegistered
{
    use Dispatchable, SerializesModels;

    public function __construct(public Client $client) {}
}
