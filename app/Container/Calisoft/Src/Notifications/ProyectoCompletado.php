<?php

namespace App\Container\Calisoft\Src\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Container\Calisoft\Src\Traits\DataBroadcast;
use App\Container\Calisoft\Src\Proyecto;
use App\Container\Calisoft\Src\User;

class ProyectoCompletado extends Notification implements ShouldQueue
{
    use Queueable, DataBroadcast;

    public $proyecto;
    public $img;
    

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Proyecto $proyecto)
    {
        
        $this->proyecto = $proyecto;
        $this->img = '/img/proyecto-completado.png';
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
          ->subject('Se a concluido la evaluación de su proyecto')
          ->markdown('mail.proyecto-completado', [
            'user' => $notifiable,
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
            'type' => 'proyecto-completado',
            'url' => '/',
            'alert' => '¡Se a finalizado la evaluación de su proyecto!',
            'proyecto' => $this->proyecto->nombre,
            'img' => $this->img
        ];
    }
}
