@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <h5>{{ $organization->name }} </h5>
</div>
<div class="row justify-content-center">
    <p>{{ $organization->description }}</p>
</div>
<div class="row justify-content-center">
    <p>Active listings: {{ $organization->listings->count() }}</p>
</div>

<hr>

<div class="row justify-content-center">
@foreach($organization->listings as $clisting)
    <div class="card" style="width: 10rem; margin-right: 1rem; margin-bottom: 1rem;">
        <img src="{{ $clisting->image == NULL ? 'https://via.placeholder.com/150' : $clisting->image }}" style="height: 10rem;" class="card-img-top img-responsive" alt="{{$clisting->title}} Image">
        <div class="card-body">
        <h5 class="card-title">{{$clisting->title}} <span class="text-xs float-right text-success"><h6>${{number_format($clisting->price)}}</h6></span></h5>
        <p class="card-text">{{$clisting->description}}</p>
        <a href="{{ route('listing.show', $clisting, false) }}" class="btn btn-light btn-block stretched-link float-right">View</a>
        </div>
    </div>
@endforeach
</div>
@endsection
