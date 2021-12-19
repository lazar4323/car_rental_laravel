@extends('layouts.app')

@section('title')
    All Cars
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-4">
            <a href="{{ route('home.newCar') }}" class="btn btn-secondary form-control m-2">New Car</a>
            <a href="{{ route('home.showRents') }}" class="btn btn-secondary form-control m-2">Rent requests</a>
        </div>
        <div class="col-8">
            <h4>All Cars</h4>
            @foreach ($all_vehicles as $vehicle)
                <div class="card mb-3">
                    <h5 class="card-title"  style="margin: 15px 15px 0 0; text-align: right;">{{ $vehicle->daily_price }} €</h5>
                    <img class="card-img-top" src="/images/{{ $vehicle->image }}" alt="Card image cap">
                    <div class="card-body">
                    <h5 class="card-title">{{ $vehicle->make }}</h5>
                    <h5 class="card-title">{{ $vehicle->model }}</h5>
                    <p class="card-text">{{ $vehicle->description }}</p>
                    <a href="{{ route('home.editCar',['id'=>$vehicle->id]) }}" class="btn btn-dark">Edit car</a>
                    <a href="{{ route('home.deleteVehicle',['id'=>$vehicle->id]) }}" class="btn btn-danger">Delete vehicle</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
