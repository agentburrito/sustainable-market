@extends('user.layouts.default')

@section('user.content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('user.profile.update') }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="name" value="{{ old('name', auth()->user()->name) }}">
                @if($errors->has('name'))
                    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                @endif


            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="email" value="{{ old('email', auth()->user()->email) }}">
                @if($errors->has('email'))
                <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection
