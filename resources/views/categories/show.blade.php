@extends('layouts.app')

@section('content')
<div class="row justify-content-center">

    <div class="col-md-3">
        <div class="card">
            <div class="card-header">Categories</div>
            <div class="card-body">


                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    @foreach($parentCategories as $pc)
                    @if($pc->children)
                    @foreach($pc->children as $child)
                        <a class="nav-link {{ return_if(on_page('category/' . $child->id), 'active') }}" href="{{ route('category.show', $child, false) }}">{{ $child->parent->name }} - {{ $child->name }}</a>
                    @endforeach
                    @endif
                    @endforeach 

                </div>
                


                
            </div>
        </div>
    </div>

    <div class="col-md-9">
        <div class="row">
            <h5>Results</h5>
        </div>
        <div class="row" style="margin-bottom: 1rem;">
            @foreach($adlistings as $listing)
            <div class="card" style="width: 15rem; margin-right: 1rem;">
                <img src="{{ $listing->image == NULL ? 'https://via.placeholder.com/150' : $listing->image }}" style="height: 15rem;" class="card-img-top img-responsive" alt="{{$listing->title}} Image">
                <div class="card-body">
                <h5 class="card-title">{{$listing->title}} <span class="float-right text-success">${{ number_format($listing->price, 2) }}</span></h5>
                <p class="card-text">{{$listing->description}}</p>
                <a href="{{ route('listing.show', $listing, false) }}" class="btn btn-light btn-block stretched-link float-right">View</a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="row">
            <div class="d-flex justify-content-center">
                {!! $adlistings->links() !!}
            </div>
        </div>

        @if($category->listings()->where('wanted', 1)->count() > 0)
        <hr>
        <div class="row">
            <h5>Charity Wanted</h5>
        </div>
        <div class="row">
            @foreach($category->listings()->where('wanted', 1)->get() as $listing)
            <div class="card" style="width: 15rem; margin-right: 1rem;">
                <img src="{{ $listing->image == NULL ? 'https://via.placeholder.com/150' : $listing->image }}" style="height: 15rem;" class="card-img-top img-responsive" alt="{{$listing->title}} Image">
                <div class="card-body">
                <h5 class="card-title">{{$listing->title}}</h5>
                <p class="card-text">{{$listing->description}}</p>
                <p class="card-text"><em>{{$listing->organization->name}}</em></p>
                <a href="{{ route('listing.show', $listing, false) }}" class="btn btn-light btn-block stretched-link float-right">View</a>
                </div>
            </div>
            @endforeach
        </div>
        @endif
        
    </div>
@endsection
