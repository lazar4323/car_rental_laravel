@extends('layouts.app')

@section('title')
    Add new car
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8">
            <h4>Add new car</h4>
            <form action="{{ route('home.saveCar') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="text" name="make" placeholder="Make" class="form-control"><br>
                <input type="text" name="model" placeholder="Model" class="form-control"><br>
                <textarea name="description" placeholder="Description" class="form-control"></textarea><br>
                <input type="number" name="daily_price" placeholder="Daily price" class="form-control"><br>
                <input type="file" name="image" class="form-control"><br>
                <button class="btn btn-dark" type="submit">Save</button>
            </form>
        </div>
    </div>
</div>
@endsection