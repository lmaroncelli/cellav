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
                <th>First Name</th> 
                <th>Last Name</th> 
                <th>Username</th> 
            </tr>
            </thead>
            <tbody> 
            <tr>
                <th scope="row">1</th>
                <td>Mark</td> 
                <td>Otto</td> 
                <td>@mdo</td>
            </tr>
            </tbody> 
    </table>
    </div>
    </div>
    </div>
</div>
@endsection
