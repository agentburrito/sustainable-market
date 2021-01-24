@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">{{ __('Create a Listing') }}</div>

            <div class="card-body">
                <form action="{{ route('listing.store') }}" method="POST">
                    @csrf

                    <div class="form-group row">
                        <label for="title" class="col-md-4 col-form-label text-md-right">Listing Title</label>
                        <div class="col-md-6">
                            <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : ''}}" name="title" value="{{ old('title') }}" autofocus>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>
                        <div class="col-md-6">
                            <input id="description" type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : ''}}" name="description" value="{{ old('description') }}" >
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="category" class="col-md-4 col-form-label text-md-right">Category</label>

                        <div class="col-md-6">
                            <select class="form-control" name="category">
                                <option value="">Select Category:</option>

                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->parent->name }} - {{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="price" class="col-md-4 col-form-label text-md-right">Price</label>
                        <div class="col-md-6">
                            <input id="price" type="number" class="form-control{{ $errors->has('price') ? ' is-invalid' : ''}}" name="price" value="{{ old('price') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="contact" class="col-md-4 col-form-label text-md-right">Contact Number</label>
                        <div class="col-md-6">
                            <input id="contact" type="text" class="form-control{{ $errors->has('contact') ? ' is-invalid' : ''}}" name="contact" value="{{ old('contact') }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="location" class="col-md-4 col-form-label text-md-right">Location</label>
                        <div class="col-md-6">
                            <input id="location" type="text" class="form-control{{ $errors->has('location') ? ' is-invalid' : ''}}" name="location" value="{{ old('location') }}">
                        </div>
                    </div>


                    <div class="form-group">
                      <button type="submit" class="btn btn-success float-right">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
