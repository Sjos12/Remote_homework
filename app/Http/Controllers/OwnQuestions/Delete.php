<?php
declare(strict_types=1);

namespace App\Http\Controllers\OwnQuestions;

use App\Question;
use Illuminate\Support\Facades\Auth;
use RuntimeException;
use Symfony\Component\HttpFoundation\Response;

final class Delete
{
    public function __invoke(Question $question): Response
    {
        if (Auth::id() !== (int) $question->author->id) {
            // @todo: refactor authorization check, since some roles will be able to delete other questions for example
            // @todo: refactor error; this should result in a 400-range http error with user facing message
            throw new RuntimeException('Not authorized to delete question');
        }

        Question::destroy($question->id);

        return response()->json([
            'message' => __('Successfully deleted the question'),
        ]);
    }
}
