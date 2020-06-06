<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Illustration;
use App\Question;
use App\ViewModels\QuestionViewModel;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

final class QuestionController
{
    use ValidatesRequests;

    public function create(): Renderable
    {
        return view('questions.create');
    }

    public function edit(): Renderable
    {
        return view('questions.edit');
    }

    public function update(): Renderable
    {
        return view('questions.edit');
    }

    public function store(Request $request): Response
    {
        $validated_data = $this->validate(
            $request,
            [
                'title'        => 'required|unique:questions,title', // @todo: should not be forbidden, but result in a suggestion to look at existing question, if permissions allow that
                'content'      => 'nullable',
                'illustration' => 'required|image',
            ]
        );

        try {
            DB::beginTransaction();

            $question = Question::create([
                'user_id' => $request->user()->id,
                'title'   => $validated_data['title'],
                'content' => $validated_data['content'] ?? null,
            ]);

            $illustration = new Illustration();

            $illustration->user_id = $request->user()->id;
            $illustration->question_id = $question->id;
            $illustration->addMedia($request->file('illustration'))
                         ->withResponsiveImages()
                         ->toMediaCollection(Illustration::COLLECTION_IMAGES);

            $illustration->save();

            DB::commit();
        } catch (Throwable $exception) {
            DB::rollBack();

            Log::error(
                $exception->getMessage(),
                [
                    'user_id' => $request->user()->id,
                    'title'   => $validated_data['title'],
                    'content' => $validated_data['content'] ?? null,
                ]
            );

            return redirect()->back()
                ->withErrors([
                    'general' => [
                        __('Could not create new Question'),
                    ]
                ])
                ->withInput();
        }

        return redirect()->to(route('questions.list'));
    }

    public function list(): Renderable
    {
        $questions = Question::where('user_id', Auth::id())
                             ->orderBy('updated_at', 'desc')
                             ->get()
                             ->map(
                                 fn(Question $question) => new QuestionViewModel($question)
                             );

        return view('questions.list', [
            'questions' => $questions,
        ]);
    }

    public function detail(Question $question): Renderable
    {
        return view('questions.detail', new QuestionViewModel($question));
    }

    public function answer(Question $question): Renderable
    {

        return view('questions.answer', new QuestionViewModel($question));
    }
}
