<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ticketOpen extends Mailable
{
    use Queueable, SerializesModels;
    public $customer, $summary, $ticket_id;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($customer, $summary, $ticket_id)
    {
        //
        $this->customer = $customer;
        $this->summary = $summary;
        $this->ticket_id = $ticket_id;
    }
 
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('infotech@ecmtetrminals.com')->subject($this->summary)->view('email.openTicket');
        //return $this->view('view.name');
    }
}
