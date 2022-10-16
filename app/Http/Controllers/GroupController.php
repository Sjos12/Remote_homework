<?php

namespace App\Http\Controllers;

use App\Group;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class GroupController extends Controller
{
    //

    public function new(Request $request)
    {
        return Inertia::render('Pages/CreateGroup', []);
    }
    public function create(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'string|min:6|required',
            'description' => 'string',
            'subject' => 'string',
        ]);

        $group = new Group();
        $group->name = $validatedData['name'];
        $group->description = $validatedData['description'];
        $group->subject = $validatedData['subject'];
        $group->save();

        // Insert logged in user as owner.
        $group->members()->attach(Auth::user()->id, ['member_type' => 2]);

        return redirect()->route('dashboard');
    }
}
