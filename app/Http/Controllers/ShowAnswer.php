<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use App\ViewModels\AnswerViewModel;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Inertia\Inertia;

final class ShowAnswer
{

    public function __invoke(Request $request, Question $question, Answer $answer)
    {
        $answer->load('annotations', 'author');
        return Inertia::render('Pages/AnswerDetail', [
            'answer' => $answer, 'question' => $question
        ]);
    }
}
