<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AuctionWonNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($auctionItem, $highestBid)
    {
        $this->item_name = $auctionItem->item->title;
        $this->price = $highestBid->price;
        $this->item_currency = $auctionItem->item->currency;


    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
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
            ->subject('Pink Crocodile Auction')
            ->greeting('Congratulations '. $notifiable->first_name . '!')
            ->line('You won the ' . $this->item_name)
            ->line('for ' . $this->price . ' ' . $this->item_currency)
            ->action('Go to Paypal', url('/'))
            ->line('Thank you for supporting us!')
            ->salutation('The Pink Crocodile Team');
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
            //
        ];
    }
}
