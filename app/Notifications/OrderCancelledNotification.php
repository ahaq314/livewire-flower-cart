<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCancelledNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $cancelled_order;

    public function __construct($cancelled_order)
    {
        $this -> cancelled_order = $cancelled_order;

    }


    public function via($notifiable)
    {
        return ['database'];
    }


    public function toArray($notifiable)
    {
        return [
            'order_status' => 'Order Cancelled',
            'order_number' => $this -> cancelled_order -> order_number,
            'created_at' => $this -> cancelled_order ->  created_at,
            'first_name' => $this -> cancelled_order ->  first_name,
            'last_name' => $this -> cancelled_order ->  last_name,
            'phone_number' => $this -> cancelled_order ->  phone_number
        ];
    }
}
