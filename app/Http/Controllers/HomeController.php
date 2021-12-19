<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Rent;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return voidp
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $all_vehicles = Vehicle::where('user_id',Auth::user()->id)->get();
        return view('vehicles.allVehicles',compact('all_vehicles'));
    }

    public function addDeposit()
    {

        return view('partials.addDeposit');
    }

    public function updateDeposit(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            "deposit"=>"required|max:6"
        ],[
            "deposit.max"=>"Cant add more than 999999 € at once"
        ]);

        $user->deposit = $user->deposit + $request->deposit;
        $user->save();

        return redirect(url('/user'));

    }

    public function newCar()
    {
        return view('partials.newCar');
    }

    public function saveCar(Request $request)
    {
        
        $request->validate([
            'make'=>'required|max:20',
            'model'=>'required|max:20',
            'daily_price'=>'required',
            'description'=>'required',
            'image'=>'required'
        ]);
            $image = $request->file('image');
            $image_name = time().'1.'.$image->extension();
            $image->move(public_path('images'),$image_name);

        Vehicle::create([
            'make'=>$request->make,
            'model'=>$request->model,
            'daily_price'=>$request->daily_price,
            'description'=>$request->description,
            'image'=>$image_name,
            'user_id'=>auth()->id()
        ]);

        return redirect(route('home.vehicles'));
    }

    public function editCar($id)
    {  
       $vehicle = Vehicle::find($id);
       return view('partials.editCar',compact('vehicle')); 
    }

    public function updateCar(Request $request,$id)
    {
        $vehicle = Vehicle::find($id);
        $vehicle->make = $request->input('make');
        $vehicle->model = $request->input('model');
        $vehicle->daily_price = $request->input('daily_price');
        $vehicle->description = $request->input('description');
        
        if ($request->hasFile('image')) {
            $destination = '/images/'.$vehicle->image;
            if(File::exists($destination)){
                File::delete($destination);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'1.'.$extension;
            $file->move(public_path('images'),$filename);
            $vehicle->image = $filename;
        }

        $vehicle->update();
        
        return redirect(route('home.vehicles'));
        
    }

    public function showRents()
    {
        $rents = Rent::where('receiver_id',auth()->user()->id)->get();
        return view('partials.rents',compact('rents'));
    }
    
    public function reply(Request $request)
    {
        $sender_id = request()->sender_id;
        $vehicle_id = request()->vehicle_id;
        
        $rents = Rent::where('sender_id',$sender_id)->where('vehicle_id',$vehicle_id)->get();

        return view('partials.reply',compact('sender_id','vehicle_id','rents'));
    }

    public function replyStore(Request $request)
    {
        $sender = User::find($request->sender_id);
        $vehicle = Vehicle::find($request->vehicle_id);

        $user = User::find($request->sender_id);
        $daily_price = $vehicle->daily_price;
        $user->deposit = $user->deposit - $daily_price;
        $user->save();

        $msg = new Rent();
        $msg->date = Carbon::now();
        $msg->time = Carbon::now();
        $msg->text = $request->text;
        $msg->sender_id = auth()->user()->id;
        $msg->receiver_id = $sender->id;
        $msg->vehicle_id = $vehicle->id;
        $msg->save();

        return redirect()->route('home.showRents')->with('rented','Reply sent');
    }

    public function deleteVehicle($id)
    {
        $vehicle = Vehicle::find($id);
        $vehicle->delete();
    
        return redirect()->back();
    }

}
