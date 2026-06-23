<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected string $token;
    public function __construct(string $token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
     public function toMail($notifiable)
    {
        $frontendUrl = config('app.frontend_url');

        $url = $frontendUrl .
            '/reset-password?' .
            http_build_query([
                'token' => $this->token,
                'email' => $notifiable->email
            ]);

        return (new MailMessage)
            ->subject('Reset Your Eventify Password')
            ->view(
                'emails.reset-password',
                [
                    'user' => $notifiable,
                    'url' => $url
                ]
            );
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
