@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">{{ __('Create a Listing') }}</div>

            <div class="card-body">
                <form action="{{ route('listing.update', $listing, false) }}" method="POST" enctype="multipart/form-data">
                    {{ method_field('PATCH') }}
                    @csrf

                    @if($listing->wanted) 
                        <div class="form-group row">
                            <label for="organization_name" class="col-md-4 col-form-label text-md-right">{{ __('Organization Name') }}</label>

                            <div class="col-md-6">
                                <input id="organization_name" type="text" class="form-control" value="{{ Auth::user()->organizations->first()->name }}" disabled>
                                <p><em>You are posting a WANTED ad on behalf of your organization.</em></p>

                                <input id="organization_name" type="hidden" name="organization_name" value="{{ Auth::user()->organizations->first()->name }}">
                                <input id="organization_id" type="hidden" name="organization_id" value="{{ Auth::user()->organizations->first()->id }}">

                            </div>
                        </div>
                        <hr>
                    @endif


                    <div class="form-group row">
                        <label for="image" class="col-md-4 col-form-label text-md-right">Image</label>
                        <div class="col-md-6">
                            <input id="image" type="file" class="form-control-file{{ $errors->has('image') ? ' is-invalid' : ''}}"  name="image">
                        </div>
                        @if($errors->has('image'))
                            <div class="invalid-feedback">{{ $errors->first('image') }}</div>
                        @endif
                    </div>

                    <div class="form-group row">
                        <label for="title" class="col-md-4 col-form-label text-md-right">Listing Title</label>
                        <div class="col-md-6">
                            <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : ''}}" name="title" value="{{ $listing->title }}" autofocus>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>
                        <div class="col-md-6">
                            <textarea id="description" rows="4" class="form-control{{ $errors->has('description') ? ' is-invalid' : ''}}" name="description">{{$listing->description}}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="category" class="col-md-4 col-form-label text-md-right">Category</label>

                        <div class="col-md-6">
                            <select class="form-control" name="category">
                                <option value="">Select Category:</option>

                                @foreach ($categories as $category)
                                    <option {{ $listing->category_id == $category->id ? 'selected' : ''}} value="{{ $category->id }}">{{ $category->parent->name }} - {{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    @if(!$listing->wanted) 
                    <div class="form-group row">
                        <label for="price" class="col-md-4 col-form-label text-md-right">Price</label>
                        <div class="col-md-6 input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">$</div>
                            </div>
                            <input id="price" type="number" class="form-control{{ $errors->has('price') ? ' is-invalid' : ''}}" name="price" value="{{ $listing->price }}">
                        </div>
                    </div>
                    @endif

                    <div class="form-group row">
                        <label for="contact" class="col-md-4 col-form-label text-md-right">Contact Number</label>
                        <div class="col-md-6">
                            <input id="contact" type="text" class="form-control{{ $errors->has('contact') ? ' is-invalid' : ''}}" name="contact" value="{{ $listing->phone }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="location" class="col-md-4 col-form-label text-md-right">Location</label>
                        <div class="col-md-6">
                            <input id="location" type="text" class="form-control{{ $errors->has('location') ? ' is-invalid' : ''}}" name="location" value="{{ $listing->location }}">
                        </div>
                    </div>


                    <div class="form-group">
                      <button type="submit" class="btn btn-success float-right">Update Posting</button>
                    </div>
                </form>
            </div>

            <form method="POST" action="{{ route('listing.destroy', $listing, false) }}">
                @csrf 
                {{ method_field('DELETE') }}

                <div class="card">
                    <div class="card-footer">
                        <div class="pull-right">
                            <button class="btn btn-danger text-white" type="submit">Delete Listing</button>
                        </div>
                    </div>
                </div>
            </form>


        </div>
    </div>
</div>
@endsection
