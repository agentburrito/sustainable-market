@extends('layouts.app')

@section('content')
<div class="row justify-content-center">

    <div class="col-md-9">
        <div class="card">

            <div class="card-header"><a href="">{{ $listing->category->parent->name }}</a>  >  <a href="{{ route('category.show', $listing->category) }}"> {{ $listing->category->name }}</a>  >  <a href="">{{ $listing->title }}</a></div>
            <img class="card-img-top" src="https://via.placeholder.com/350x150">
            <div class="card-body">
                <h4 class="card-title">{{ $listing->title }} <span class="float-right text-success">${{ number_format($listing->price, 2) }}</span></h4>
                <p class="card-text">
                    {{ $listing->description }}
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card">
            <div class="card-header">{{ __('Seller Information') }}</div>

            <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><h4><i class="fas fa-user"></i> {{ $listing->user->name }}</h4></li>
                        <li class="list-group-item"><i class="fas fa-phone"></i> {{ $listing->phone }}</li>
                        <li class="list-group-item"><i class="fas fa-map-marker"></i> {{ $listing->location }}</li>
                        <li class="list-group-item"><em>Posted {{ $listing->updated_at->diffForHumans() }} </em></li>
                      </ul>
            </div>
        </div>
    </div>
</div>
@endsection
