<?php

namespace App\Container\Calisoft\Src\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Container\Calisoft\Src\Traits\DataBroadcast;
use App\Container\Calisoft\Src\Proyecto;
use App\Container\Calisoft\Src\User;

class CasoPruebaEnviado extends Notification implements ShouldQueue
{
    use Queueable, DataBroadcast;

    public $proyecto;
    public $caso;
    public $estudiante;
    public $id;
    public $img;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($proyecto,$caso,$estudiante,$id)
    {
        $this->proyecto = $proyecto;
        $this->caso = $caso;
        $this->id = $id;
        $this->estudiante =$estudiante->name;
        $this->img = '/img/caso-prueba-enviado.png';
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
          ->subject('Se ha enviado un formulario de un caso prueba')
          ->markdown('mail.caso-prueba-enviado', [
            'user' => $notifiable,
            'caso' => $this->caso,
            'estudiante' => $this->estudiante,
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
            'type' => 'caso-prueba-enviado',
            'url' => '/proyectos/'.$this->id.'/plataforma',
            'alert' => '¡Se ha enviado un Caso Prueba!',
            'proyecto' => $this->proyecto,
            'caso' => $this->caso,
            'estudiante' => $this->estudiante,
            'img' => $this->img
        ];
    }
}
