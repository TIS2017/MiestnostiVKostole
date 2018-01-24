@extends('layouts.app')
@section('title','Vytvorenie člena')

@section('content')
<section>
	<div class="section">
    <a href="/profil" class="btn-back">naspäť</a>
    	@include('layouts.includes.error')
		<h1 class="center h1-text2">
		 	<span class="h1-a active1">VYTVORENIE ČLENA</span>
	    </h1>
	    <form class="formular" method="POST" action="/profil/vytvor-clena">
	    {{ csrf_field() }}
	        <p class="formular" align="center">
			    <input type="text" placeholder="MENO" name="firstname" value="{{ old('firstname') }}" required>
		    	<input type="text" placeholder="EMAIL" name="email" value="{{ old('email') }}"><br>
		    	<input type="text" placeholder="PRIEZVISKO" name="lastname" value="{{ old('lastname') }}" required>
		    	<input type="text" placeholder="PRIHLASOVACIE MENO" name="username" value="{{ old('username') }}" required><br>
		    	<input type="text" placeholder="TELEFÓNNE ČÍSLO" name="tel" value="{{ old('tel') }}">
	    		<input type="password" placeholder="HESLO" name="password" required><br>
	          	<select class="vyber" name="skupina" id="skupina">
			        <option value="vyber">--Vyber skupinu--</option>
			        @if(!empty($groups))
	                    @foreach ($groups as $group)
	                        <option value="{{$group->id}}">{{$group->name}}</option>
	                    @endforeach
	                @endif
			    </select><br>
		    	<button type="submit" class="button-reg-login-udaje">REGISTER</button>
	        </p>
    	</form>
    </div>

</section>

@endsection