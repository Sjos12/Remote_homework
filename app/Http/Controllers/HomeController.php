<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;

final class HomeController
{
    public function __invoke(): Renderable
    {
        return view('pages.home');
    }
}
