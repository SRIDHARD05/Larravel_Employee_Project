<?php

namespace App\Notifications;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class User_notification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $user;
    protected $messages;

    public function __construct($user, $messages)
    {
        $this->user = $user;
        $this->messages = $messages;
    }


    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'user_name' => $this->user,
            'message' => $this->messages,
            'notification_time' => now()
        ];
    }

    public function failed(Exception $exception)
    {
        Log::error("Failed to send notification to user " . $this->user);
    }
}

