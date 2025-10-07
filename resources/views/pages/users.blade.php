@extends('layouts.dashboard')

@section('title', 'Users')

@section('dashboard-content')
<h2>Users list</h2>

<table id="usersTable" class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th>User ID</th>
            <th>Full Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Roles</th>
            <th>Active</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->username }}</td>
            <td>{{ $user->email }}</td>
            <td>
				@foreach($user->roles as $role)
					{{ $role->name }}<br>
				@endforeach
			</td>
            <td>{{ $user->is_active }}</td>
            <td><a href="{{ route('dashboard.users.edit', $user->id) }}" class="btn btn-sm btn-outline-primary">Edit User</a></td>
        </tr>
        @endforeach
    </tbody>
</table>

<script>
	$(document).ready(function() {
		$('#usersTable').DataTable({
			lengthMenu: [
				[10, 50, 100, -1],
				[10, 50, 100, 'All']
			],
		});
	});
</script>
@endsection