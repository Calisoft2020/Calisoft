<?php

namespace App\Container\Calisoft\Src\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Container\Calisoft\Src\Traits\DataBroadcast;
use App\Container\Calisoft\Src\Proyecto;
use App\Container\Calisoft\Src\User;

class CasoPruebaCreado extends Notification implements ShouldQueue
{
    use Queueable, DataBroadcast;

    public $proyecto;
    public $caso;
    public $img;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($proyecto,$caso)
    {
        $this->proyecto = $proyecto;
        $this->caso = $caso;
        $this->img = '/img/caso-prueba-creado.png';
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
          ->subject('Se ha creado un caso prueba para su proyecto')
          ->markdown('mail.caso-prueba-creado', [
            'user' => $notifiable,
            'caso' => $this->caso,
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
            'type' => 'caso-prueba-creado',
            'url' => '/plataformaStudent',
            'alert' => '¡Se te ha asignado un Caso Prueba!',
            'proyecto' => $this->proyecto,
            'caso' => $this->caso,
            'img' => $this->img
        ];
    }
}
