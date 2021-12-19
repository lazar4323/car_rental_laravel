<?php

namespace App\Http\Controllers;

use App\Models\Rent;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use DB;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $search = $request->get('search');
        $all_vehicles = Vehicle::all();
        $all_vehicles = DB::table('vehicles')->where('make','like','%'.$search.'%')->paginate(500);
        return view('user.home',compact('all_vehicles'));
    }

    public function showReplies()
    {
        $replies = Rent::where('receiver_id',auth()->user()->id)->get();
        return view('user.showReplies',compact('replies'));
    }


}
