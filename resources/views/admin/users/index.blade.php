@extends('admin.layouts.backend')

@section('content')
<div class="container">
    <div class="row">
    <div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th> 
                <th>Name</th> 
                <th>Username</th> 
                <th>Edit</th> 
                <th>Delete</th> 
            </tr>
            </thead>
            <tbody> 
            @foreach ($users as $count => $user)
                <tr>
                    <th scope="row">{{$count+1}}</th>
                    <td><a href="{{ route('users.edit',$user->id) }}">{{$user->name}}</a></td> 
                    <td>{{$user->email}}</td> 
                    <td><a href="{{ route('users.edit',$user->id) }}"><span class="glyphicon glyphicon-edit"></span></a></td>
                    <td><a href="{{ route('users.confirm',$user->id) }}"><span class="glyphicon glyphicon-trash"></span></a></td>
                </tr>
            @endforeach
            </tbody> 
    </table>
    </div>
    </div>
    </div>
</div>
@endsection
