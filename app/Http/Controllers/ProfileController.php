<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;

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
                'name' => ['nullable', 'string', 'max:255'],
                'surname' => ['nullable', 'string', 'max:255'],
                'email' => ['nullable', 'string', 'email', 'max:255'],
                'password' => ['nullable', 'string', 'min:3'],
            ]);

            $user = User::findOrFail($id);

            if (!empty($validatedAttributes['name'])){
                $user->name = ($validatedAttributes['name']);
            }

            if (!empty($validatedAttributes['surname'])){
                $user->surname = ($validatedAttributes['surname']);
            }

            if (!empty($validatedAttributes['phone_number'])){
                $user->phone_number = ($validatedAttributes['phone_number']);
            }

            if (!empty($validatedAttributes['password'])) {
                $user->password = bcrypt($validatedAttributes['password']); // Assicurati di criptare la password
            }

            $user->save(); // Salva le modifiche

            return redirect('/profile/'.$id)->with('success', 'Profile updated successfully!');

        } catch (\Exception $e) {
            return redirect('/profile/'.$id)->withErrors([$e->getMessage()]);
        }
    }

    public function activeParkingView($id) {

        //$active_parking = DB::table('parking_lots')->where('id', "=",  $id)->where('curr_status', '=', 1)->get();

        return view('profile.active_parking');
    }
}
