@extends('layouts.app')

@section('title')
    All replies from admin
@endsection



@section('content')
<a href="{{ route('user.home') }}" class="btn btn-dark" style="position:absolute; right:50px;">Back to home page.</a>
<div class="container">
    <div class="row">
        <div class="col-8">
            <h4>All replies</h4>
                @foreach ($replies as $reply)
                        <div class="card mb-3">
                            <h5 class="card-title">Car: {{ $reply->vehicle->make }} {{ $reply->vehicle->model }} <span style="float: right; margin: 10px 10px 10px 10px;"> Created at: {{ $reply->created_at->format('d-m-Y') }}</span></h5>
                            <img class="card-img-top" src="/images/{{ $reply->vehicle->image }}" alt="Card image cap">
                            <div class="card-body">
                            <h5 class="card-title">From: {{ $reply->sender->name }}</h5>
                            <h5 class="card-title">Date of accepting/declining: {{ $reply->date }}</h5>
                            <p class="card-text">Time of accepting/declining: {{ $reply->time }}</p>
                            <p class="card-text">
                                @if ($reply->text == "Rent accepted.")
                                <div class="alert alert-success" role="alert">
                                    {{ $reply->text }}
                                  </div>
                                @else
                                <div class="alert alert-danger" role="alert">
                                    Sorry rent was declined.
                                </div>
                                @endif
                                
                            </p>
                            </div>
                        </div>
                @endforeach
        </div>
    </div>
</div>
@endsection