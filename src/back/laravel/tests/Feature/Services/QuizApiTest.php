<?php

use App\DataTransferObjects\QuestionDto;
use App\Services\Questions\HttpQuizApi;
use Illuminate\Support\Facades\Http;

describe('test Quiz API Service', function () {
    test('HttpQuiz returns 3 QuestionDto', function () {
        $service = new HttpQuizApi;

        Http::fakeSequence()
            ->pushFile(base_path('tests/Support/fixtures/question-solo.json'))
            ->pushFile(base_path('tests/Support/fixtures/question-multi.json'))
            ->pushFile(base_path('tests/Support/fixtures/question-pattern.json'))
        ;

        $dtos = collect($service->getDailyQuestions());

        expect($dtos->count())->toBe(3)
            ->and($dtos)->each->toBeInstanceOf(QuestionDto::class)
        ;
    });
});
