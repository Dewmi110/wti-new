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
  $isImageSliderActive = request()->routeIs('admin.image-slider.*');
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
  <a class="nav-item {{ $isUsersActive ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
    <span class="nav-icon"><i class="fas fa-users"></i></span>
    User Management
  </a>
  <a class="nav-item" href="#">
    <span class="nav-icon"><i class="fas fa-concierge-bell"></i></span>
    Services
  </a>

  <div class="sidebar-label">Web Content Management</div>

  <a class="nav-item" href="#">
    <span class="nav-icon"><i class="fas fa-laptop"></i></span>
    Home Page
  </a>

  <a class="nav-item {{ $isImageSliderActive ? 'active' : '' }}" href="{{ route('admin.image-sliders.index') }}">
    <span class="nav-icon"><i class="fas fa-laptop"></i></span>
    Image Slider
  </a>
</aside>