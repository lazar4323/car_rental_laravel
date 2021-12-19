<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\Rent;

class VehicleController extends Controller
{
    public function rentView($id)
    {
        $vehicle = Vehicle::find($id);
        return view('partials.rentView',compact('vehicle'));
    }

    public function rentVehicle(Request $request,$id)
    {
        $vehicle = Vehicle::find($id); //koja makina
        
        $vehicle_owner = $vehicle->user; //vlasnik makine
        //novi request
        $new_rent = new Rent();
        $new_rent->date = $request->date;
        $new_rent->time = $request->time;
        $new_rent->text = $request->text;
        $new_rent->sender_id = auth()->user()->id;
        $new_rent->receiver_id = $vehicle_owner->id;
        $new_rent->vehicle_id = $vehicle->id;
        $new_rent->save(); 

        return redirect()->back()->with('rent','Rent sent');
    }
}
