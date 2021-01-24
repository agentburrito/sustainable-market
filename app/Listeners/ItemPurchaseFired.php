<?php

namespace App\Listeners;

use App\Events\ItemPurchase;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ItemPurchaseFired
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ItemPurchase  $event
     * @return void
     */
    public function handle(ItemPurchase $event)
    {
        return (new MailMessage)
                       ->line('Your item has been purchased!')
                       ->line($listing->title)
                       ->action('Login Now', url('/login'));
    }
}
