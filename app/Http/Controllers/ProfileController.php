<?php

namespace App\Http\Controllers;

use App\Models\User;

class ProfileController extends Controller
{
    public static function create($id)
    {
        try {
            $User = User::find($id);

            return view('profile.info', ['user' => $User]);
        } catch (\Exception $e) {
            abort(503, $e->getMessage());
        }

    }

    public static function update($id)
    {
        // valido l'input
        try {
            $validatedAttributes = request()->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            ]);

            $user = User::findOrFail($id);
            $user->update($validatedAttributes);

            return redirect('/profile/'.$id)->with('success', 'Profile updated successfully!');

        } catch (\Exception $e) {
            return redirect('/profile/'.$id)->withErrors([$e->getMessage()]);
        }
    }

    public function buyParkingView()
    {
        return view('profile.buy_parking');
    }
}
