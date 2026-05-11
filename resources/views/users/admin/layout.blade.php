<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/admin/layout.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @yield('css')
    @yield('csrf_token')
</head>

<body class="admin-body">
    <div class="app-shell">
        @include('users.admin.sidebar')
        <div class="page-area">
            @include('users.admin.header')
           
            <main class="content">
                 @include('users.admin.pic_to_profile')
                @yield('content')
                @stack('content')
            </main>

            @include('users.admin.footer')
        </div>
    </div>

    @yield('js')
    @yield('Ajax')
    <script src="{{ asset('js/sidebar.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
function toggleDropdown() {
    const menu = document.getElementById('profileDropdown');
    menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
}

// click outside to close
document.addEventListener('click', function(event) {
    const profile = document.querySelector('.profile-wrapper');
    const menu = document.getElementById('profileDropdown');

    if (!profile.contains(event.target)) {
        menu.style.display = 'none';
    }
});

function previewImage(event) {
    let image = document.getElementById('preview-image');

    image.src = URL.createObjectURL(event.target.files[0]);
}
</script>
</body>

</html>