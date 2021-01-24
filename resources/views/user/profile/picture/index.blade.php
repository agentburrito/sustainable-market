@extends('user.layouts.default')

@section('user.content')
<div class="card">
    <div class="card-body">
        <p>Current Profile Picture:</p>
        @if(Auth::user()->picture)
        <img src="{{ Auth::user()->picture }}" class="rounded-circle" style="height: 10rem;" alt="">
        @else 
        None. 
        @endif

        <hr>
        <form action="{{ route('user.profile.picture.store', [], false) }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="form-group">

                <label for="name">Profile Picture:</label>
                <input type="file" class="form-control-file {{ $errors->has('picture') ? ' is-invalid' : '' }}" name="picture" id="picture" required>
                @if($errors->has('picture'))
                    <div class="invalid-feedback">{{ $errors->first('picture') }}</div>
                @endif

            </div>

            <button type="submit" class="btn btn-primary">Update Profile Picture</button>
        </form>
    </div>
</div>
@endsection
