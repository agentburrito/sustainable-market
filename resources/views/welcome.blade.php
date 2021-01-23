@extends('layouts.app')

@section('content')
<div class="row ml-auto">
    @foreach(\App\Models\Category::where('parent_id', null)->withCount('listings')->get() as $category)
        <div class="list-group px-2">
            <div class="list-group-item active">
                <a href="" class="text-white">
                    <span><strong>{!!$category->name!!}</strong> ({!! $category->listings_count !!})</span>
                </a>                                
            </div>
            @foreach($category->children as $subcategory)                                  
                <a href="" class="list-group-item"> {!!$subcategory->name!!} <span class="badge">{!! $subcategory->listings_count !!}</span></a>
            @endforeach	                                
        </div>
    @endforeach           
</div>
@endsection
