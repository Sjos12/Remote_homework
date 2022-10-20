<?php

declare(strict_types=1);

namespace App;

use Dyrynda\Database\Casts\EfficientUuid;
use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
final class Question extends Model
{
    use GeneratesUuid, SoftDeletes;

    /**
     * @var array
     */
    protected $casts = [
        'uuid' => EfficientUuid::class,
    ];

    /**
     * @var array
     */
    protected $guarded = [];

    public function category()
    {
        // Define eloquent hasMany relationship, for multiple categories, with category-questions table.
        return $this->belongsToMany(Category::class);
    }

    public function author(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function illustrations(): HasMany
    {
        return $this->hasMany(Illustration::class)
            ->orderBy('created_at');
    }

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class)
            ->orderBy('created_at', 'desc');
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
