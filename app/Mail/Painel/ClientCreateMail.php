<?php

namespace App\Mail\Painel;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ClientCreateMail extends Mailable
{
    use Queueable, SerializesModels;

    public $client;
    public $password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($client, $password)
    {
        $this->client = $client;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Cadastro Ultimate Farm Cannabis Center')
                    ->replyTo('no-reply@ultimatefarmcannabiscenter.com.br')
                    ->view('emails.client-create');
    }
}
