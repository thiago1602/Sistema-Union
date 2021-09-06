<?php

namespace App\Mail;

use App\Models\Produto;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NovoProdutoMail extends Mailable
{
    use Queueable, SerializesModels;
    public $produto;
    public $data_cadastro;
    public $url;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Produto $produto)
    {
        $this->produto = date('d/m/Y', strtotime( $produto->produto));
        $this->data_cadastro = $produto->data_cadastro;
        $this->url = 'http://localhost:8000/produto/'.$produto->id;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.novo-produto')->subject('Novo produto criado');
    }
}
