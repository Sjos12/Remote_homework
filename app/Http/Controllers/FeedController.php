<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Illustration;
use App\Question;
use App\ViewModels\QuestionViewModel;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

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

    public function answer(Question $question): Renderable
    {
        return view('feed.answer', new QuestionViewModel($question));
    }

    public function answered(Request $request, Question $question)
    {
        $validated_data = $this->validate(
            $request,
            [
                'annotations'        => 'required',
            ]
        );

        try {
            DB::beginTransaction();

            // @todo: create model
            $question = Answer::create([
                'user_id' => $request->user()->id,
                'annotations' => $request->input('annotation'),
            ]);

            DB::commit();
        } catch (Throwable $exception) {
            DB::rollBack();

            Log::error(
                $exception->getMessage(),
                [
                    'user_id' => $request->user()->id,
                ]
            );

            return redirect()->back()
                             ->withErrors([
                                 'general' => [
                                     __('Could not create new Answer'),
                                 ]
                             ])
                             ->withInput();
        }

        return redirect()->back();
    }
}
