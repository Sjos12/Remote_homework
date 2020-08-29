<?php
declare(strict_types=1);

namespace App\ViewModels;

use App\User;
use Spatie\ViewModels\ViewModel;

final class UserViewModel extends ViewModel
{
    /**
     * @var \App\User
     */
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function name(): string
    {
        return $this->user->name;
    }

    public function answered(): int
    {
        return $this->user->answers()->count();
    }

    public function asked(): int
    {
        return $this->user->questions()->count();
    }
}
