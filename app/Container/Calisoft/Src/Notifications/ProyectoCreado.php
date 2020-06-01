<?php

namespace App\Container\Calisoft\Src\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Container\Calisoft\Src\Proyecto;
use App\Container\Calisoft\Src\Traits\DataBroadcast;

class ProyectoCreado extends Notification implements ShouldQueue
{
    use Queueable, DataBroadcast;


    public $proyecto;
    public $img;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($proyecto)
    {
        $this->proyecto = $proyecto;
        $this->img = '/img/proyecto-creado.png';
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
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
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
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
            'type' => 'proyecto-creado',
            'proyecto' => $this->proyecto->nombre,
            'url' => '/proyecto',
            'alert' => '¡Se ha registrado un nuevo proyecto!',
            'img' => $this->img
        ];
    }


}
