@extends('layouts.dashboard')

@section('title', 'Profile')

@section('dashboard-content')
<div class="row justify-content-center">
    <div class="col-12">
        <h2>My Profile</h2>
        <p class="mb-3">View your account information.</p>

        <table id="profileTable" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Roles</th>
                    <th>Active</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
						@foreach($user->roles as $role)
							{{ $role->name }}<br>
						@endforeach
					</td>
                    <td>{{ $user->is_active }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
