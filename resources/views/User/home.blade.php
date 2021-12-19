@extends('layouts.app')


@section('title1')
    All Cars
@endsection


@section('deposit')
<a href="{{ route('home.addDeposit') }}" class="btn btn-dark" style="margin-left: 15px;">Add deposit</a>
<p class="text-sm text-gray-700 dark:text-gray-500" style="margin: 8px 0 0 15px;">Deposit: {{ Auth::user()->deposit }} €</p>
@endsection


@section('content')

<a href="{{ route('user.showReplies') }}" class="btn btn-dark form-control" style="width: 15%; position:absolute; right:20px; top:135px;">Show replies from admin</a>

<form action="" method="GET" action="{{ route('user.home') }}">
    <div class="input-group" style="width: 15%; position:absolute; right: 20px;">
        <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search"
        aria-describedby="search-addon" name="search" />
        <button type="submit" class="btn btn-outline-dark">Search</button>
      </div>
</form>
<div class="container">
    <div class="row">
        <div class="col-6">
            @foreach ($all_vehicles as $vehicle)
                <div class="card mb-3">
                    <h5 class="card-title"  style="margin: 15px 15px 0 0; text-align: right;">{{ $vehicle->daily_price }} €</h5>
                    <img class="card-img-top" src="/images/{{ $vehicle->image }}" alt="Card image cap">
                    <div class="card-body">
                    <h5 class="card-title">{{ $vehicle->make }}</h5>
                    <h5 class="card-title">{{ $vehicle->model }}</h5>
                    <p class="card-text">{{ $vehicle->description }}</p>
                    @if (Auth::user()->deposit > $vehicle->daily_price)
                        <a class="btn btn-dark" href="{{ route('home.rentView',['id'=>$vehicle->id]) }}" >Rent</a>
                    @else
                    <div class="alert alert-danger" role="alert">
                        Sorry you dont have enough money for rent.    
                      </div>
                    @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
