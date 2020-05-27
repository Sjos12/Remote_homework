<?php
declare(strict_types=1);

namespace App\ViewModels;

use App\Illustration;
use App\Question;
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
    
}
