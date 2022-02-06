<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderPlacedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $order;
    public function __construct($order)
    {
        $this -> order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
            'order_status' => 'New Order',
            'order_number' => $this -> order -> order_number,
            'created_at' => $this -> order ->  created_at,
            'first_name' => $this -> order ->  first_name,
            'last_name' => $this -> order ->  last_name,
            'phone_number' => $this -> order ->  phone_number
        ];
    }
}
