@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Data User') }}
                </div>
                <div class="card-body">
                    <table class="table table-nobo table-sm col">
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td><ul>{{$user->id}}</ul></td>
                            </tr>
                            <tr>
                                <td>User Name</td>
                                <td><ul>{{$user->name}}</ul></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td><ul>{{$user->email}}</ul></td>
                            </tr>
                            <tr>
                                <td>Role</td>
                                <td><ul>
                                @foreach ($user->roles as $role)
                                <li>{{$role->name}}</li>
                                @endforeach
                                </ul></td>
                            </tr>
                        </thead>
                    </table>
                    <a href="/user" class="btn btn-sm btn-outline-secondary">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
