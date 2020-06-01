<?php

namespace App\Container\Calisoft\Src\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Container\Calisoft\Src\Traits\DataBroadcast;
use App\Container\Calisoft\Src\Proyecto;
use App\Container\Calisoft\Src\User;

class InvitacionEnviada extends Notification implements ShouldQueue
{
    use Queueable, DataBroadcast;

    public $proyecto;
    public $from;
    public $img;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $from, Proyecto $proyecto)
    {
        $this->from = $from;
        $this->proyecto = $proyecto;
        $this->img = '/img/invitacion-enviada.png';

    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
          ->subject('Has recibido una invitación')
          ->markdown('mail.invitacion', [
            'user' => $notifiable,
            'proyecto' => $this->proyecto,
            'from' => $this->from
          ]);
    }

    /**
     * Get the array representation of the notification.
     * :user: te ha invitado ha ser parte del proyecto :proyecto:
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'type' => 'invitacion-recibida',
            'url' => '/invitaciones',
            'alert' => '¡Has recibido una invitación!',
            'proyecto' => $this->proyecto->nombre,
            'img' => $this->img,
            'user' => $this->from->name
        ];
    }
}
