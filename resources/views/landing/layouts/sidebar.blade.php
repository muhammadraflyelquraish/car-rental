<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">Car<span>Book</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}"><a href="{{ route('home') }}" class="nav-link">Home</a></li>
                <li class="nav-item {{ request()->routeIs('about') ? 'active' : '' }}"><a href="{{ route('about') }}" class="nav-link">Tentang Kami</a></li>
                <li class="nav-item {{ (
                    request()->routeIs('cars') OR 
                    request()->routeIs('car-detail')) ? 'active' : '' }}">
                    <a href="{{ route('cars') }}" class="nav-link">Daftar Mobil</a>
                </li>
                <li class="nav-item {{ request()->routeIs('contact') ? 'active' : '' }}"><a href="{{ route('contact') }}" class="nav-link">Hubungi Kami</a></li>
                @guest
                <li class="nav-item"><a href="{{ route('auth.index') }}" class="nav-link">Login/Daftar</a></li>
                @endguest

                @auth
                <li class="nav-item"><a href="javascript:void(0)" id="logout" class="nav-link">Logout</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>