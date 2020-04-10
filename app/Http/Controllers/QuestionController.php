<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

final class QuestionController
{
    use ValidatesRequests;

    public function create(): Renderable
    {
        return view('questions.create');
    }

    public function store(Request $request): Response
    {
        $validated_data = $this->validate(
            $request,
            [
                'title'   => 'required|unique:questions,title',
                'content' => 'nullable',
            ]
        );

        Question::create([
            'user_id' => $request->user()->id,
            'title'   => $validated_data['title'],
            'content' => $validated_data['content'] ?? null,
        ]);

        return redirect()->to(route('questions.overview'));
    }

    public function overview(): Renderable
    {
        $questions = Question::where('user_id', Auth::id())
                             ->get();

        return view('questions.overview', [
            'questions' => $questions,
        ]);
    }
}
