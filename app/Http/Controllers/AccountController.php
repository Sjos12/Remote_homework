<?php

namespace App\Http\Controllers;

use App\User;
use Facade\FlareClient\Http\Response;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    use ValidatesRequests;

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('profiles');
    }

    public function view() {
        $account = Auth::user();

        $model = User::find($account->id);
        $url = $model->getMedia('profiles');
        
        return view('account.edit')->with('account', $model);
    }

    public function edit(Request $request) {

        // User get's redirected to previous route if request doesn't pass validation. 
        $validated_data = $request->validate(
            [
                'name' => ['nullable', 'string', 'max:255', 'unique:users,name,'.$request->user()->id.''],
                'email' => ['nullable', 'string', 'email', 'max:255', 'unique:users,email,'.$request->user()->id.''],
                'description' => ['nullable', 'string', 'max:255'],
                'image' => ['required', 'image']
            ]);
        
        $request->user()->fill([
            'name' => $validated_data['name'] ?? $request->user()->name,
            'email' => $validated_data['email'] ?? $request->user()->email,
            'description' =>$validated_data['description'] ?? '',
            //'password' => Hash::make('password') ?? $request->user()->password,
        ])->save();
        
        if ($validated_data['image']) {
            $request->user()->clearMediaCollection('profiles');
            $request->user()->addMedia($validated_data['image'])->toMediaCollection('profiles');
        }
        
        return redirect()->route('feed.list');
        
        }
}
