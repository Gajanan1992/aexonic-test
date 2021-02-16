@extends('layouts.app')

@section('content')
<div class="container">
    @if (Session::has('msg'))
    <div class="alert alert-success" role="alert">
    {{ Session::get('msg') }}
    </div>
    @endif
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Registered Users : {{ count($users) }}</h5>
        </div>

        <div class="card-body">
            @if (count($users) > 0)


            <table class="table table-light">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Profile Photo</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)

                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>
                            <img src="{{ Storage::url($user->profile) }}" alt="" style="width:80px">
                        </td>
                        <td>

                            {{ $user->name }}
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <span class="badge  {{ ($user->status == 1) ? 'badge-success' : 'badge-danger' }} ">{{ ($user->status == 1) ? 'Active' : 'Inactive' }}</span>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <h4>No user found.</h4>
                <p>Please register new user.</p>
            @endif
        </div>
    </div>

</div>
@endsection
