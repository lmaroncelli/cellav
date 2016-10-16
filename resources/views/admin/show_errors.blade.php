@if (count($errors) > 0)
	<div class="alert alert-danger">
		<ul>
			@foreach ($errors->all() as $error)
				<li>
					{{$error}}
				</li>
			@endforeach
		</ul>
	</div>
@endif

@if (isset($status))
	<div class="alert alert-info">
		 {{$status}}
	</div>
@endif