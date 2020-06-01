<?php

namespace App\Container\Calisoft\Src\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Container\Calisoft\Src\Traits\DataBroadcast;
use App\Container\Calisoft\Src\Proyecto;
use App\Container\Calisoft\Src\User;

class EvaluadorAsignado extends Notification implements ShouldQueue
{
    use Queueable, DataBroadcast;

    public $proyecto;
    public $user;
    public $img;
    

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, Proyecto $proyecto)
    {
        
        $this->proyecto = $proyecto;
        $this->user = $user;
        $this->img = '/img/evaluador-asignado.png';
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database','broadcast'];
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
          ->subject('Se te ha asignado un evaluador')
          ->markdown('mail.evaluador-asignado', [
            'user' => $notifiable,
            'from' => $this->user,
            'proyecto' => $this->proyecto
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
            'type' => 'evaluador-asignado',
            'url' => '/documentacion',
            'from' => $this->user->name,
            'mail' => $this->user->email,
            'alert' => '¡Se te ha asignado un evaluador!',
            'img' => $this->img,
            'proyecto' => $this->proyecto->nombre
        ];
    }
}
