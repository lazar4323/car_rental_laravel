@extends('layouts.app')

@section('title')
    Rents
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8">
            <h4>All Rents</h4>
                @foreach ($rents as $rent)
                    <div class="card mb-3">
                        <h5 class="card-title">Car: {{ $rent->vehicle->make }} {{ $rent->vehicle->model }} <span style="float: right; margin: 10px 10px 10px 10px;"> Created at: {{ $rent->created_at->format('d-m-Y') }}</span></h5>
                        <img class="card-img-top" src="/images/{{ $rent->vehicle->image }}" alt="Card image cap">
                        <div class="card-body">
                        <h5 class="card-title">From: {{ $rent->sender->name }}</h5>
                        <h5 class="card-title">Date of renting: {{ $rent->date }}</h5>
                        <p class="card-text">Time of renting: {{ $rent->time }}</p>
                        </div>
                    </div>
                @endforeach
                    <li class="list-group-item mb-2">
                        <form action="{{ route('home.replyStore') }}" method="POST">
                            @csrf
                            <input type="hidden" name="sender_id" value="{{ $sender_id }}">
                            <input type="hidden" name="vehicle_id" value="{{ $vehicle_id }}">
                            <textarea name="text" class="form-control" cols="30" rows="10"></textarea><br>
                            <button type="submit" class="btn btn-dark">Reply</button>
                        </form>
                    </li>
        </div>
    </div>
</div>
@endsection
