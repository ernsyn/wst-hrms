<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;

use Illuminate\Support\Facades\Auth;

use App\User;

class AuthController extends Controller
{
    public function postChangePassword(Request $request, $id) {
        $data = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:5|required_with:confirm_new_password|same:confirm_new_password',
        ]);

        if (!(Hash::check($data['current_password'],  Auth::user()->password))) {
            response()->json(['errors'=> [
                'current_password' => ['The current password is incorrect.']
            ]], 422);
            return response()->json(['fail'=>'The current password is incorrect. Password was not successfully updated.']);
        } else {
            User::where('id', Auth::user()->id)->update([
                'password' => bcrypt($data['new_password'])
            ]);
            return response()->json(['success'=>'Password was successfully updated.']);
        }
    }
}
