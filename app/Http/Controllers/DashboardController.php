<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Inertia\Inertia;

final class DashboardController
{
    public function __invoke()
    {
        return Inertia::render('Pages/Dashboard');
    }
}
