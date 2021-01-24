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
                        <a class="nav-link {{ return_if(on_page('category/' . $child->id), 'active') }}" href="{{ route('category.show', $child) }}">{{ $child->parent->name }} - {{ $child->name }}</a>
                    @endforeach
                    @endif
                    @endforeach 

                </div>
                


                
            </div>
        </div>
    </div>

    <div class="col-md-9">
        @foreach($category->listings as $listing)
            <div class="card" style="width: 12rem;">
                <img src="https://via.placeholder.com/250" class="card-img-top" alt="{{$listing->title}} Image">
                <div class="card-body">
                <h5 class="card-title">{{$listing->title}}</h5>
                <p class="card-text">{{$listing->description}}</p>
                <a href="{{ route('listing.show', $listing) }}" class="btn btn-primary">View</a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
