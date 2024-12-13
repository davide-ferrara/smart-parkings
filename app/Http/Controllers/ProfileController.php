<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    static function create($id) {
        $User = User::find($id);
        dd($User->attributesToArray());
    }
}
