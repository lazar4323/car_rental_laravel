<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class AdminController extends Controller
{   

    public function welcome()
    {
        $all_vehicles = Vehicle::all();
        return view('welcome',compact('all_vehicles'));
    }
}
