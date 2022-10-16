<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

final class DashboardController
{
    public function __invoke()
    {
        $groups = Auth::user()->groups;
        return Inertia::render('Pages/Dashboard', ['groups' => $groups]);
    }
}
