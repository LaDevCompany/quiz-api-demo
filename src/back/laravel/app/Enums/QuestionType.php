<?php

namespace App\Enums;

enum QuestionType: string
{
    case Solo = 'solo';
    case Multi = 'multi';
    case Pattern = 'pattern';
}
