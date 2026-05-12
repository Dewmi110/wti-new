<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
		<div class="container">
			<a class="navbar-brand" href="index.html">WTI<span>Holidays</span></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="oi oi-menu"></span> Menu
			</button>

			<div class="collapse navbar-collapse" id="ftco-nav">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item active"><a href="{{ route('frontend.index') }}" class="nav-link">Home</a></li>
					<li class="nav-item"><a href="about.html" class="nav-link">Services</a></li>
					<li class="nav-item dropdown">
						<a href="#" class="nav-link dropdown-toggle" id="destinationDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Destination</a>
						<div class="dropdown-menu" aria-labelledby="destinationDropdown">
							<a class="dropdown-item" href="{{ route('frontend.visit_to_srilanka') }}">Visit to SriLanka</a>
							<a class="dropdown-item" href="{{ route('frontend.outbound') }}">Outbound Tours</a>
						</div>
					</li>
					<li class="nav-item"><a href="hotel.html" class="nav-link">Hotel</a></li>
					<li class="nav-item"><a href="blog.html" class="nav-link">Blog</a></li>
					<li class="nav-item"><a href="contact.html" class="nav-link">Contact</a></li>
				</ul>
			</div>
		</div>
	</nav>
	<!-- END nav -->