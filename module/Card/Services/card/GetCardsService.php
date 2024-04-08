<?php

declare(strict_types=1);

namespace Module\Card\Services\card;

use Module\Abstracts\Service;
use Module\Card\Actions\card\GetCardsAction;

class GetCardsService extends Service
{
    /**
     * @return array
     */
    public function execute(): array
    {
        return app(GetCardsAction::class)->execute();
    }
}
