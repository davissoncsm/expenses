<?php

declare(strict_types=1);

namespace Module\Card\Repositories;

use App\Entities\CardEntity;
use App\Repositories\BaseRepository;
use Module\Card\Repositories\Contracts\ICardRepository;

class CardRepository extends BaseRepository implements ICardRepository
{
    /**
     * @return string
     */
    public function entity(): string
    {
        return CardEntity::class;
    }
}
