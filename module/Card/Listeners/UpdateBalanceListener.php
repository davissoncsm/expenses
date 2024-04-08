<?php

namespace Module\Card\Listeners;

use Module\Card\Actions\card\UpdateCardLimitAction;
use Module\Card\Events\UpdateBalanceEvent;

class UpdateBalanceListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UpdateBalanceEvent $event): void
    {
        app(UpdateCardLimitAction::class)
            ->setCard(card: $event->card)
            ->setValue(value: $event->value)
            ->execute();
    }
}
