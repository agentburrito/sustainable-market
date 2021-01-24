<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item border-right">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    
                    <li class="nav-item border-right">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>

                    <li class="nav-item ">
                        <a class="nav-link" href="{{ route('register', ['organization' => true]) }}">{{ __('Organization Register') }}</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="fas fa-user"></i>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('user.profile.index') }}"">
                                {{ __('My Profile') }}
                            </a>

                            @if(Auth::user()->hasRole('admin'))
                                <a class="dropdown-item" href="{{ route('category.index') }}"">
                                    {{ __('Manage Categories') }}
                                </a>
                            @endif

                            @if(Auth::user() and Auth::user()->organizations->count())
                                <a class="dropdown-item" href="{{ route('organization.edit', Auth::user()->organizations->first()) }}">
                                    {{ __('Manage Organization') }}
                                </a>
                            @endif


                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest

                <li class="nav-item" style="margin-left: 1rem;">
                    <a class="btn btn-outline-success btn-xs" href="{{ route('listing.create') }}">Create Listing</a>
                </li>

                @if(Auth::user() and Auth::user()->organizations->count())
                    <li class="nav-item px-4">
                        <a class="btn btn-outline-secondary btn-xs" href="{{ route('listing.create', ['wanted' => true]) }}">Create Organization Listing</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
