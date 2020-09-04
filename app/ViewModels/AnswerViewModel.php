<?php
declare(strict_types=1);

namespace App\ViewModels;

use App\Answer;
use App\User;
use Spatie\ViewModels\ViewModel;

final class AnswerViewModel extends ViewModel
{
    /**
     * @var \App\Answer
     */
    private Answer $answer;

    public function __construct(Answer $answer)
    {
        $this->answer = $answer;
    }

    public function answer(): Answer
    {
        return $this->answer;
    }

    public function question(): QuestionViewModel
    {
        return new QuestionViewModel($this->answer->question);
    }
}
