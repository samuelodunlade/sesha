<?php

namespace App\Notifications;

use App\Models\Secret;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SecretCreated extends Notification
{
    use Queueable;
    protected $secret;
    /**
     * Create a new notification instance.
     */
    public function __construct(Secret $secret)
    {
        $this->secret = $secret;
    
    
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toDatabase($notifiable)
    {
        return [
            'secret_id' => $this->secret->id,
            'title' => 'New Secret Created',
            'message' => 'A new secret has been created and requires your attention.',
            'link' => route('admin.secrets.show', $this->secret->id)
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
