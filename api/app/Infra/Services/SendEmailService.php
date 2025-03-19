<?php

namespace App\Infra\Services;

use App\Jobs\SendEmailJob;

class SendEmailService
{
    public function send(string $to, string $template, array $data, int $delayMinutes = 0)
    {
        $job = new SendEmailJob($to, $template, $data);

        if ($delayMinutes > 0) {
            $job->delay(now()->addMinutes($delayMinutes));
        }

        dispatch($job);
    }
}
