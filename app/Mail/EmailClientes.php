<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailClientes extends Mailable
{
    use Queueable, SerializesModels;
    public $subject;
    public $msg;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->msg = $data;
        $this->subject = "Industrias Ordoñez: Pedido Nº ".$data["pedido"];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.welcome');
    }
}
