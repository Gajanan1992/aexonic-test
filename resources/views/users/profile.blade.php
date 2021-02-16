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
            <h5>{{ $user->name }}</h5>

        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-4">
                    <img src="{{ Storage::url($user->profile) }}" alt="" class="img-fluid" style="">
                </div>
                <div class="col-sm-6">
                    <table class="table table-light">
                        <tbody>
                            <tr>
                                <th>Name</th>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <th>Mobile No</th>
                                <td>{{ $user->mobile }}</td>
                            </tr>
                            <tr>
                                <th>Country</th>
                                <td>{{ $user->country }}</td>
                            </tr>

                            <tr>
                                <th>State</th>
                                <td>{{ $user->state }}</td>
                            </tr>

                            <tr>
                                <th>Pin Code</th>
                                <td>{{ $user->pin_code }}</td>
                            </tr>
                            <tr>
                                <th>Account Status</th>
                                <td>
                                    <span class="badge  {{ ($user->status == 1) ? 'badge-success' : 'badge-danger' }} ">{{ ($user->status == 1) ? 'Active' : 'Inactive' }}</span>

                                </td>
                            </tr>
                            <tr>
                                <th colspan="2" class="text-center">
                                    <a href="/user/{{ $user->id }}/edit" class="btn btn-sm btn-success">Edit</a>
                                    <a href="/user/changeStatus/{{ $user->id }}" class="btn btn-sm btn-secondary">{{ ($user->status) ? 'Deactivate' : 'Activate' }} </a>
                                </th>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
