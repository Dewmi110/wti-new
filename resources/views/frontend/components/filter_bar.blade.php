<div class="filter-sidebar">
  <h6 class="filter-sidebar__heading">FILTERS</h6>

  {{-- Search --}}
  <div class="filter-sidebar__group">
    <label class="filter-sidebar__label">SEARCH</label>
    <div class="filter-sidebar__search-wrap">
      <span class="filter-sidebar__search-icon">🔍</span>
      <input type="text" class="filter-sidebar__search" placeholder="Title, destination...">
    </div>
  </div>

  {{-- Duration --}}
  <div class="filter-sidebar__group">
    <label class="filter-sidebar__label">DURATION</label>
    <ul class="filter-sidebar__duration-list">
      <li class="filter-sidebar__duration-item active">
        <span class="filter-sidebar__check">✓</span> Any Duration
      </li>
      <li class="filter-sidebar__duration-item">1 – 3 days</li>
      <li class="filter-sidebar__duration-item">4 – 7 days</li>
      <li class="filter-sidebar__duration-item">8 – 14 days</li>
      <li class="filter-sidebar__duration-item">15+ days</li>
    </ul>
  </div>

  {{-- Category --}}
  <div class="filter-sidebar__group">
    <label class="filter-sidebar__label">CATEGORY</label>
    <div class="filter-sidebar__tags">
      <button class="filter-sidebar__tag active">All</button>
      <button class="filter-sidebar__tag">Beach</button>
      <button class="filter-sidebar__tag">Adventure</button>
      <button class="filter-sidebar__tag">Cultural</button>
      <button class="filter-sidebar__tag">Wildlife</button>
      <button class="filter-sidebar__tag">Honeymoon</button>
      <button class="filter-sidebar__tag">Family</button>
      <button class="filter-sidebar__tag">Business</button>
      <button class="filter-sidebar__tag">Pilgrimage</button>
    </div>
  </div>
</div>

<style>
    /* =============================================
   Filter Sidebar
   ============================================= */

.filter-sidebar {
  background: #fff;
  border: 1.5px solid #e8edf5;
  border-radius: 18px;
  padding: 28px 20px;
  max-width: 100%; /* was 360px — remove fixed width so it fills col-md-3 */
  width: 100%;
}

.filter-sidebar__heading {
  font-size: 15px;
  font-weight: 800;
  color: #DB1A1A;
  letter-spacing: 1px;
  margin: 0 0 24px;
  text-transform: uppercase;
}

/* Groups */
.filter-sidebar__group {
  margin-bottom: 24px;
}

.filter-sidebar__group:last-child {
  margin-bottom: 0;
}

.filter-sidebar__label {
  display: block;
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 1.5px;
  color: #6b7280;
  text-transform: uppercase;
  margin-bottom: 10px;
}

/* Search input */
.filter-sidebar__search-wrap {
  position: relative;
  display: flex;
  align-items: center;
}

.filter-sidebar__search-icon {
  position: absolute;
  left: 12px;
  font-size: 15px;
  pointer-events: none;
  line-height: 1;
}

.filter-sidebar__search {
  width: 100%;
  border: 1.5px solid #e2e8f0;
  border-radius: 50px;
  padding: 10px 16px 10px 38px;
  font-size: 14px;
  color: #374151;
  outline: none;
  transition: border-color 0.2s;
  background: #fff;
}

.filter-sidebar__search::placeholder {
  color: #9ca3af;
}

.filter-sidebar__search:focus {
  border-color: #2c687b;
}

/* Duration list */
.filter-sidebar__duration-list {
  list-style: none;
  padding: 0;
  margin: 0;
}

.filter-sidebar__duration-item {
  display: flex;
  align-items: center;
  gap: 10px;
  font-size: 14.5px;
  color: #374151;
  font-weight: 500;
  padding: 10px 14px;
  border-radius: 10px;
  cursor: pointer;
  transition: background 0.15s, color 0.15s;
  margin-bottom: 2px;
}

.filter-sidebar__duration-item:hover {
  background: #f0f5ff;
  color: #2c687b;
}

.filter-sidebar__duration-item.active {
  background: #eaf1fb;
  color: #2c687b;
  font-weight: 700;
}

.filter-sidebar__check {
  color: #2c687b;
  font-weight: 700;
  font-size: 15px;
  line-height: 1;
}

/* Category tags */
.filter-sidebar__tags {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
}

.filter-sidebar__tag {
  border: 1.5px solid #d1d5db;
  background: #fff;
  color: #374151;
  font-size: 12px;
  font-weight: 700;
  letter-spacing: 0.5px;
  text-transform: uppercase;
  padding: 7px 14px;
  border-radius: 50px;
  cursor: pointer;
  transition: all 0.15s;
}

.filter-sidebar__tag:hover {
  border-color: #2c687b;
  color: #2c687b;
  background: #f0f5ff;
}

.filter-sidebar__tag.active {
  background: #2c687b;
  border-color: #2c687b;
  color: #fff;
}
</style>

{{-- <script>
    // Duration filter
document.querySelectorAll('.filter-sidebar__duration-item').forEach(item => {
  item.addEventListener('click', function () {
    document.querySelectorAll('.filter-sidebar__duration-item').forEach(i => {
      i.classList.remove('active');
      i.querySelector('.filter-sidebar__check') && (i.innerHTML = i.textContent.trim());
    });
    this.classList.add('active');
    this.innerHTML = `<span class="filter-sidebar__check">✓</span> ${this.textContent.trim()}`;
  });
});

// Category tags
document.querySelectorAll('.filter-sidebar__tag').forEach(tag => {
  tag.addEventListener('click', function () {
    document.querySelectorAll('.filter-sidebar__tag').forEach(t => t.classList.remove('active'));
    this.classList.add('active');
  });
});
</script> --}}