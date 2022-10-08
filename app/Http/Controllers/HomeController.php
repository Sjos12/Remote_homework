<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use inertia\Inertia;
use Illuminate\Contracts\Support\Renderable;

final class HomeController
{
    public function __invoke()
    {
        return Inertia::render('Layouts/Layout');
    }
}
