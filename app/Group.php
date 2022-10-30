<?php

namespace App;

use Dyrynda\Database\Casts\EfficientUuid;
use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use HasFactory, GeneratesUuid;

    /**
     * @var array
     */
    protected $casts = [
        'uuid' => EfficientUuid::class,
    ];
    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'group_members');
    }

    public function invite()
    {
        return $this->hasOne(Invite::class);
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }
    
}
