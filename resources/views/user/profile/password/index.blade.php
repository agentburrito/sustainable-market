@extends('user.layouts.default')

@section('user.content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('user.profile.password.update') }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group">

                <label for="name">Current Password:</label>
                <input type="password" class="form-control {{ $errors->has('current') ? ' is-invalid' : '' }}" name="current" id="current" value="" required>
                @if($errors->has('current'))
                    <div class="invalid-feedback">{{ $errors->first('current') }}</div>
                @endif


            </div>

            <hr>

            <div class="form-group">
                <label for="password">New Password:</label>
                <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="password" value="" required>
                @if($errors->has('password'))
                <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                @endif
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm Password:</label>
                <input type="password" class="form-control {{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" id="password_confirmation" value="" required>
                @if($errors->has('password_confirmation'))
                <div class="invalid-feedback">{{ $errors->first('password_confirmation') }}</div>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection
