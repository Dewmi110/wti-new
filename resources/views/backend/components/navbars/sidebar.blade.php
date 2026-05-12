@props(['activePage'])

@php
    $tourMenuExpanded = in_array($activePage, ['tour-categories', 'tour-types', 'tour-themes', 'countries', 'destinations']);
@endphp

<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-gradient-dark"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0 d-flex text-wrap align-items-center" href="{{ route('admin.dashboard') }}">
            <span class="ms-2 font-weight-bold text-white">Dashboard</span>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse w-auto max-height-vh-100 overflow-y-auto" id="sidenav-collapse-main" style="max-height: calc(100vh - 240px);">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'dashboard' ? 'active bg-gradient-primary' : '' }}"
                    href="{{ route('admin.dashboard') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs text-white font-weight-bolder">Tours</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white d-flex align-items-center justify-content-between"
                    data-bs-toggle="collapse" href="#tour-menu" role="button" aria-expanded="{{ $tourMenuExpanded ? 'true' : 'false' }}"
                    aria-controls="tour-menu">
                    <span class="d-flex align-items-center">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">tour</i>
                        </div>
                        <span class="nav-link-text ms-1">Tour Management</span>
                    </span>
                    <i class="fas fa-chevron-down text-white opacity-8 ms-2"></i>
                </a>
                <div class="collapse {{ $tourMenuExpanded ? 'show' : '' }}" id="tour-menu">
                    <ul class="nav nav-sm flex-column ms-4 ps-2 tour-menu-list">
                        <li class="nav-item">
                            <a class="nav-link tour-submenu-link text-white {{ $activePage == 'tour-categories' ? 'active bg-gradient-primary' : '' }}"
                                href="{{ route('admin.tour-categories.index') }}">
                                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="material-icons opacity-10">category</i>
                                </div>
                                <span class="nav-link-text ms-1">Tour Categories</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link tour-submenu-link text-white {{ $activePage == 'tour-types' ? 'active bg-gradient-primary' : '' }}"
                                href="{{ route('admin.tour-types.index') }}">
                                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="material-icons opacity-10">assignment</i>
                                </div>
                                <span class="nav-link-text ms-1">Tour Types</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link tour-submenu-link text-white {{ $activePage == 'tour-themes' ? 'active bg-gradient-primary' : '' }}"
                                href="{{ route('admin.tour-themes.index') }}">
                                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="material-icons opacity-10">palette</i>
                                </div>
                                <span class="nav-link-text ms-1">Tour Themes</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link tour-submenu-link text-white {{ $activePage == 'countries' ? 'active bg-gradient-primary' : '' }}"
                                href="{{ route('admin.countries.index') }}">
                                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="material-icons opacity-10">public</i>
                                </div>
                                <span class="nav-link-text ms-1">Countries</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link tour-submenu-link text-white {{ $activePage == 'destinations' ? 'active bg-gradient-primary' : '' }}"
                                href="{{ route('admin.destinations.index') }}">
                                <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                                    <i class="material-icons opacity-10">place</i>
                                </div>
                                <span class="nav-link-text ms-1">Destinations</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white {{ $activePage == 'tours' ? 'active bg-gradient-primary' : '' }}"
                    href="{{ route('admin.tours.index') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">card_travel</i>
                    </div>
                    <span class="nav-link-text ms-1">Tour Packages</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="sidenav-footer position-absolute w-100 bottom-0">
        <div class="mx-3">
            <form action="{{ route('admin.logout') }}" method="POST" style="display: inline;">
                @csrf
                <button class="btn bg-gradient-primary w-100" type="submit">Logout</button>
            </form>
        </div>
    </div>
</aside>
