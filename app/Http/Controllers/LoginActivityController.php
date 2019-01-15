<?php

namespace App\Http\Controllers;

use App\LoginActivity;
use Illuminate\Http\Request;

class LoginActivityController extends Controller
{
    public function index()
    {
        $loginActivities = LoginActivity::all();//whereUserId(auth()->user()->id)->latest()->paginate(10);
        return view('pages.admin.login-activity', compact('loginActivities'));
    }
}
