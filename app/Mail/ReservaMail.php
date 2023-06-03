<?php 
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReservaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $nameClient;
    public $last_nameClient;
    public $email;
    public $phone;
    public $people;
    public $date;
    public $time;

    /**
     * Create a new message instance.
     */
    public function __construct($last_nameClient, $nameClient, $email, $phone, $people, $date, $time)
    {
        $this->nameClient = $nameClient;
        $this->last_nameClient = $last_nameClient;
        $this->email = $email;
        $this->phone = $phone;
        $this->people = $people;
        $this->date = $date;
        $this->time = $time;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reserva Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return (new Content())
            ->view('mails.reserva')
            ->with([
                'phone' => $this->phone,
                'people' => $this->people,
                'date' => $this->date,
                'time' => $this->time,
            ]);
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}

