<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RedefinirSenhaNotification extends Notification
{
    use Queueable;
    private $token;
    private $email;
    private $name;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token, $email, $name)
    {
        $this->token = $token;
        $this->email = $email;
        $this->name = $name;
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
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {   
        $url = 'http://localhost:8000/password/reset/' . $this->token . '?email=' . $this->email;
        $count = config('auth.passwords.'.config('auth.defaults.passwords').'.expire');
        return (new MailMessage)
            ->subject('Redefinição de Senha !')
            ->greeting('Ola ' . $this->name)
            ->line('Voce está recebendo este email, pois solicitou o reset da senha !')
            ->action('Clique aqui para redefinir', $url)
            ->line('Esse link irá expirar em '.$count.' minutos')
            ->line('Caso não tenha solicitado a redefinição da senha, ignore este email !')
            ->salutation('Ate breve !');
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
