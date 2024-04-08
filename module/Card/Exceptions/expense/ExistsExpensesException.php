<?php

namespace Module\Card\Exceptions\expense;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class ExistsExpensesException extends Exception
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
                'message' => $this->message,
            ],

        ], Response::HTTP_BAD_REQUEST);
    }
}
