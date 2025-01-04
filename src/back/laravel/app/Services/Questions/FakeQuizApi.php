<?php

namespace App\Services\Questions;

use App\DataTransferObjects\QuestionDto;
use Illuminate\Support\Facades\File;

class FakeQuizApi implements QuizApi
{
    public function getDailyQuestions(): array
    {
        $easy = QuestionDto::fromArray(File::json(base_path('tests/Support/fixtures/question-solo.json'))['data'][0]);
        $medium = QuestionDto::fromArray(File::json(base_path('tests/Support/fixtures/question-multi.json'))['data'][0]);
        $hard = QuestionDto::fromArray(File::json(base_path('tests/Support/fixtures/question-pattern.json'))['data'][0]);

        return [$easy, $medium, $hard];
    }
}
