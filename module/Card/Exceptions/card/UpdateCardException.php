<?php

namespace Module\Card\Exceptions\card;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class UpdateCardException extends Exception
{
    /**
     * @return void
     */
    public function report(): void
    {
        Log::error($this->message);
    }

    /**
     * @param $request
     * @return JsonResponse
     */
    public function render($request): JsonResponse
    {
        return response()->json([
            'error' => [
                'message' => 'Failed to update card.',
            ],

        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
