  <!-- TOPBAR -->
  <header class="topbar">
    <div class="topbar-greeting">
      <h1>Hello, {{ auth()->user()->name }}</h1>
      <p>Welcome back and explore the world</p>
    </div>
    <div class="search-box">
      <i class="fas fa-search"></i>
      <input type="text" placeholder="Search destinations...">
    </div>
    <div class="topbar-icons">
      <button class="icon-btn"><i class="fas fa-bell"></i></button>
      <button class="icon-btn"><i class="fas fa-envelope"></i></button>
    </div>
    <form action="{{ route('admin.logout') }}" method="POST" class="user-chip-form m-0 p-0">
      @csrf
      <button type="submit" class="user-chip" style="border: 0; background: transparent; padding: 0; cursor: pointer;">
        <div class="user-avatar">⏻</div>
        <div class="user-info">
          <p>Logout</p>
        </div>
      </button>
    </form>
  </header>