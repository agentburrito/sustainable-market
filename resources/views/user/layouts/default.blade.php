@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-3">
        @include('user.layouts.partials._navigation')
    </div>
    <div class="col-md-9">
        @yield('user.content')
    </div>
</div>
@endsection
