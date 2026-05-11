<header class="header">
    <div class="header-title">
        <p class="eyebrow">Admin Panel</p>
        <h1>School Management System</h1>
    </div>

    <div class="header-actions">
        <form class="search-form" action="{{ route('subjects.search') }}" method="GET">
            <input type="text" placeholder="Search..." name="query" class="search-input">
        </form>

        <div class="profile-card profile-wrapper"  >
          @auth
    <a href="#">
        <img src="{{ asset('storage/'.auth()->user()->image) 
            }}" 
            class="profile-pic " alt="Profile Picture" onclick="toggleDropdown()">
    </a>

@endauth

@guest
    <img src="{{ asset('images/default-profile.png') }}" class="profile-pic">
@endguest
            </div>
        </div>
    </div>

    
</header>