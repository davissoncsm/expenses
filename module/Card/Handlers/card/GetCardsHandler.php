<?php

declare(strict_types=1);

namespace Module\Card\Handlers\card;

use Illuminate\Http\JsonResponse;
use Module\Card\Presenter\GetCardsPresenter;
use Module\Card\Services\card\GetCardsService;

class GetCardsHandler
{
    /**
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        $service = (new GetCardsService())->execute();

        return response()->json(GetCardsPresenter::make($service)->toArray(), 200);
    }
}
