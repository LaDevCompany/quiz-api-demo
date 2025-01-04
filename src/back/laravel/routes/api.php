<?php

use App\Http\Controllers\RetrieveQuestions;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json(status: 200);
});

Route::get('/retrieve-questions', RetrieveQuestions::class);
