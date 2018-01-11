@extends('layouts.app')
@section('title','Prihlásenie')

@section('content')

<section>
	<div class="section">
	@include('layouts.includes.error')
		<h1 class="center h1-text2">
		 	<a class="h1-a" href="/registracia">REGISTER</a>
	    	<a  class="h1-a active" href="/prihlasenie">LOG IN</a>
	    </h1>
	    <form method="POST" action="{{ url('/prihlasenie') }}">
	    	{{ csrf_field() }}
	    	<p class="formular" align="center">
		    	<input type="text" placeholder="PRIHLASOVACIE MENO" name="username" value="{{ old('username') }}" required><br>
	    		<input type="password" placeholder="HESLO" name="password" required><br>
	    		<button type="submit" class="button-reg-login-udaje">LOG IN</button>
	    		<p class="padding-top" align="center">
	    			<a href="{{ route('password.request') }}" class="color-white">Zabudli ste heslo?</a>
	    		</p>
    		</p>
    	</form>
    </div>

    <?php 
    	$miestnost="/img/miestnost.png";
    	$cas="/img/cas.png";
    	$skupina="/img/skupina.png";
	?>
    @include('layouts.includes.filter')

</section>

@endsection