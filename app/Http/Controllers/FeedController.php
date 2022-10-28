<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Annotation;
use App\Answer;
use App\Question;
use App\ViewModels\QuestionViewModel;
use App\ViewModels\UserViewModel;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

final class FeedController
{
    use ValidatesRequests;

    public function list(Request $request): Renderable
    {
        $questions = Question::orderBy('updated_at', 'desc')
            ->get()
            ->map(
                fn (Question $question) => new QuestionViewModel($question)
            );

        return view('feed.list', [
            'user' => (new UserViewModel($request->user()))->toArray(),
            'questions' => $questions,
        ]);
    }

    public function detail(Question $question): Renderable
    {
        $vm = new QuestionViewModel($question);
        //       dd($vm->illustrations()[0]->getMedia('images')[0]->getUrl());
        return view('feed.detail', new QuestionViewModel($question));
    }

    public function answer(Request $request, Question $question)
    {
        $question->load('illustrations', 'illustrations.media');
        return Inertia::render('Pages/CreateAnswer', [
            'question' => $question,
        ]);
    }

    public function answered(Request $request, Question $question): Response
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
            $answer_model = Answer::create([
                'user_id'     => $request->user()->id,
                'question_id' => $question->id,
                'content'     => $validated_data['content'],
            ]);
            foreach ($validated_data['annotations'] as $annotation) {
                $annotation_model = new Annotation();
                $annotation_model->answer_id = $answer_model->id;
                $annotation_model->illustration_id = $annotation['illustration_id'];
                $annotation_model->annotation = json_encode($annotation['annotation']);
                $annotation_model->save();
            }

            DB::commit();
        } catch (Throwable $exception) {
            DB::rollBack();

            Log::error(
                $exception->getMessage(),
                [
                    'user_id' => $request->user()->id,
                ]
            );

            return back();
        }

        return redirect()->route('dashboard');
    }
}
