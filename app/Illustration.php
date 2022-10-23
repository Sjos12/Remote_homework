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
    protected $appends = ['url'];
    /**
     * @var array
     */
    protected $casts = [
        'uuid' => EfficientUuid::class,
    ];

    public function getMediaUrlArray($media)
    {
        $arr = [];
        foreach ($media as $medium) {
            array_push($arr, $medium->getUrl());
        }
        return $arr;
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(self::COLLECTION_IMAGES)
            ->acceptsMimeTypes([
                'image/gif',
                'image/jpeg',
                'image/png',
            ]);
    }

    public function getUrlAttribute()
    {
        return $this->getFirstMediaUrl(self::COLLECTION_IMAGES);
    }

}
