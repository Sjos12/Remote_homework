<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    //
    function view() {
        $account = Auth::user();

        return view('account.view')->with('account', $account);
    }
    function edit() {
        return;
    }
}
