<?php

declare(strict_types=1);

namespace Module\Card\Repositories;

use App\Entities\ExpenseEntity;
use App\Repositories\BaseRepository;
use Module\Card\Repositories\Contracts\IExpenseRepository;

class ExpenseRepository extends BaseRepository implements IExpenseRepository
{
    /**
     * @return string
     */
    public function entity(): string
    {
        return ExpenseEntity::class;
    }
}
