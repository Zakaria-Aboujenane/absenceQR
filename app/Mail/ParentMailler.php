<?php

namespace App\Mail;

use App\Models\Etudiant;
use App\Models\Seance;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Psy\CodeCleaner\FinalClassPass;

class ParentMailler extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        //
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $etudiant = Etudiant::find($this->data['idEtudiant']);
        $seance = Seance::find($this->data['idSeance']);
        $address = 'noreply@isga.ma';
        $subject = 'Etudiant absent !';
        $name = 'isga';
        return $this->view('emails.parent')
            ->from($address, $name)
            ->cc($address, $name)
            ->bcc($address, $name)
            ->replyTo($address, $name)
            ->subject($subject)
            ->with([ 'etudiant' => $etudiant,'seance'=>$seance]);

//        return $this->view('view.name');
    }
}
