@extends('organizations.layouts.default')

@section('organization.content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('organization.update', $organization, false) }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="name" value="{{ old('name', $organization->name) }}">
                @if($errors->has('name'))
                    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                @endif


            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea rows="3" class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" id="description">{{ old('description', $organization->description) }}</textarea>
                @if($errors->has('description'))
                <div class="invalid-feedback">{{ $errors->first('description') }}</div>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection
