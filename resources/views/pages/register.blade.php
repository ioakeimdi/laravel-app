@extends('layouts.dashboard')

@section('title', isset($user) ? 'Edit User' : 'Register User')

@section('dashboard-content')
<div class="mx-auto" style="width:400px;">
	<h2>Register form</h2>	
	
	<div class="mt-4">
		<form id="register-form" class="needs-validation" novalidate>
			@csrf
			
			<div class="mb-3">
				<input type="checkbox" name="is_active" id="is_active" value="1" {{ (isset($user) && $user->is_active) ? 'checked' : '' }}>
				<label for="is_active" class="form-check-label">Active</label>
			</div>
			
			<div class="mb-3">
				<label for="name" class="form-label">Full name *</label>
				<input type="text" name="name" id="name" class="form-control" minlength="3" value="{{ $user->name ?? '' }}" required>
			</div>

			<div class="mb-3">
				<label for="username" class="form-label">Username *</label>
				<input type="text" name="username" id="username" class="form-control" minlength="3" value="{{ $user->username ?? '' }}" required>
			</div>

			<div class="mb-3">
				<label for="email" class="form-label">Email *</label>
				<input type="email" name="email" id="email" class="form-control" value="{{ $user->email ?? '' }}" required>
			</div>

			<div class="mb-3">
				<label for="password" class="form-label">Password *</label>
				<input type="password" name="password" id="password" class="form-control" minlength="6" required>
			</div>

			<div class="mb-3">
				<label for="password_confirmation" class="form-label">Password Confirmation *</label>
				<input type="password" name="password_confirmation" id="password_confirmation" class="form-control" minlength="6" required>
			</div>

			<div class="mb-3">
				<label class="form-label">Select Roles</label>
				<div>
					@foreach($roles as $role)
						<div>
							<input
								type="checkbox"
								name="roles[]"
								id="role_{{ $role->id }}"
								value="{{ $role->id }}"
								{{ isset($user) && $user->roles->contains($role->id) ? 'checked' : '' }}
							>
							<label class="form-check-label" for="role_{{ $role->id }}">{{ $role->name }}</label>
						</div>
					@endforeach
				</div>
			</div>

			<p class="mt-2 text-muted">Fields with * are required.</p>

			<button type="submit" class="btn btn-secondary">Update</button>
		</form>
		
		<div id="register-msg" class="mt-4"></div>
	</div>
</div>

<script>
	$('#password, #password_confirmation').on('input', function(){
		const $password = $('#password');
		const $confirm = $('#password_confirmation');

		if ($confirm.val()) {
			if ($password.val() !== $confirm.val()) {
				$confirm.addClass('is-invalid').removeClass('is-valid');
			} else {
				$confirm.addClass('is-valid').removeClass('is-invalid');
			}
		} else {
			$confirm.removeClass('is-valid is-invalid');
		}
	});

	$('#register-form').on('submit', function(e) {
		e.preventDefault();
		const $form = $(this);
		const $register_msg = $('#register-msg');

		let url = "{{ isset($user) ? route('dashboard.user.update', $user->id) : route('dashboard.register.post') }}";

		$.ajax({
			url: url,
			method: "POST",
			data: $form.serialize(),
			headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
			success: function(response) {
				$register_msg.html(`<div class="alert alert-success">${response.message}</div>`);
				setTimeout(() => { window.location.href = response.redirect; }, 800);
			},
			error: function(xhr) {
				let msg = 'Something went wrong';
				if (xhr.responseJSON && xhr.responseJSON.errors) {
					msg = Object.values(xhr.responseJSON.errors).flat().join('<br>');
				} else if (xhr.responseJSON && xhr.responseJSON.message) {
					msg = xhr.responseJSON.message;
				}
				$register_msg.html(`<div class="alert alert-danger">${msg}</div>`);
			}
		});
	});
</script>
@endsection
