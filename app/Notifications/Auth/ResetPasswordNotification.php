<?php

namespace App\Notifications\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

/**
 * Class ResetPasswordNotification
 * @package App\Notifications\Auth
 */
class ResetPasswordNotification extends Notification
{
    use Queueable;

    /**
     * @var string
     */
    private string $token;

    /**
     * Create a new notification instance.
     * @param $token
     */
    public function __construct(string $token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Recuperação de Senha')
            ->greeting('Olá!')
            ->line('Clique no botão abaixo para redefinir sua senha')
            ->action('Redefinir Senha', route('password.reset', $this->token))
            ->line('Esse link de redefinição de senha expirará em 60 minutos.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
