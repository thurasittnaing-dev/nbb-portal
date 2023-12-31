<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function dashboard(Request $request)
    {
        return view('backend.page.dashboard');
    }
}
