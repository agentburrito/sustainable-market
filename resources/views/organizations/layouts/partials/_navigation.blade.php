<div class="card">
    <div class="card-body">
        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        <a class="nav-link {{ return_if(on_page('organization/*'), 'active') }}" href="{{ route('organization.edit', $organization, false) }}">Organization Details</a>
        </div>
    </div> 
</div> 