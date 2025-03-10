<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProfileUpdated extends Notification
{
    // use Queueable;

    public $user;
    public $action;

    public function __construct($user, $action)
    {
        $this->user = $user;
        $this->action = $action;
    }


    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'action' => $this->action,
            'profile_url' => url('/profile'),
        ];
    }
    
}
