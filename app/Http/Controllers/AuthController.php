<?php

namespace App\Http\Controllers;

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
                'text_username.required' => 'O username é obrigatório. ',
                'text_username.email' => 'Username deve ser um e-mail válido. ',
                'text_password.required' => 'A senha é obrigatória. ',
                'text_password.min' => 'A senha deve ter pelo menos :min caracteres. ',
                'text_password.max' => 'A senha deve ter no máximo :max caracteres. ',
            ]
        );

        // get user input
        $username = $request->input('text_username');
        $password = $request->input('text_password');

        // test database connection 
        try {
            DB::connection()->getPdo();
            echo 'Connection OK';
        } catch (\PDOException $e) {
            echo "Connection Failed: " . $e->getMessage();
        }
        echo "FIM";
    }

    public function logout()
    {
        echo 'logout';
    }
}
