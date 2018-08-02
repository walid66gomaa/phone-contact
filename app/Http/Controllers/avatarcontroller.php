<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class avatarcontroller extends Controller
{
    public function avatar()
    {
        return view('vue_avatar');
    }
}
