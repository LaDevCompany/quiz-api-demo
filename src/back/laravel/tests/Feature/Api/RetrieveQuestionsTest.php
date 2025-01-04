<?php

use Illuminate\Support\Facades\Cache;

use function Pest\Laravel\getJson;
use function Pest\Laravel\travel;

describe('test retrieve questions api', function () {
    beforeEach(function () {
        config(['services.quiz-api.driver' => 'fake']);
    });

    it('should return 3 questions', function () {
        $response = getJson('/api/retrieve-questions');

        $response
            ->assertJsonCount(3, 'data')
            ->assertJson([
                'data' => [
                    'easy' => [],
                    'medium' => [],
                    'hard' => [],
                ],
            ])
        ;
    });

    it('should store questions in cache', function () {
        expect(Cache::has('quiz-api:daily-questions'))->toBeFalse();

        getJson('/api/retrieve-questions');

        expect(Cache::has('quiz-api:daily-questions'))->toBeTrue();

        travel(1)->day();

        expect(Cache::has('quiz-api:daily-questions'))->toBeFalse();
    });
});
