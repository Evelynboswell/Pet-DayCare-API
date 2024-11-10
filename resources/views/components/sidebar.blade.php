<style>
    @import url('https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');

    /* Sidebar container */
    .sidebar {
        width: 240px;
        height: 100vh;
        background-color: #ffd559;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding-top: 20px;
    }

    /* Profile section */
    .profile-section {
        display: flex;
        justify-content: space-evenly;
        align-items: center;
        margin-bottom: 20px;
        color: #240E3E;
    }

    .profile-photo {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        margin-bottom: 10px;
    }

    .profile-info strong {
        font-weight: bold;
    }

    .profile-info p {
        font-size: 0.9rem;
        color: #686868;
    }

    /* Navigation links */
    .nav {
        width: 100%;
        padding: 0;
        list-style: none;
        margin-bottom: auto;
    }

    .nav-link {
        display: block;
        padding: 30px 30px;
        color: #686868;
        text-decoration: none;
        font-weight: 500;
        text-align: right;
    }

    .nav-link.active {
        background-color: #FFBF00;
        color: #240E3E;
    }

    .nav-link:hover {
        color: #240E3E;
        background-color: #FFBF00;
    }

    /* Logo section */
    .logo-section {
        text-align: center;
        padding: 20px 0;
        color: #686868;
    }

    .logo {
        width: 40px;
        height: 40px;
        margin-bottom: 5px;
    }
</style>

<div class="sidebar">
    <div class="profile-section">
        <img src="profile-photo.jpg" alt="Profile photo" class="profile-photo">
        <div class="profile-info">
            <strong>Real Slim Shady</strong>
            <p>User</p>
        </div>
    </div>

    {{-- Menu Side Nav --}}
    <ul class="nav nav-link-secondary flex-column fw-bold gap-2">
        <li><a href="{{ route('dashboard') }}" class="nav-link {{ Route::is('dashboard.*') ? 'bg-custom active' : 'inactive' }}">Dashboard</a></li>
        <li><a href="#" class="nav-link {{ Route::is('reserve.*') ? 'bg-custom active' : 'inactive' }}">Reserve</a></li>
        <li><a href="#" class="nav-link">Dog Profile</a></li>
        <li><a href="#" class="nav-link">Logout</a></li>
    </ul>

    <div class="logo-section">
        @include('components.logotext')
    </div>
</div>
</div>

<!-- Include Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>

{{-- JS --}}
<script>
    // Highlight the active link
    document.querySelectorAll('.nav-link, .nav-link-button').forEach(link => {
        if (link.href === window.location.href) {
            link.classList.add('active');
        }
    });
</script>
