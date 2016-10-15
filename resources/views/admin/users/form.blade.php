@extends('admin.layouts.backend')

@section('title')
	{{ $user->exists ? 'Modifica Utente' : 'Crea Utente'}}
@stop

@section('content')
	
	@if ($user->exists)
		<form method="PUT" action="{{ route('users.update',$user->id) }}">
	@else
		<form method="POST" action="{{ route('users.create') }}">
	@endif
	
		<div class="form-group">
	    <label for="nome">Nome</label>
	    <input type="text" class="form-control" id="nome" placeholder="Nome" value="{{old('$user->name')}}">
	  </div>

  	<div class="form-group">
      <label for="email">Email</label>
      <input type="email" class="form-control" id="email" placeholder="Email" value="{{old('$user->email')}}">
    </div>

    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" class="form-control" id="password" placeholder="Password">
    </div>

    <div class="form-group">
      <label for="password2">Password Repeat</label>
      <input type="password" class="form-control" id="password2" placeholder="Password">
    </div>
		

		<button type="submit" class="btn btn-primary">{{ $user->exists ? 'Modifica Utente' : 'Crea Utente'}}</button>

	</form>

@stop