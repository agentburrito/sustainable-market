@extends('layouts.app')

@section('content')
<div class="row justify-content-center">

    <div class="col-md-9">
        <div class="card">

            <div class="card-header"><a href="">{{ $listing->category->parent->name }}</a>  >  <a href="{{ route('category.show', $listing->category) }}"> {{ $listing->category->name }}</a>  >  <a href="">{{ $listing->title }}</a></div>
            <img class="card-img-top" style="width: 100%; height: 18vw; object-fit: cover;" src="{{ $listing->image == NULL ? 'https://via.placeholder.com/350x150' : $listing->image }}">
            <div class="card-body">
                <h4 class="card-title">{{ $listing->title }} <span class="float-right text-success">{{ $listing->wanted ? $listing->organization->name : '$'.number_format($listing->price, 2) }}</span></h4>
                <p class="card-text">
                    {{ $listing->description }}
                </p>
            </div>
            @if($listing->user == Auth::user())
            <div class="card-footer">
                <a href="{{ route('listing.edit', $listing) }}" class="float-right btn btn-warning">Edit Posting</a>
            </div>
            @endif
        </div>
    </div>

    <div class="col-md-3">
        <div class="card">
            <div class="card-header">{{ $listing->wanted ? 'Charity Contact Information' : 'Seller Information' }}</div>

            <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <a href="{{ route('user.profile.show', $listing->user) }}">
                                <h4><i class="fas fa-user"></i> {{ $listing->user->name }}</h4>
                            </a>
                            @if($listing->wanted)
                            (On behalf of: <a href="{{ route('organization.show', $listing->organization) }}">{{ $listing->organization->name }})</a>
                            @endif

                        </li>
                        <li class="list-group-item"><i class="fas fa-phone"></i> {{ $listing->phone }}</li>
                        <li class="list-group-item"><i class="fas fa-map-marker"></i> {{ $listing->location }}</li>
                    </ul>
            </div>

            <div class="card-footer">
                <small class="text-muted">Last updated {{ $listing->updated_at->diffForHumans() }} </small>
              </div>
        </div>
    </div>
</div>

@if($listing->wanted == false and $listing->category->listings()->where('wanted', 1)->count() > 0)
<br>
<hr>

<div class="row">
    <h5>Do you have an item to donate?</h5>
</div>
<div class="row">
    <div class="col-md-12">
        @foreach($listing->category->listings()->where('wanted', 1)->get() as $clisting)
            <div class="card" style="width: 10rem; margin-right: 1rem;">
                <img src="{{ $clisting->image == NULL ? 'https://via.placeholder.com/150' : $clisting->image }}" style="height: 10rem;" class="card-img-top img-responsive" alt="{{$clisting->title}} Image">
                <div class="card-body">
                <h5 class="card-title">{{$clisting->title}}</h5>
                <p class="card-text">{{$clisting->description}}</p>
                <p class="card-text"><em>{{$clisting->organization->name}}</em></p>
                <a href="{{ route('listing.show', $clisting) }}" class="btn btn-light btn-block stretched-link float-right">View</a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endif

@endsection
