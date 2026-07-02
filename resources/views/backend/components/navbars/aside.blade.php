@php
  $isDashboardActive = request()->routeIs('admin.dashboard');
  $isTourCategoriesActive = request()->routeIs('admin.tour-categories.*');
  $isTourTypesActive = request()->routeIs('admin.tour-types.*');
  $isTourThemesActive = request()->routeIs('admin.tour-themes.*');
  $isCountriesActive = request()->routeIs('admin.countries.*');
  $isDestinationsActive = request()->routeIs('admin.destinations.*');
  $isToursActive = request()->routeIs('admin.tours.*');
  $isBlogsActive = request()->routeIs('admin.blogs.*');
  $isUsersActive = request()->routeIs('admin.users.*');
  $isImageSliderActive = request()->routeIs('admin.image_sliders.*','admin.blog_sliders.*','admin.tour_banners.*','admin.corporate_banners*','admin.blog_banners*','admin.contact_banners*');
  $isServicesActive = request()->routeIs('admin.services.*');
  $isBookingsActive = request()->routeIs('admin.bookings.*');
  $isProfileActive = request()->routeIs('admin.profile.*');

@endphp

<aside class="sidebar">
  <a class="sidebar-logo" href="{{ route('admin.dashboard') }}" style="text-decoration:none;">
    <div class="logo-icon"><i class="fas fa-map-marker-alt"></i></div>
    WTI Dashboard
  </a>

  <div class="sidebar-label">Tour Management</div>

  <a class="nav-item {{ $isTourCategoriesActive ? 'active' : '' }}" href="{{ route('admin.tour-categories.index') }}">
    <span class="nav-icon"><i class="fas fa-layer-group"></i></span>
    Tour Categories
  </a>
  <a class="nav-item {{ $isTourTypesActive ? 'active' : '' }}" href="{{ route('admin.tour-types.index') }}">
    <span class="nav-icon"><i class="fas fa-tags"></i></span>
    Tour Types
  </a>
  <a class="nav-item {{ $isTourThemesActive ? 'active' : '' }}" href="{{ route('admin.tour-themes.index') }}">
    <span class="nav-icon"><i class="fas fa-palette"></i></span>
    Tour Themes
  </a>
  <a class="nav-item {{ $isCountriesActive ? 'active' : '' }}" href="{{ route('admin.countries.index') }}">
    <span class="nav-icon"><i class="fas fa-globe"></i></span>
    Countries
  </a>
  <a class="nav-item {{ $isDestinationsActive ? 'active' : '' }}" href="{{ route('admin.destinations.index') }}">
    <span class="nav-icon"><i class="fas fa-map-marker-alt"></i></span>
    Destinations
  </a>

  <div class="sidebar-label">Main Menu</div>

  <a class="nav-item {{ $isToursActive ? 'active' : '' }}" href="{{ route('admin.tours.index') }}">
    <span class="nav-icon"><i class="fas fa-suitcase-rolling"></i></span>
    Tour Packages
  </a>
  <a class="nav-item {{ $isBlogsActive ? 'active' : '' }}" href="{{ route('admin.blogs.index') }}">
    <span class="nav-icon"><i class="fas fa-blog"></i></span>
    Blogs
  </a>
  <a class="nav-item {{ $isBookingsActive ? 'active' : '' }}" href="{{ route('admin.bookings.index') }}">
    <span class="nav-icon"><i class="fas fa-calendar-check"></i></span>
    Bookings
</a>
  {{-- User Management — super_admin and admin only --}}
  @if(in_array(Auth::user()->role?->slug, ['super_admin', 'admin']))
  <a class="nav-item {{ $isUsersActive ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
      <span class="nav-icon"><i class="fas fa-users"></i></span>
      Users
  </a>
  @endif
  {{-- <a class="nav-item {{ $isUsersActive ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
    <span class="nav-icon"><i class="fas fa-users"></i></span>
    User Management
  </a> --}}
  <a class="nav-item {{ $isServicesActive ? 'active' : '' }}" href="{{ route('admin.services.index') }}">
    <span class="nav-icon"><i class="fas fa-concierge-bell"></i></span>
    Services
  </a>

  <div class="sidebar-label">Web Content Management</div>

  <a class="nav-item {{ $isImageSliderActive ? 'active' : '' }}" href="{{ route('admin.image_sliders.index') }}">
    <span class="nav-icon"><i class="fas fa-laptop"></i></span>
    Image Banners
  </a>

  {{-- Profile & Account --}}
  <div class="sidebar-label">Account</div>

  <a class="nav-item {{ request()->routeIs('admin.profile.*') ? 'active' : '' }}" href="{{ route('admin.profile.edit') }}">
    <span class="nav-icon"><i class="fas fa-user-circle"></i></span>
    My Profile
  </a>
</aside>