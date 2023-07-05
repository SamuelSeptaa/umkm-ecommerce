<?php

namespace App\Mail;

use App\Models\transaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TransactionPaid extends Mailable
{
    public $transaction;
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('noreply@umkmpky.com', 'NoReply')
            ->subject('Terima kasih telah berbelanja di website kami!')
            ->view('layout.email.receipt');
    }
}
