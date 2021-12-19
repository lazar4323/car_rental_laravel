@extends('layouts.app')

@section('title')
    Add Deposit
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8">
            <form action="{{ route('home.addDeposit') }}" method="POST">
                @csrf
                <h4><label for="deposit">Add deposit</label></h4>
                <input type="text" placeholder="Deposit" name="deposit" class="form-control"><br>
                @error('deposit')
                    <p class="bg-warning">{{ $errors->first('deposit') }}</p>
                @enderror
                <button type="submit" class="btn btn-dark">Add</button>
            </form>
        </div>
    </div>
</div>
@endsection
