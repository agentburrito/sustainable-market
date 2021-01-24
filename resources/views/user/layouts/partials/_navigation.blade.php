<div class="card">
    <div class="card-body">
        
        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link {{ return_if(on_page('user/profile'), 'active') }}" href="{{ route('user.profile.index', [], false) }}">Update Details</a>
            <a class="nav-link {{ return_if(on_page('user/profile/picture*'), 'active') }}" href="{{ route('user.profile.picture.index', [], false) }}">Profile Picture</a>
            <a class="nav-link {{ return_if(on_page('user/profile/password*'), 'active') }}" href="{{ route('user.profile.password.index', [], false) }}">Change Password</a>
            <a class="nav-link {{ return_if(on_page('user/' . Auth::user()->id), 'active') }}" href="{{ route('user.profile.show', Auth::user(), false) }}">My Listings</a>
        </div>
    </div> 
</div> 