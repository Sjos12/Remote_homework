<?php

namespace App\Http\Controllers;

use Facade\FlareClient\Http\Response;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    use ValidatesRequests;

    public function view() {
        $account = Auth::user();

        return view('account.edit')->with('account', $account);
    }

    public function edit(Request $request) {
        
        // User get's redirected to previous route if request doesn't pass validation. 
        $validated_data = $request->validate(
            [
                'name' => ['required', 'string', 'max:255', 'unique:users'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            ]);
        
        $request->user()->fill([
            'name' => $validated_data['name'] ?? $request->user()->name,
            'email' => $validated_data['email'] ?? $request->user()->email,
            //'password' => Hash::make('password') ?? $request->user()->password,
        ])->save();
        
        return redirect()->route('feed.list');
        
        }
}
