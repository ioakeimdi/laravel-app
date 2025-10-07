<div class="border-end p-4" id="sidebar">
	<nav>
		<h4>Welcome, {{ Auth::user()->username ?? Auth::user()->email }}</h4>

		<ul class="nav flex-column">
			<li class="nav-item mb-1">
				<a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
			</li>
			<li class="nav-item mb-1">
				<a class="nav-link" href="{{ route('dashboard.profile') }}">My Profile</a>
			</li>
			<li class="nav-item mb-1">
				<a class="nav-link" href="{{ route('dashboard.users') }}">List Users</a>
			</li>
			<li class="nav-item mb-1">
				<a class="nav-link" href="{{ route('dashboard.register') }}">Register User</a>
			</li>
		</ul>

		<form action="{{ route('logout') }}" method="POST" class="mt-2">
			@csrf
			<button type="submit" class="btn btn-outline-danger btn-sm" style="width: 150px;">Logout</button>
		</form>
	</nav>
</div>