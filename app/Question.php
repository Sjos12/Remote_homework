<?php
declare(strict_types=1);

namespace App;

use Dyrynda\Database\Casts\EfficientUuid;
use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

final class Question extends Model
{
    use GeneratesUuid, SoftDeletes;

    protected $casts = [
        'uuid' => EfficientUuid::class,
    ];

    protected $guarded = [];
}
