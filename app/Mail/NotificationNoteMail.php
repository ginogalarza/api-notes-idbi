<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificationNoteMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    private $group;
    private $titleNote;

    public function __construct($group, $titleNote)
    {
        $this->group     = $group;
        $this->titleNote = $titleNote;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Nueva Nota')
                ->with([
                    'group' => $this->group,
                    'titleNote' => $this->titleNote
                ])
                ->markdown('email.notificationNoteMd');
    }
}
