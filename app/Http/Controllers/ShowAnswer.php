<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use App\ViewModels\AnswerViewModel;
use Illuminate\Contracts\Support\Renderable;

final class ShowAnswer
{

    public function __invoke(Question $question, Answer $answer): Renderable
    {
        return view('answers.detail', new AnswerViewModel($answer));
    }
}
