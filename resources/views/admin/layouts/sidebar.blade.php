<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <img alt="image" class="rounded-circle" src="{{ asset('build/assets/admin') }}/img/profile_small.jpg" />
                    <div class="dropdown-toggle">
                        <span class="block m-t-xs font-bold text-white">Hai, {{ explode(" ", auth()->user()->fullname)[0] }}..</span>
                        <span class="text-muted text-xs block">{{ ucfirst(auth()->user()->role) }}</span>
                    </div>
                </div>
                <div class="logo-element">
                    CB
                </div>
            </li>

            <li class="{{( request()->routeIs('dashboard')) ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
            </li>

            <li class="{{ request()->routeIs('brand.index') ? 'active' : '' }}">
                <a href="{{ route('brand.index') }}"><i class="fa fa-podcast"></i> <span class="nav-label">Brand</span></a>
            </li>

            <li class="{{(
                    request()->routeIs('car.index') OR
                    request()->routeIs('car.create') OR
                    request()->routeIs('car.edit')
                ) ? 'active' : ''}}
                ">
                <a href="{{ route('car.index') }}"><i class="fa fa-car"></i> <span class="nav-label">Mobil</span></a>
            </li>

            <li class="{{(
                    request()->routeIs('customer.index') OR
                    request()->routeIs('customer.show')
                ) ? 'active' : ''}}
                ">
                <a href="{{ route('customer.index') }}"><i class="fa fa-users"></i> <span class="nav-label">Customer</span></a>
            </li>

            <li class="{{( 
                    request()->routeIs('driver.index') OR
                    request()->routeIs('driver.create') OR
                    request()->routeIs('driver.show') 
                ) ? 'active' : '' }}
                ">
                <a href="{{ route('driver.index') }}"><i class="fa fa-user"></i> <span class="nav-label">Driver</span></a>
            </li>

            <li class="{{( 
                    request()->routeIs('order.index') OR
                    request()->routeIs('order.show')
                ) ? 'active' : ''}}">
                <a href="{{ route('order.index') }}"><i class="fa fa-shopping-cart"></i> <span class="nav-label">Pemesanan</span></a>
            </li>

            <li class="{{ request()->routeIs('user.index') ? 'active' : '' }}">
                <a href="{{ route('user.index') }}"><i class="fa fa-id-card"></i> <span class="nav-label">User</span></a>
            </li>

            <li class="special_link">
                <a href="javascript:void(0)" id="logout"><i class="fa fa-sign-out"></i> <span class="nav-label">Keluar</span></a>
            </li>
        </ul>

    </div>
</nav>