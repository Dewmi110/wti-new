<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	<div class="container">
		<a class="navbar-brand" href="{{ route('frontend.index') }}">
			<img src="{{ asset('images/logo/WTIH.png') }}" alt="WTI Holidays" class="brand-logo">
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
			aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="oi oi-menu"></span> Menu
		</button>

		<div class="collapse navbar-collapse" id="ftco-nav">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item {{ request()->routeIs('frontend.index') ? 'active' : '' }}">
					<a href="{{ route('frontend.index') }}" class="nav-link">Home</a>
				</li>

				<li
					class="nav-item dropdown {{ request()->routeIs('frontend.air_tickets', 'frontend.visa_services', 'frontend.visit_to_srilanka', 'frontend.outbound', 'frontend.mice_tours') ? 'active' : '' }}">
					<a href="#" class="nav-link dropdown-toggle" id="servicesDropdown" role="button"
						data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Services</a>
					<div class="dropdown-menu" aria-labelledby="servicesDropdown">
						<a class="dropdown-item {{ request()->routeIs('frontend.air_tickets') ? 'active' : '' }}"
							href="{{ route('frontend.air_tickets') }}">Air Tickets</a>
						<a class="dropdown-item {{ request()->routeIs('frontend.visa_services') ? 'active' : '' }}"
							href="{{ route('frontend.visa_services') }}">Visa Services</a>
						<a class="dropdown-item {{ request()->routeIs('frontend.visit_to_srilanka') ? 'active' : '' }}"
							href="{{ route('frontend.visit_to_srilanka') }}">Visit to SriLanka</a>
						<a class="dropdown-item {{ request()->routeIs('frontend.outbound') ? 'active' : '' }}"
							href="{{ route('frontend.outbound') }}">Global Tour Holidays</a>
						<a class="dropdown-item {{ request()->routeIs('frontend.mice_tours') ? 'active' : '' }}"
							href="{{ route('frontend.mice_tours') }}">MICE Tours</a>
					</div>
				</li>

				<li
					class="nav-item dropdown {{ request()->routeIs('frontend.visit_to_srilanka', 'frontend.outbound') ? 'active' : '' }}">
					<a href="#" class="nav-link dropdown-toggle" id="destinationDropdown" role="button"
						data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Destination</a>
					<div class="dropdown-menu" aria-labelledby="destinationDropdown">
						<a class="dropdown-item {{ request()->routeIs('frontend.visit_to_srilanka') ? 'active' : '' }}"
							href="{{ route('frontend.visit_to_srilanka') }}">Visit to SriLanka</a>
						<a class="dropdown-item {{ request()->routeIs('frontend.outbound') ? 'active' : '' }}"
							href="{{ route('frontend.outbound') }}">Outbound Tours</a>
					</div>
				</li>

				<li class="nav-item {{ request()->routeIs('frontend.corporate') ? 'active' : '' }}">
					<a href="{{ route('frontend.corporate') }}" class="nav-link">Corporate</a>
				</li>
				<li class="nav-item {{ request()->routeIs('frontend.blog') ? 'active' : '' }}">
					<a href="{{ route('frontend.blog') }}" class="nav-link">Blog</a>
				</li>
				<li class="nav-item {{ request()->routeIs('frontend.contact') ? 'active' : '' }}">
					<a href="{{ route('frontend.contact') }}" class="nav-link">Contact</a>
				</li>
			</ul>
		</div>
	</div>
</nav>
<!-- END nav -->