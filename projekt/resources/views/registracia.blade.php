@extends('layouts.app')
@section('title','Registrácia')

@section('content')
<section>
	<div class="section">
		@include('layouts.includes.error')
		<h1 class="center h1-text2">
		 	<a class="h1-a active1" href="/registracia">REGISTER</a>
	    	<a  class="h1-a" href="/prihlasenie">LOG IN</a>
	    </h1>
	    <form class="formular" method="POST" action="{{ url('/registracia') }}">
	    {{ csrf_field() }}
	    	<p class="formular" align="center">
		    	<input type="text" placeholder="MENO" name="firstname" value="{{ old('firstname') }}" required>
		    	<input type="text" placeholder="EMAIL" name="email" value="{{ old('email') }}" required><br>
		    	<input type="text" placeholder="PRIEZVISKO" name="lastname" value="{{ old('lastname') }}" required>
		    	<input type="text" placeholder="PRIHLASOVACIE MENO" name="username" value="{{ old('username') }}" required><br>
		    	<input type="text" placeholder="TELEFÓNNE ČÍSLO" name="tel" value="{{ old('tel') }}" required>
	    		<input type="password" placeholder="HESLO" name="password" required><br>
	    		<button type="submit" class="button-reg-login-udaje">REGISTER</button>
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