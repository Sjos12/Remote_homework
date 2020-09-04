<?php
declare(strict_types=1);

namespace App\ViewModels;

use App\Illustration;
use App\Question;
use App\User;
use Illuminate\Support\Collection;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\ViewModels\ViewModel;

final class QuestionViewModel extends ViewModel
{
    /**
     * @var \App\Question
     */
    private Question $question;

    public function __construct(Question $question)
    {
        $this->question = $question;
    }

    public function question(): Question
    {
        return $this->question;
    }

    public function illustrations(): Collection
    {
        return $this->question->illustrations;
    }

    public function answers(): Collection
    {
        return $this->question->answers;
    }

    public function author(): User
    {
        return $this->question->author;
    }

    public function id(): string
    {
        return (string) $this->question->uuid;
    }

    public function title(): string
    {
        return $this->question->title;
    }

    public function firstImage(): ?Media
    {
        $illustration = $this->illustrations()
                    ->first(static function (Illustration $illustration) {
                        return $illustration->hasMedia(Illustration::COLLECTION_IMAGES);
                    });

        if (null !== $illustration) {
            return $illustration->getFirstMedia(Illustration::COLLECTION_IMAGES);
        }

        // Could do a default image placeholder here
        return null;
    }

    public function createdSince(): string
    {
        return $this->question->created_at->diffForHumans();
    }
}
