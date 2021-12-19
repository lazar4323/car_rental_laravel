<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    use HasFactory;
    protected $fillable = ['date', 'time', 'sender_id' ,'receiver_id','vehicle_id','text'];

    public function vehicle()
    {
        return $this->belongsTo('\App\Models\Vehicle'); 
    }

    public function sender()
    {
        return $this->belongsTo('\App\Models\User','sender_id');
    }
    
}
