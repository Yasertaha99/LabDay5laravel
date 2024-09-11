@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="{{$user->image}}" alt="Card image cap">
                            <div class="card-body">
                                <p class="card-text">{{$user->name}}</p>
                                <p class="card-text">{{$user->email}}</p>

                            </div>
                        </div>

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
