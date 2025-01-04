<?php

namespace App\Providers;

use App\Services\Questions\FakeQuizApi;
use App\Services\Questions\HttpQuizApi;
use App\Services\Questions\QuizApi;
use App\Services\Questions\SdkQuizApi;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        /**
         * We choose implementation by chosen configuration
         */
        $this->app->bind(QuizApi::class, function (Application $app) {
            return match (config('services.quiz-api.driver')) {
                'http' => $app->make(HttpQuizApi::class),
                'sdk' => $app->make(SdkQuizApi::class),
                default => $app->make(FakeQuizApi::class),
            };
        });
    }

    public function boot(): void
    {
        $this->configureHttpClient();
    }

    protected function configureHttpClient(): void
    {
        if ($this->app->runningUnitTests()) {
            Http::preventStrayRequests();
        }

        Http::macro('quizApi', function () {
            return Http::acceptJson()
                ->contentType('application/json')
                ->baseUrl(config('services.quiz-api.baseUrl'))
                ->withToken(config('services.quiz-api.token'))
            ;
        });

        PendingRequest::macro('quizApi', function () {
            /** @var PendingRequest $this */
            return $this->acceptJson()
                ->contentType('application/json')
                ->baseUrl(config('services.quiz-api.baseUrl'))
                ->withToken(config('services.quiz-api.token'))
            ;
        });
    }
}
