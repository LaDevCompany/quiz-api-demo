<?php

namespace App\Http\Controllers;

use App\Services\Questions\QuizApi;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Cache;

class RetrieveQuestions
{
    public function __invoke(QuizApi $quizApiService): array
    {
        // put in cache until end of day
        [$easy, $medium, $hard] = Cache::remember(
            'quiz-api:daily-questions',
            today()->endOfDay(),
            fn () => $quizApiService->getDailyQuestions(), // get Questions via Service with config QUIZ_API_DRIVER
        );

        // format response for front
        return [
            'data' => [
                'easy' => $easy->toArray(),
                'medium' => $medium->toArray(),
                'hard' => $hard->toArray(),
            ],
        ];
    }
}
