<?php

declare(strict_types=1);

namespace Module\Card\Services;

use Exception;
use Module\Abstracts\Service;
use Module\Card\Actions\GetCardsAction;

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
