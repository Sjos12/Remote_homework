<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use App\ViewModels\QuestionViewModel;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

final class FeedController
{
    use ValidatesRequests;

    public function list(): Renderable
    {
        $questions = Question::orderBy('updated_at', 'desc')
                             ->get()
                             ->map(
                                 fn(Question $question
                                 ) => new QuestionViewModel($question)
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
                'content'     => 'required',
                'annotations' => 'required',
            ]
        );

        try {
            DB::beginTransaction();

            Answer::create([
                'user_id'     => $request->user()->id,
                'question_id' => $question->id,
                'content'     => $validated_data['content'],
                'annotations' => $validated_data['annotations'],
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

        return redirect()->to(
            route('feed.detail', ['question' => $question->uuid])
        );
    }
}
