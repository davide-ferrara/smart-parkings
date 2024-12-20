<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public static function create(Request $request)
    {
        return view('auth.login');
    }

    public static function store(Request $request)
    {
        // validate
        $validatedAttributes = request()->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        // wrong credential
        if (! Auth::attempt($validatedAttributes)) {
            throw ValidationException::withMessages([
                'email' => 'Sorry, those credentials do not match.',
            ]);
        }

        $request->session()->regenerate();

        // redirect
        return redirect('/');

    }

    public static function destroy(Request $request)
    {
        Auth::logout();

        return redirect('/');
    }
}
