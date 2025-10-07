@extends('layouts.main')

@section('title', 'Login')

@section('content')
<div class="mx-auto mt-4" style="width:400px;">
	<div class="border">
		<div class="text-bg-secondary text-center p-2">
			<h4>Login form</h4>
		</div>
		<div class="p-4">
			<form id="loginForm">
				@csrf
				
				<div class="mb-2">
					<label for="user_login" class="form-label">Username or Email</label>
					<input type="user_login" name="user_login" id="user_login" class="form-control" required>
				</div>

				<div class="mb-2">
					<label for="user_password" class="form-label">Password</label>
					<input type="password" name="password" id="user_password" class="form-control" required>
				</div>

				<button type="submit" class="btn btn-primary">Login</button>
			</form>

			<div id="login-msg" class="mt-3"></div>
		</div>
	</div>
</div>

<script>
	$('#loginForm').on('submit', function(e) {
		e.preventDefault();
		const $form = $(this);
		const $login_msg = $('#login-msg');

		$.ajax({
			url: "{{ route('login.ajax') }}",
			method: "POST",
			data: $form.serialize(),
			headers: {
				'X-CSRF-TOKEN': "{{ csrf_token() }}",
				'Accept': 'application/json'
			},
			success: function(response) {
				$login_msg.html(`<div class="alert alert-success">${response.message}</div>`);
				setTimeout(() => { window.location.href = response.redirect; }, 800);
			},
			error: function(xhr) {
				let msg = 'Something went wrong';
				if(xhr.responseJSON && xhr.responseJSON.message){
					msg = xhr.responseJSON.message;
				}
				$login_msg.html(`<div class="alert alert-danger">${msg}</div>`);
			}
		});
	});
</script>
@endsection
