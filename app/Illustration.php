<?php
declare(strict_types=1);

namespace App;

use Dyrynda\Database\Casts\EfficientUuid;
use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

final class Illustration extends Model implements HasMedia
{
    use GeneratesUuid, InteractsWithMedia, SoftDeletes;

    public const COLLECTION_IMAGES = 'images';

    /**
     * @var array
     */
    protected $casts = [
        'uuid' => EfficientUuid::class,
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(self::COLLECTION_IMAGES)
             ->acceptsMimeTypes([
                 'image/gif',
                 'image/jpeg',
                 'image/png',
             ]);
    }

    public function author(): HasOne
    {
        return $this->hasOne(User::class,'id', 'user_id');
    }
}
