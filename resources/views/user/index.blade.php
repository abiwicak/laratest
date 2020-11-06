@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Data Users') }}
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="user/create" class="btn btn-sm btn-warning">{{ __('Register user') }}</a>
                    <table class="table table-bordered mt-2">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>User Name</th>
                                <th>Role</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $loop->iteration}}</td>
                                <td>{{$user->name}}</td>
                                <td>
                                    <ul>
                                        @foreach ($user->roles as $role)
                                        <span class="badge badge-secondary">{{$role->id}}.{{$role->name}}</span>
                                        @endforeach
                                    </ul>
                                </td>
                                <td><a href="user/{{$user->id}}" class="btn btn-sm btn-outline-success">Show</a>
                                    <a href="user/{{$user->id}}/edit" class="btn btn-sm btn-outline-primary">Edit</a>
                                    <button data-delete="{{$user}}"
                                        data-type="user"
                                        type="button" class="btn btn-sm btn-outline-danger userdeletebtn"
                                        data-toggle="modal" data-target="#deleteModal">
                                            Delete
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Data!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="/home" method="post" id="deleteForm">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <div class="form-group">
                                <label for="name" id="">Do you want to Delete</label>
                                <input id="user" type="text" name="name" class="form-control" id="name" readonly>
                            </div>
                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-outline-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
