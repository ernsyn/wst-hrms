<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;
use Illuminate\Validation\UnauthorizedException;
use App\Helpers\AccessControllHelper;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
//     protected $redirectTo = '/home';

    protected function redirectTo() {
        if(\Auth::user()->hasRole('Super Admin')) {
            return route("super-admin.dashboard");
        }
        
        return route("employee.dashboard");
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');;
    }
    
    protected function authenticated(Request $request, $user)
    {
        
        if(AccessControllHelper::isResigned()) {
            \Auth::logout();
            abort(403, 'Unauthorized.');
        }
        
        if(\Auth::user()->hasRole('Super Admin')) {
            return redirect()->route("super-admin.dashboard");
        }
    }
}
