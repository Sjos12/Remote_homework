<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;

final class MarketplaceController
{
    public function __invoke(): Renderable
    {
        return view('marketplace.home');
    }
}
