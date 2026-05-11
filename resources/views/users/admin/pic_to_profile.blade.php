<div id="profileDropdown" class="profile-dropdown hidden">
    <div class="dropdown-box">
        <div class="image-name">
        @if(auth()->check())
    <img src="{{ asset('storage/'.auth()->user()->image) }}" class="dropdown-img">
    <p>{{ auth()->user()->name }}</p>
@endif
        </div>
		<div class="links">
        <a href="{{ route('admin.profile.edit') }}">Profile</a>
		<br>
        <a href="{{ route('admin.settings.index') }}">Settings</a>
		<br>
		<a href="{{ route('user.logout') }}">Logout</a>
		</div>
    </div>
</div>