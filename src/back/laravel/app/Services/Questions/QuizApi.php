<?php

namespace App\Services\Questions;

use App\DataTransferObjects\QuestionDto;

interface QuizApi
{
    /** @return QuestionDto[] */
    public function getDailyQuestions(): array;
}
