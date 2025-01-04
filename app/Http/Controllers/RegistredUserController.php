<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserCredit;
use Illuminate\Support\Facades\Auth;

class RegistredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store()
    {
        // valido l'input
        $validatedAttributes = request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:3'],
        ]);

        // salvo l'utente nel db
        $user = User::create($validatedAttributes);

        // assegno credito zero
        UserCredit::create([
            'user_id' => $user->id,
            'total' => 0,
        ]);

        // log in
        Auth::login($user);

        // redirect alla home
        return redirect('/');
    }
}
