<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Category;
use App\Illustration;
use App\Question;
use App\User;
use App\ViewModels\QuestionViewModel;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

final class QuestionController
{
    use ValidatesRequests;

    public function create(): Renderable
    {
        // Return all categories to
        $categories = Category::all();
        
        return view('questions.create')->with('categories', $categories);
    }

    public function store(Request $request): Response
    {
        
        $validated_data = $this->validate(
            $request,
            [
                'title'        => 'required|unique:questions,title', // @todo: should not be forbidden, but result in a suggestion to look at existing question, if permissions allow that
                'content'      => 'nullable',
                'illustration.*' => 'required|image',
                'categories'   => 'nullable|exists:categories,id',
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

            /** @var UploadedFile $uploaded_file */
            $uploaded_file = $validated_data['illustration'];

            $illustration->addAllMediaFromRequest()
                        ->each(function ($fileAdder) {
                            $fileAdder->withResponsiveImages();
                            $fileAdder->toMediaCollection(Illustration::COLLECTION_IMAGES);
                        });

            $illustration->save();

            foreach($validated_data['categories'] as $category) {
                $question->category()->attach($category);
            }
            // Creates DB record in the category_question table
            

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

    public function edit(Question $question): Renderable
    {
        return view('questions.edit', new QuestionViewModel($question));
    }

    public function update(Request $request, Question $question): Response
    {
        $validated_data = $this->validate(
            $request,
            [
                'title'        => [
                    'required',
                    Rule::unique('questions')->ignore($question->id),
                ],
                'content'      => 'nullable',
                'illustration' => 'sometimes|image',
            ]
        );

        // @todo: test that this question is authored by current user.

        try {
            DB::beginTransaction();

            $question->title = $validated_data['title'];
            $question->content = $validated_data['content'] ?? null;
            $question->save();

            if (isset($validated_data['illustration'])) {
                $illustration = $question->illustrations()->first();

                if (null === $illustration) {
                    $illustration = new Illustration();

                    $illustration->user_id = $request->user()->id;
                    $illustration->question_id = $question->id;
                }

                $illustration->clearMediaCollection(Illustration::COLLECTION_IMAGES);
                /** @var UploadedFile $uploaded_file */
                $uploaded_file = $request->file('illustration');
                $illustration->addMedia($uploaded_file)
                             ->withResponsiveImages()
                             ->toMediaCollection(Illustration::COLLECTION_IMAGES);

                $illustration->save();
            }

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
                                     __('Could not update Question'),
                                 ]
                             ])
                             ->withInput();
        }

        return redirect()->to(route('questions.edit', ['question' => $question->uuid]));
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
        $vm = new QuestionViewModel($question);
        
        return view('questions.detail', new QuestionViewModel($question));
    }

}
