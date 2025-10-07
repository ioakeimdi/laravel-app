@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
<div class="d-flex flex-column flex-lg-row flex-md-col mx-auto px-4 w-100">
	@include('pages.sidebar')

    <main class="flex-grow-1 p-4">
		<p>This is your dashboard.</p>

		@if (session('error'))
			<div class="alert alert-danger" role="alert">
				{{ session('error') }}
			</div>
		@endif

		@yield('dashboard-content')
    </main>
</div>
@endsection