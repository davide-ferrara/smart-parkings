<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class RegistredUserController extends Controller
{
    public function create(){
        return view('auth.register');
    }

    public function store(){
        // valido l'input
        $validatedAttributes = request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:3'],
        ]);

        // salvo l'utente nel db
        $user = User::create($validatedAttributes);

        // log in
        Auth::login($user);

        // redirect alla home
        return redirect('/');
    }
}
