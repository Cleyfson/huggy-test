<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DynamicEmail extends Mailable
{
    use Queueable, SerializesModels;

    public string $template;
    public array $data;

    public function __construct(string $template, array $data)
    {
        $this->template = $template;
        $this->data = $data;
    }

    public function build()
    {
        return $this->subject($this->data['subject'] ?? 'Notificação')
                    ->view($this->template)
                    ->with($this->data);
    }
}
