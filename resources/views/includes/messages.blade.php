
@if (count($errors) > 0)
	<div class="container mt-3 mb-3">
		<ul class="alert alert-danger">
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li> 
			@endforeach
		</ul>
	</div>
@endif

@if (session('success'))
	<div class="container mt-3 mb-3">
		<div class="alert alert-success" role="alert">{{ session('success') }}</div>
	</div>
@endif

@if (session('error'))
	<div class="container mt-3 mb-3">
		<div class="alert alert-danger" role="alert">{{ session('error') }}</div>
	</div>
@endif