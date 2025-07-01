<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function loginSubmit(Request $request)
    {
        // form validation
        $request->validate(
            // rules
            [
                'text_username' => 'required|email',
                'text_password' => 'required|min:6|max:16'
            ],
            // error messages
            [
                'text_username.required' => 'Username is mandatory. ',
                'text_username.email' => 'Username must be a valid e-mail address. ',
                'text_password.required' => 'Password is mandatory. ',
                'text_password.min' => 'Password must be at least :min characters long. ',
                'text_password.max' => 'Password must at most :max characters long. ',
            ]
        );

        // get user input
        $username = $request->input('text_username');
        $password = $request->input('text_password');

        // checks if user exists
        $user = User::where('username', $username)
            ->where('deleted_at', NULL)
            ->first();

        if (!$user) {
            return redirect()
                ->back()
                ->withInput()
                ->with('loginError', 'Authentication failure. ');
        }

        // checks if password is correct
        if (!password_verify($password, $user->password)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('loginError', 'Authentication failure. ');
        }

        // updates last login
        $user->last_login = date('Y-m-d H:i:s');
        $user->save();

        // login user
        session([
            'user' => [
                'id' => $user->id,
                'username' => $user->username
            ]
        ]);

        // redirect to home 
        return redirect()->to('/');

    }

    public function logout()
    {
        session()->forget('user');
        return redirect()->to('/login');
    }
}
