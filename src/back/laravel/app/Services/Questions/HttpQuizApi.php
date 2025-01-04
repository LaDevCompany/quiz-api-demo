<?php

namespace App\Services\Questions;

use App\DataTransferObjects\QuestionDto;
use Illuminate\Http\Client\Pool;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class HttpQuizApi implements QuizApi
{
    public function getDailyQuestions(): array
    {
        /** @var Collection<Response> $responses */
        $responses = collect(Http::pool(fn (Pool $pool) => [
            $pool->as('easy')->quizApi()->get('/api/questions?langs=fr&difficulties=1,2'),
            $pool->as('medium')->quizApi()->get('/api/questions?langs=fr&difficulties=3,4'),
            $pool->as('hard')->quizApi()->get('/api/questions?langs=fr&difficulties=5,6'),
        ]));

        // throw_if($responses->some(fn (Response $response) => !$response->ok()));
        $responses->each->throw();

        $easy = QuestionDto::fromArray($responses->get('easy')->json('data.0'));
        $medium = QuestionDto::fromArray($responses->get('medium')->json('data.0'));
        $hard = QuestionDto::fromArray($responses->get('hard')->json('data.0'));

        return [$easy, $medium, $hard];
    }
}
