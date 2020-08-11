<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class BuyEvent extends Notification
{
    use Queueable;

    protected $my_notification;
    protected $_channel = null;

    public function __construct($notificationChannel, $msg)
    {
        $this->_channel = $notificationChannel;

        $this->my_notification = $msg;
    }

    public function via($notifiable)
    {
        if (!$this->_channel) {
            throw new \Exception('Sending a message failed. No channel provided.');
        }
        return is_array($this->_channel) ? $this->_channel : [$this->_channel];
//        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->error()
            ->line('Welcome ' . $this->my_notification)
            ->line('Best regards!');

    }

    public function toNexmo($notifiable)
    {
        try {
            return (new NexmoMessage)
                ->content('Your purchase has been submitted!' . $this->my_notification);
        } catch (\Exception $e) {
            Log::error('nexmo failed...');
            // echo 'Caught exception: ',  $e->getMessage(), "\n";
            // Log::error($e->getMessage());
//             $e->getMessage();
        }

    }

    public function toArray($notifiable)
    {
        return [
            'data' => $this->my_notification

        ];
    }

}
