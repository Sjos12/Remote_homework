<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Question;
use App\ViewModels\QuestionViewModel;
use Illuminate\Contracts\Support\Renderable;

final class FeedController
{
    public function list(): Renderable
    {
        $questions = Question::orderBy('updated_at', 'desc')
                             ->get()
                             ->map(
                                 fn(Question $question) => new QuestionViewModel($question)
                             );

        return view('feed.list', [
            'questions' => $questions,
        ]);
    }

    public function detail(Question $question): Renderable
    {
        return view('feed.detail', new QuestionViewModel($question));
    }
}
