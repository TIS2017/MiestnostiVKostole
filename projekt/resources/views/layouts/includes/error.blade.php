@if ($errors->any())
	<div class="alert alert-danger" style="width:400px; margin:auto; background: rgb(255,230,213);">
		<ul>
			@foreach($errors->all() as $error)
				<li>{{$error}}</li>
			@endforeach
		</ul>
	</div>
@endif