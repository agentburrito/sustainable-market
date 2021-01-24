@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-3">
        @include('organizations.layouts.partials._navigation')
    </div>
    <div class="col-md-9">
        @yield('organization.content')
    </div>
</div>
@endsection
