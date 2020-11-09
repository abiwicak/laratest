@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Data Post') }}
                </div>
                <div class="card-body">
                    <table class="table table-nobo table-sm col">
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>:</td>
                                <td> {{ $post->id }} </td>
                            </tr>
                            <tr>
                                <td>User Name</td>
                                <td>:</td>
                                <td> {{ $post->user->name }} </td>
                            </tr>
                            <tr>
                                <td>Title</td>
                                <td>:</td>
                                <td> {{ $post->title }} </td>
                            </tr>
                            <tr>
                                <td>Description</td>
                                <td>:</td>
                                <td> {{ $post->text }} </td>
                            </tr>
                        </thead>
                    </table>
                    <a href="/post" class="btn btn-sm btn-outline-secondary">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
