<?php

namespace App\Container\Calisoft\Src\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Container\Calisoft\Src\Traits\DataBroadcast;

class ProyectoEvaluacion extends Notification implements ShouldQueue
{
    use Queueable, DataBroadcast;

    private $proyecto;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(string $proyecto)
    {
        $this->proyecto = $proyecto;
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
            ->subject('Proyecto listo para evaluacion')
            ->line(sprintf('El proyecto %s se encuentra listo para ser calificado', $this->proyecto))
            ->action('Calificar Proyecto', route('home'));
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
            'type' => 'proyecto-evaluacion',
            'url' => '/',
            'alert' => 'Proyecto listo para evaluacion',
            'proyecto' => $this->proyecto,
            'img' => '/img/proyecto-asignado.png'
        ];
    }
}
