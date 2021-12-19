@extends('layouts.app')

@section('title')
    Rent a car
@endsection

@section('deposit')
<a href="{{ route('home.addDeposit') }}" class="btn btn-dark" style="margin-left: 15px;">Add deposit</a>
<p class="text-sm text-gray-700 dark:text-gray-500" style="margin: 8px 0 0 15px;">Deposit: {{ Auth::user()->deposit }} €</p>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8">
            <h4>Rent a car</h4>
            <form action="{{ route('home.rentVehicle',['id'=>$vehicle->id]) }}" method="POST">
                @csrf
                <input type="date" name="date" placeholder="Date" class="form-control"><br>
                <input type="time" name="time" placeholder="Time" class="form-control"><br>
                <textarea name="text" class="form-control" cols="30" rows="10"></textarea><br>
                <button class="btn btn-dark" type="submit">Rent</button>
            </form><br>
            @if (session()->has('rent'))
                <div class="alert alert-success">
                    {{ session()->get('rent') }}
                </div>
            @else
                
            @endif
        </div>
    </div>
</div>
@endsection