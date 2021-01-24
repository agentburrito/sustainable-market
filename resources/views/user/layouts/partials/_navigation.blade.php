<div class="card">
    <div class="card-body">
        
        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link {{ return_if(on_page('user/profile'), 'active') }}" href="{{ route('user.profile.index') }}">Update Details</a>
            <a class="nav-link {{ return_if(on_page('user/profile/password*'), 'active') }}" href="{{ route('user.profile.password.index') }}">Change Password</a>
        </div>
    </div> 
</div> 