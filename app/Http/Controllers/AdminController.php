<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class AdminController extends Controller
{
    public static function panelView(): View
    {
        return view('admin.panel');
    }
}
