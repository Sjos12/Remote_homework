<?php

namespace App\Http\Controllers;

use App\Group;
use App\Invite;
use Carbon\Carbon;
use DateTime;
use Faker\Provider\Uuid;
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

    public function group_detail(Request $request, Group $group)
    {
        $group->load(['members', 'invite', 'questions']);
        return Inertia::render('Pages/GroupDetail', ['group' => $group]);
    }

    public function invite_generate(Group $group)
    {
        // Check if we have authorization to generate invite link.
        if (!$group->members()->where('user_id', Auth::user()->id)->where('member_type', '>', 0)) return;

        // Generate invite
        $invite = new Invite();
        $invite->group_id = $group->id;
        $invite->invite_code = Uuid::uuid();
        $invite->expires_at = Carbon::now()->addDays(3)->toDateTimeString();
        $invite->save();

        // Send invite object back to frontend for sharing.
        return redirect()->route('group.detail', $group);
    }
    public function join(Request $request)
    {
        $validatedData = $request->validate([
            'groupCode' => 'required|exists:invites,invite_code',
        ]);

        $invite = Invite::where('invite_code', $validatedData)->first();

        if (!$invite) return back()->withErrors([
            'Sorry, this invite code is invalid'
        ]);

        $expiry = new DateTime($invite->expires_at);
        $now = new DateTime();
        if ($expiry < $now) {
            $invite->delete();
            return back()->withErrors([
                'Sorry, This invite code is expired'
            ]);
        }
        $group = $invite->group;

        if ($group->members()->where('groups.user_id', Auth::user()->id)) {
            return back()->withErrors([
                'You have already joined this group'
            ]);
        }

        $group->members()->attach(Auth::user()->id);

        return back();
    }
}
