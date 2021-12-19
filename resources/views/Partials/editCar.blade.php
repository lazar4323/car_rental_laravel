@extends('layouts.app')

@section('title')
    Edit car
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8">
            <h4>Edit car</h4>
            <form action="{{ route('home.updateCar',['id'=>$vehicle->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method("put")
                <input type="text" name="make" placeholder="Make" class="form-control" value="{{ $vehicle->make }}"><br>
                <input type="text" name="model" placeholder="Model" class="form-control"  value="{{ $vehicle->model }}"><br>
                <textarea name="description" placeholder="Description" class="form-control" maxlength="5000">{{ $vehicle->description }}</textarea><br>
                <input type="number" name="daily_price" placeholder="Daily price" class="form-control"  value="{{ $vehicle->daily_price }}"><br>
                @if ("/images/{{ $vehicle->image }}")
                <div class="card mb-3">
                    <img class="card-img-top" src="/images/{{ $vehicle->image }}">
                </div>  
                @else
                    <p>No image found</p>
                @endif
                <br>
                <input type="file" name="image" class="form-control"><br>
                <button class="btn btn-dark" type="submit">Save</button>
            </form>
        </div>
    </div>
</div>
@endsection