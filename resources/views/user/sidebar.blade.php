<style>
    .dashboard-sidebar {
        background: #fff;
        border-radius: 10px;
        border: 1px solid #ddd;
        position: sticky;
        top: 80px;
    }
    .nav-link {
        color: #333;
        padding: 10px 15px;
        font-weight: 500;
        border-radius: 5px;
        border-bottom: 1px solid #ccc;
        transition: all 0.3s ease-in-out;
    }
    .nav-link.active {
        background: #001090;
        color: #fff;
    }

    .nav-link:hover {
        background: #d8d8d8;
        color: #001090;
    }
</style>

<ul class="nav flex-column dashboard-sidebar p-3 rounded shadow-sm">
    <li class="nav-item mb-2">
        <a class="nav-link d-flex align-items-center rounded-0 {{ request()->routeIs('user.dashboard') ? 'active' : '' }}"
           href="{{ route('user.dashboard') }}">
            <i class="bi bi-house-door me-2"></i> Dashboard
        </a>
    </li>
    <li class="nav-item mb-2">
        <a href="{{ route('user.order.list') }}" class="nav-link d-flex align-items-center rounded-0 {{ request()->routeIs('user.order.list') || request()->routeIs('user.order.details')  ? 'active' : '' }}">
            <i class="bi bi-bag me-2"></i> Orders
        </a>
    </li>

    {{-- <li class="nav-item mb-2">
        <a class="nav-link d-flex align-items-center" href="#tab-downloads">
            <i class="bi bi-wallet2 me-2"></i> Transactions
        </a>
    </li> --}}
    <li class="nav-item mb-2">
        <a class="nav-link d-flex align-items-center rounded-0 {{ request()->routeIs('user.profile') ? 'active' : '' }}"
           href="{{ route('user.profile') }}">
            <i class="bi bi-person me-2"></i> Account Details
        </a>
    </li>
    <li class="nav-item mt-4">
        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <a class="rounded logout-link d-flex align-items-center fw-bold btn btn-danger text-white"

               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right me-2"></i> Logout
            </a>
        </form>
    </li>

</ul>
