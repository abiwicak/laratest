@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg">
            <div class="card">
                <div class="card-header">
                    {{ __('Data Posts') }}
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    <a href="post/create" class="btn btn-sm btn-warning">{{ __('Create post') }}</a>
                    <table class="table table-bordered mt-2">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>User Name</th>
                                <th>Title</th>
                                <th>Text</th>
                                <th class="col-2">Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $post)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $post->user->name }}</td>
                                <td>{{ $post->title }}</td>
                                <td>{{ Str::limit($post->text, 60) }}</td>
                                <td><a href="post/{{$post->id}}" class="btn btn-sm btn-outline-success">Show</a>
                                    <a href="post/{{$post->id}}/edit" class="btn btn-sm btn-outline-primary">Edit</a>
                                    <button data-delete="{{$post}}"
                                        data-type="post"
                                        type="button" class="btn btn-sm btn-outline-danger deletebtn"
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
