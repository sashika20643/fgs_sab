<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MyBulkEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = "Notice";
    public $content;
    public $mail;
    public $fee;
    public $course;
    public $intake;
    public $total;
    public $student;

    public function __construct($content,$mail,$fee,$course,$intake,$total,$student)
    {
        $this->content = $content;
        $this->mail = $mail;
        $this->fee = $fee;
        $this->course = $course;
        $this->intake = $intake;
        $this->total=$total;
        $this->student=$student;

    }

    public function build()
    {

        return $this->view('mails.my-bulk-email')
                    ->with(['content' => $this->content])  ->from('sashikadulaj20643@gmail.com');
    }
}

