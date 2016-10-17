@extends('admin.layouts.backend')

@section('title')
	Pagine
@stop

@section('content')
	<table class="table table-striped">
       <thead>
           <tr>
               <th>Title</th> 
               <th>URI</th> 
               <th>Name</th> 
               <th>Edit</th> 
               <th>Delete</th> 
           </tr>
        </thead>
        <tbody> 
			@if (count($pages))
	           @foreach ($pages as $count => $page)
	               <tr>
	                   <td><a href="{{ route('pages.edit',$user->id) }}">{{$user->name}}</a></td> 
	                   <td>{{$user->email}}</td> 
	                   <td><a href="{{ route('pages.edit',$user->id) }}"><span class="glyphicon glyphicon-edit"></span></a></td>
	                   <td><a href="{{ route('pages.confirm',$user->id) }}"><span class="glyphicon glyphicon-trash"></span></a></td>
	               </tr>
	           @endforeach
			@else
				<tr><td colspan="">Nessuna pagina</td></tr>
			@endif
    </tbody> 
</table>

@stop