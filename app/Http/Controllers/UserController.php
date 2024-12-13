<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    // App\Models\User::find(1)
    public static function find($id)
    {
        $user = User::all();
        $user = User::findOrFail($id);
        return $user->attributesToArray();
    }
}
