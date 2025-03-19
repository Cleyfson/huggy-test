<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\DynamicEmail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $to;
    public string $template;
    public array $data;

    public function __construct(string $to, string $template, array $data)
    {
        $this->to = $to;
        $this->template = $template;
        $this->data = $data;
    }

    public function handle()
    {
        Mail::to($this->to)->send(new DynamicEmail($this->template, $this->data));
    }
}
