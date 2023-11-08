<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    
    public function profile(){
        echo "hai";
        return view("profile");
     }
}
